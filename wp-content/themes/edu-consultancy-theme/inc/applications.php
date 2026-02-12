<?php
/**
 * Job applications CPT and submission flow.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Applications {

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_applications_cpt' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_application_meta_boxes' ) );
		add_action( 'save_post_job_applications', array( __CLASS__, 'save_application_meta' ) );

		add_action( 'wp_ajax_edu_submit_job_application', array( __CLASS__, 'handle_application_submission' ) );
		add_action( 'wp_ajax_nopriv_edu_submit_job_application', array( __CLASS__, 'handle_application_submission' ) );

		add_shortcode( 'edu_job_apply_form', array( __CLASS__, 'render_application_form' ) );
	}

	/**
	 * Register Job Applications CPT.
	 *
	 * @return void
	 */
	public static function register_applications_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Job Applications', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'Job Application', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New Application', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New Job Application', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit Job Application', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New Job Application', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View Job Application', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Job Applications', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No applications found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No applications found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Applications', 'edu-consultancy' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'capability_type'     => array( 'job_application', 'job_applications' ),
			'map_meta_cap'        => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'has_archive'         => false,
			'supports'            => array( 'title', 'author' ),
		);

		register_post_type( 'job_applications', $args );
	}

	/**
	 * Render job application form (Elementor-ready via shortcode).
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	public static function render_application_form( $atts ) {
		$atts = shortcode_atts(
			array(
				'job_id' => 0,
			),
			$atts,
			'edu_job_apply_form'
		);

		$job_id = absint( $atts['job_id'] );
		if ( 0 === $job_id && is_singular( 'jobs' ) ) {
			$job_id = get_the_ID();
		}

		if ( ! $job_id || 'jobs' !== get_post_type( $job_id ) ) {
			return '';
		}

		if ( ! is_user_logged_in() ) {
			$login_url = wp_login_url( get_permalink( $job_id ) );

			return sprintf(
				'<p>%s</p>',
				wp_kses(
					sprintf(
						/* translators: %s: login url */
						__( 'Please <a href="%s">log in</a> or create an account to apply for this job.', 'edu-consultancy' ),
						esc_url( $login_url )
					),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				)
			);
		}

		$current_user = wp_get_current_user();
		$nonce        = wp_create_nonce( 'edu_job_application_nonce' );
		$ajax_url     = admin_url( 'admin-ajax.php' );

		ob_start();
		?>
		<form class="edu-job-application-form" method="post" action="<?php echo esc_url( $ajax_url ); ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" value="edu_submit_job_application" />
			<input type="hidden" name="edu_nonce" value="<?php echo esc_attr( $nonce ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />

			<div>
				<label for="edu_cover_letter"><?php esc_html_e( 'Cover Letter', 'edu-consultancy' ); ?></label>
				<textarea id="edu_cover_letter" name="cover_letter" rows="5"></textarea>
			</div>

			<div>
				<label for="edu_cv_file"><?php esc_html_e( 'Upload CV (PDF, DOC, DOCX)', 'edu-consultancy' ); ?> *</label>
				<input type="file" id="edu_cv_file" name="cv_file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required />
			</div>

			<div>
				<label for="edu_portfolio"><?php esc_html_e( 'Portfolio URL (optional)', 'edu-consultancy' ); ?></label>
				<input type="url" id="edu_portfolio" name="portfolio_url" />
			</div>

			<button type="submit" class="edu-btn-primary">
				<?php esc_html_e( 'Submit Application', 'edu-consultancy' ); ?>
			</button>

			<div class="edu-consultation-message edu-job-application-message" aria-live="polite"></div>
		</form>
		<?php

		return (string) ob_get_clean();
	}

	/**
	 * Handle job application submissions via AJAX.
	 *
	 * @return void
	 */
	public static function handle_application_submission() {
		if ( ! isset( $_POST['edu_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_nonce'] ) ), 'edu_job_application_nonce' ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Security check failed. Please refresh and try again.', 'edu-consultancy' ),
				),
				400
			);
		}

		if ( ! is_user_logged_in() ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'You must be logged in to apply for this job.', 'edu-consultancy' ),
				),
				401
			);
		}

		$current_user = wp_get_current_user();
		$user_id      = (int) $current_user->ID;

		$job_id = isset( $_POST['job_id'] ) ? absint( $_POST['job_id'] ) : 0;
		if ( ! $job_id || 'jobs' !== get_post_type( $job_id ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Invalid job selected.', 'edu-consultancy' ),
				),
				400
			);
		}

		$cover_letter  = isset( $_POST['cover_letter'] ) ? sanitize_textarea_field( wp_unslash( $_POST['cover_letter'] ) ) : '';
		$portfolio_url = isset( $_POST['portfolio_url'] ) ? esc_url_raw( wp_unslash( $_POST['portfolio_url'] ) ) : '';

		// Prevent duplicate applications for the same job by the same user.
		$existing = get_posts(
			array(
				'post_type'      => 'job_applications',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'author'         => $user_id,
				'meta_key'       => 'edu_job_id',
				'meta_value'     => $job_id,
				'fields'         => 'ids',
			)
		);

		if ( ! empty( $existing ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'You have already applied for this job.', 'edu-consultancy' ),
				),
				400
			);
		}

		// Validate and handle CV upload.
		if ( ! isset( $_FILES['cv_file'] ) || empty( $_FILES['cv_file']['name'] ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Please upload your CV.', 'edu-consultancy' ),
				),
				400
			);
		}

		$file = $_FILES['cv_file'];

		// Limit file size to ~5MB.
		$max_size = 5 * 1024 * 1024;
		if ( isset( $file['size'] ) && (int) $file['size'] > $max_size ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'CV file is too large. Maximum size is 5MB.', 'edu-consultancy' ),
				),
				400
			);
		}

		$allowed_mimes = array(
			'pdf'  => 'application/pdf',
			'doc'  => 'application/msword',
			'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		);

		$overrides = array(
			'test_form' => false,
			'mimes'     => $allowed_mimes,
		);

		require_once ABSPATH . 'wp-admin/includes/file.php';

		$upload = wp_handle_upload( $file, $overrides );

		if ( isset( $upload['error'] ) || ! isset( $upload['file'] ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Failed to upload CV. Please try again.', 'edu-consultancy' ),
				),
				400
			);
		}

		// Create attachment for uploaded CV.
		$file_path = $upload['file'];
		$file_url  = $upload['url'];
		$file_type = wp_check_filetype( basename( $file_path ), null );

		$attachment_id = wp_insert_attachment(
			array(
				'post_mime_type' => $file_type['type'],
				'post_title'     => sanitize_file_name( basename( $file_path ) ),
				'post_content'   => '',
				'post_status'    => 'private',
				'post_author'    => $user_id,
			),
			$file_path
		);

		if ( ! is_wp_error( $attachment_id ) ) {
			require_once ABSPATH . 'wp-admin/includes/image.php';
			wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $file_path ) );
		}

		// Create application post.
		$job_title    = get_the_title( $job_id );
		$post_title   = sprintf(
			/* translators: 1: job title, 2: applicant name */
			esc_html__( 'Application for %1$s - %2$s', 'edu-consultancy' ),
			$job_title,
			$current_user->display_name
		);
		$application_id = wp_insert_post(
			array(
				'post_type'   => 'job_applications',
				'post_title'  => $post_title,
				'post_status' => 'publish',
				'post_author' => $user_id,
				'meta_input'  => array(
					'edu_job_id'             => $job_id,
					'edu_applicant_id'       => $user_id,
					'edu_cover_letter'       => $cover_letter,
					'edu_cv_attachment_id'   => $attachment_id,
					'edu_portfolio_url'      => $portfolio_url,
					'edu_application_status' => 'pending',
					'edu_cv_url'             => $file_url,
				),
			)
		);

		if ( is_wp_error( $application_id ) || 0 === $application_id ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Could not submit your application. Please try again later.', 'edu-consultancy' ),
				),
				500
			);
		}

		self::send_notifications( $application_id, $job_id, $user_id );

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Your application has been submitted successfully.', 'edu-consultancy' ),
			)
		);
	}

	/**
	 * Send admin and employer notifications.
	 *
	 * @param int $application_id Application ID.
	 * @param int $job_id         Job ID.
	 * @param int $user_id        Applicant user ID.
	 *
	 * @return void
	 */
	private static function send_notifications( $application_id, $job_id, $user_id ) {
		$admin_email = get_option( 'admin_email' );

		$job_author_id = (int) get_post_field( 'post_author', $job_id );
		$employer      = get_user_by( 'id', $job_author_id );
		$applicant     = get_user_by( 'id', $user_id );

		$subject = esc_html__( 'New Job Application Received', 'edu-consultancy' );

		$body_lines = array(
			__( 'A new job application has been submitted.', 'edu-consultancy' ),
			'',
			'Job: ' . get_the_title( $job_id ),
			'Applicant: ' . ( $applicant ? $applicant->display_name : '' ),
			'Applicant Email: ' . ( $applicant ? $applicant->user_email : '' ),
			'',
			'View application in dashboard: ' . get_edit_post_link( $application_id ),
		);

		$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

		if ( $admin_email && is_email( $admin_email ) ) {
			wp_mail(
				$admin_email,
				$subject,
				implode( "\n", array_map( 'wp_strip_all_tags', $body_lines ) ),
				$headers
			);
		}

		if ( $employer && is_email( $employer->user_email ) ) {
			wp_mail(
				$employer->user_email,
				$subject,
				implode( "\n", array_map( 'wp_strip_all_tags', $body_lines ) ),
				$headers
			);
		}
	}

	/**
	 * Add meta boxes for application status.
	 *
	 * @return void
	 */
	public static function add_application_meta_boxes() {
		add_meta_box(
			'edu-application-status',
			esc_html__( 'Application Status', 'edu-consultancy' ),
			array( __CLASS__, 'render_status_meta_box' ),
			'job_applications',
			'side',
			'default'
		);
	}

	/**
	 * Render status meta box.
	 *
	 * @param WP_Post $post Post.
	 *
	 * @return void
	 */
	public static function render_status_meta_box( $post ) {
		wp_nonce_field( 'edu_save_application_meta', 'edu_application_meta_nonce' );

		$current_status = get_post_meta( $post->ID, 'edu_application_status', true );
		if ( empty( $current_status ) ) {
			$current_status = 'pending';
		}

		$statuses = array(
			'pending'     => esc_html__( 'Pending', 'edu-consultancy' ),
			'shortlisted' => esc_html__( 'Shortlisted', 'edu-consultancy' ),
			'rejected'    => esc_html__( 'Rejected', 'edu-consultancy' ),
			'hired'       => esc_html__( 'Hired', 'edu-consultancy' ),
		);
		?>
		<p>
			<label for="edu_application_status_field" class="screen-reader-text">
				<?php esc_html_e( 'Application Status', 'edu-consultancy' ); ?>
			</label>
			<select name="edu_application_status" id="edu_application_status_field">
				<?php foreach ( $statuses as $value => $label ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_status, $value ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Save application meta from meta box.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public static function save_application_meta( $post_id ) {
		if ( ! isset( $_POST['edu_application_meta_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_application_meta_nonce'] ) ), 'edu_save_application_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['edu_application_status'] ) ) {
			$allowed = array( 'pending', 'shortlisted', 'rejected', 'hired' );
			$status  = sanitize_text_field( wp_unslash( $_POST['edu_application_status'] ) );

			if ( ! in_array( $status, $allowed, true ) ) {
				$status = 'pending';
			}

			update_post_meta( $post_id, 'edu_application_status', $status );
		}
	}
}


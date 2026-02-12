<?php
/**
 * Frontend dashboards for job seekers and employers.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Dashboards {

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_shortcode( 'edu_job_seeker_dashboard', array( __CLASS__, 'render_job_seeker_dashboard' ) );
		add_shortcode( 'edu_employer_dashboard', array( __CLASS__, 'render_employer_dashboard' ) );

		add_action( 'admin_post_edu_update_jobseeker_profile', array( __CLASS__, 'handle_jobseeker_profile_update' ) );
		add_action( 'admin_post_nopriv_edu_update_jobseeker_profile', array( __CLASS__, 'handle_jobseeker_profile_update' ) );

		add_action( 'admin_post_edu_update_application_status', array( __CLASS__, 'handle_update_application_status' ) );
	}

	/**
	 * Render job seeker dashboard.
	 *
	 * @return string
	 */
	public static function render_job_seeker_dashboard() {
		if ( ! is_user_logged_in() ) {
			return '<p>' . esc_html__( 'Please log in to view your job seeker dashboard.', 'edu-consultancy' ) . '</p>';
		}

		$current_user = wp_get_current_user();
		$user_id      = (int) $current_user->ID;

		// Get applications by current user.
		$applications = get_posts(
			array(
				'post_type'      => 'job_applications',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'author'         => $user_id,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		$profile_action = esc_url( admin_url( 'admin-post.php' ) );
		$nonce          = wp_create_nonce( 'edu_update_jobseeker_profile' );

		ob_start();
		?>
		<div class="edu-dashboard edu-dashboard--seeker">
			<h2><?php esc_html_e( 'Job Seeker Dashboard', 'edu-consultancy' ); ?></h2>

			<section class="edu-dashboard__section">
				<h3><?php esc_html_e( 'Profile', 'edu-consultancy' ); ?></h3>

				<form method="post" action="<?php echo $profile_action; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" enctype="multipart/form-data" class="edu-dashboard-form">
					<input type="hidden" name="action" value="edu_update_jobseeker_profile" />
					<input type="hidden" name="edu_nonce" value="<?php echo esc_attr( $nonce ); ?>" />

					<div>
						<label for="edu_display_name"><?php esc_html_e( 'Display Name', 'edu-consultancy' ); ?></label>
						<input type="text" id="edu_display_name" name="display_name" value="<?php echo esc_attr( $current_user->display_name ); ?>" />
					</div>

					<div>
						<label for="edu_website"><?php esc_html_e( 'Website / Portfolio', 'edu-consultancy' ); ?></label>
						<input type="url" id="edu_website" name="user_url" value="<?php echo esc_attr( $current_user->user_url ); ?>" />
					</div>

					<div>
						<label for="edu_cv_file_profile"><?php esc_html_e( 'Upload / Update CV (PDF, DOC, DOCX)', 'edu-consultancy' ); ?></label>
						<input type="file" id="edu_cv_file_profile" name="cv_file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
						<?php
						$cv_attachment_id = (int) get_user_meta( $user_id, 'edu_cv_attachment_id', true );
						if ( $cv_attachment_id ) :
							$cv_url = wp_get_attachment_url( $cv_attachment_id );
							if ( $cv_url ) :
								?>
								<p>
									<?php esc_html_e( 'Current CV on file:', 'edu-consultancy' ); ?>
									<a href="<?php echo esc_url( $cv_url ); ?>" target="_blank" rel="noopener noreferrer">
										<?php esc_html_e( 'Download CV', 'edu-consultancy' ); ?>
									</a>
								</p>
								<?php
							endif;
						endif;
						?>
					</div>

					<button type="submit" class="edu-btn-primary">
						<?php esc_html_e( 'Update Profile', 'edu-consultancy' ); ?>
					</button>
				</form>
			</section>

			<section class="edu-dashboard__section">
				<h3><?php esc_html_e( 'My Applications', 'edu-consultancy' ); ?></h3>
				<?php if ( empty( $applications ) ) : ?>
					<p><?php esc_html_e( 'You have not applied to any jobs yet.', 'edu-consultancy' ); ?></p>
				<?php else : ?>
					<table class="wp-list-table widefat fixed striped">
						<thead>
						<tr>
							<th><?php esc_html_e( 'Job', 'edu-consultancy' ); ?></th>
							<th><?php esc_html_e( 'Status', 'edu-consultancy' ); ?></th>
							<th><?php esc_html_e( 'Date Applied', 'edu-consultancy' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ( $applications as $application ) : ?>
							<?php
							$status = get_post_meta( $application->ID, 'edu_application_status', true );
							if ( ! $status ) {
								$status = 'pending';
							}
							$job_id   = (int) get_post_meta( $application->ID, 'edu_job_id', true );
							$job_link = $job_id ? get_permalink( $job_id ) : '';
							?>
							<tr>
								<td>
									<?php if ( $job_link ) : ?>
										<a href="<?php echo esc_url( $job_link ); ?>" target="_blank" rel="noopener noreferrer">
											<?php echo esc_html( get_the_title( $job_id ) ); ?>
										</a>
									<?php else : ?>
										<?php echo esc_html( get_the_title( $application ) ); ?>
									<?php endif; ?>
								</td>
								<td><?php echo esc_html( ucfirst( $status ) ); ?></td>
								<td><?php echo esc_html( get_the_date( '', $application ) ); ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</section>
		</div>
		<?php

		return (string) ob_get_clean();
	}

	/**
	 * Handle job seeker profile update and CV upload.
	 *
	 * @return void
	 */
	public static function handle_jobseeker_profile_update() {
		if ( ! is_user_logged_in() ) {
			wp_die( esc_html__( 'You must be logged in to update your profile.', 'edu-consultancy' ) );
		}

		if ( ! isset( $_POST['edu_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_nonce'] ) ), 'edu_update_jobseeker_profile' ) ) {
			wp_die( esc_html__( 'Security check failed.', 'edu-consultancy' ) );
		}

		$user_id = get_current_user_id();

		if ( isset( $_POST['display_name'] ) ) {
			$display_name = sanitize_text_field( wp_unslash( $_POST['display_name'] ) );
			wp_update_user(
				array(
					'ID'           => $user_id,
					'display_name' => $display_name,
				)
			);
		}

		if ( isset( $_POST['user_url'] ) ) {
			$user_url = esc_url_raw( wp_unslash( $_POST['user_url'] ) );
			wp_update_user(
				array(
					'ID'       => $user_id,
					'user_url' => $user_url,
				)
			);
		}

		// Optional CV upload.
		if ( isset( $_FILES['cv_file'] ) && ! empty( $_FILES['cv_file']['name'] ) ) {
			$file = $_FILES['cv_file'];

			$max_size = 5 * 1024 * 1024;
			if ( isset( $file['size'] ) && (int) $file['size'] > $max_size ) {
				wp_die( esc_html__( 'CV file is too large. Maximum size is 5MB.', 'edu-consultancy' ) );
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

			if ( isset( $upload['file'], $upload['url'] ) && empty( $upload['error'] ) ) {
				$file_path = $upload['file'];
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
					update_user_meta( $user_id, 'edu_cv_attachment_id', $attachment_id );
				}
			}
		}

		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : home_url( '/' ) );
		exit;
	}

	/**
	 * Render employer dashboard.
	 *
	 * @return string
	 */
	public static function render_employer_dashboard() {
		if ( ! is_user_logged_in() ) {
			return '<p>' . esc_html__( 'Please log in to view your employer dashboard.', 'edu-consultancy' ) . '</p>';
		}

		$current_user = wp_get_current_user();
		$user_id      = (int) $current_user->ID;

		// Jobs authored by current user.
		$jobs = get_posts(
			array(
				'post_type'      => 'jobs',
				'post_status'    => array( 'publish', 'draft', 'pending' ),
				'posts_per_page' => -1,
				'author'         => $user_id,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		$status_nonce = wp_create_nonce( 'edu_update_application_status' );
		$action_url   = esc_url( admin_url( 'admin-post.php' ) );

		ob_start();
		?>
		<div class="edu-dashboard edu-dashboard--employer">
			<h2><?php esc_html_e( 'Employer Dashboard', 'edu-consultancy' ); ?></h2>

			<section class="edu-dashboard__section">
				<h3><?php esc_html_e( 'My Jobs', 'edu-consultancy' ); ?></h3>
				<p>
					<a class="edu-btn-primary" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=jobs' ) ); ?>" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'Post a New Job', 'edu-consultancy' ); ?>
					</a>
				</p>

				<?php if ( empty( $jobs ) ) : ?>
					<p><?php esc_html_e( 'You have not posted any jobs yet.', 'edu-consultancy' ); ?></p>
				<?php else : ?>
					<ul class="edu-employer-jobs">
						<?php foreach ( $jobs as $job ) : ?>
							<li class="edu-employer-jobs__item">
								<strong>
									<a href="<?php echo esc_url( get_permalink( $job ) ); ?>" target="_blank" rel="noopener noreferrer">
										<?php echo esc_html( get_the_title( $job ) ); ?>
									</a>
								</strong>
								<span class="edu-employer-jobs__meta">
									<?php echo esc_html( get_post_status_object( $job->post_status )->label ); ?>
									&mdash;
									<a href="<?php echo esc_url( get_edit_post_link( $job ) ); ?>" target="_blank" rel="noopener noreferrer">
										<?php esc_html_e( 'Edit', 'edu-consultancy' ); ?>
									</a>
								</span>

								<?php
								$applications = get_posts(
									array(
										'post_type'      => 'job_applications',
										'post_status'    => 'publish',
										'posts_per_page' => -1,
										'meta_key'       => 'edu_job_id',
										'meta_value'     => $job->ID,
										'orderby'        => 'date',
										'order'          => 'DESC',
									)
								);
								?>

								<?php if ( empty( $applications ) ) : ?>
									<p><?php esc_html_e( 'No applicants yet.', 'edu-consultancy' ); ?></p>
								<?php else : ?>
									<table class="wp-list-table widefat fixed striped">
										<thead>
										<tr>
											<th><?php esc_html_e( 'Applicant', 'edu-consultancy' ); ?></th>
											<th><?php esc_html_e( 'Status', 'edu-consultancy' ); ?></th>
											<th><?php esc_html_e( 'CV', 'edu-consultancy' ); ?></th>
											<th><?php esc_html_e( 'Actions', 'edu-consultancy' ); ?></th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ( $applications as $application ) : ?>
											<?php
											$applicant_id = (int) get_post_meta( $application->ID, 'edu_applicant_id', true );
											$applicant    = $applicant_id ? get_user_by( 'id', $applicant_id ) : null;
											$status       = get_post_meta( $application->ID, 'edu_application_status', true );
											if ( ! $status ) {
												$status = 'pending';
											}
											$cv_id  = (int) get_post_meta( $application->ID, 'edu_cv_attachment_id', true );
											$cv_url = $cv_id ? wp_get_attachment_url( $cv_id ) : '';
											?>
											<tr>
												<td>
													<?php echo esc_html( $applicant ? $applicant->display_name : get_the_title( $application ) ); ?>
													<?php if ( $applicant ) : ?>
														<br />
														<small><?php echo esc_html( $applicant->user_email ); ?></small>
													<?php endif; ?>
												</td>
												<td><?php echo esc_html( ucfirst( $status ) ); ?></td>
												<td>
													<?php if ( $cv_url ) : ?>
														<a href="<?php echo esc_url( $cv_url ); ?>" target="_blank" rel="noopener noreferrer">
															<?php esc_html_e( 'Download CV', 'edu-consultancy' ); ?>
														</a>
													<?php else : ?>
														<?php esc_html_e( 'No CV', 'edu-consultancy' ); ?>
													<?php endif; ?>
												</td>
												<td>
													<form method="post" action="<?php echo $action_url; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
														<input type="hidden" name="action" value="edu_update_application_status" />
														<input type="hidden" name="edu_nonce" value="<?php echo esc_attr( $status_nonce ); ?>" />
														<input type="hidden" name="application_id" value="<?php echo esc_attr( $application->ID ); ?>" />
														<select name="status">
															<?php
															$statuses = array(
																'pending'     => esc_html__( 'Pending', 'edu-consultancy' ),
																'shortlisted' => esc_html__( 'Shortlisted', 'edu-consultancy' ),
																'rejected'    => esc_html__( 'Rejected', 'edu-consultancy' ),
																'hired'       => esc_html__( 'Hired', 'edu-consultancy' ),
															);
															foreach ( $statuses as $value => $label ) :
																?>
																<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $status, $value ); ?>>
																	<?php echo esc_html( $label ); ?>
																</option>
															<?php endforeach; ?>
														</select>
														<button type="submit" class="button">
															<?php esc_html_e( 'Update', 'edu-consultancy' ); ?>
														</button>
													</form>
												</td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</section>
		</div>
		<?php

		return (string) ob_get_clean();
	}

	/**
	 * Handle employer updating application status.
	 *
	 * @return void
	 */
	public static function handle_update_application_status() {
		if ( ! is_user_logged_in() ) {
			wp_die( esc_html__( 'You must be logged in to update applications.', 'edu-consultancy' ) );
		}

		if ( ! isset( $_POST['edu_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_nonce'] ) ), 'edu_update_application_status' ) ) {
			wp_die( esc_html__( 'Security check failed.', 'edu-consultancy' ) );
		}

		$application_id = isset( $_POST['application_id'] ) ? absint( $_POST['application_id'] ) : 0;
		$status         = isset( $_POST['status'] ) ? sanitize_text_field( wp_unslash( $_POST['status'] ) ) : 'pending';

		if ( ! $application_id || 'job_applications' !== get_post_type( $application_id ) ) {
			wp_die( esc_html__( 'Invalid application.', 'edu-consultancy' ) );
		}

		// Ensure current user is employer who owns the related job or an admin.
		$job_id   = (int) get_post_meta( $application_id, 'edu_job_id', true );
		$job_post = $job_id ? get_post( $job_id ) : null;

		if ( ! $job_post instanceof WP_Post ) {
			wp_die( esc_html__( 'Related job not found.', 'edu-consultancy' ) );
		}

		$current_user_id = get_current_user_id();

		if ( (int) $job_post->post_author !== $current_user_id && ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You are not allowed to update this application.', 'edu-consultancy' ) );
		}

		$allowed = array( 'pending', 'shortlisted', 'rejected', 'hired' );
		if ( ! in_array( $status, $allowed, true ) ) {
			$status = 'pending';
		}

		update_post_meta( $application_id, 'edu_application_status', $status );

		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : home_url( '/' ) );
		exit;
	}
}


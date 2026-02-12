<?php
/**
 * Jobs custom post type and taxonomies.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Jobs {

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_jobs_cpt' ) );
		add_action( 'init', array( __CLASS__, 'register_job_taxonomies' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_job_meta_boxes' ) );
		add_action( 'save_post_jobs', array( __CLASS__, 'save_job_meta' ) );
	}

	/**
	 * Register Jobs CPT.
	 *
	 * @return void
	 */
	public static function register_jobs_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Jobs', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'Job', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New Job', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New Job', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit Job', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New Job', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View Job', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Jobs', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No jobs found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No jobs found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Jobs', 'edu-consultancy' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields' ),
			'rewrite'            => array(
				'slug'       => 'jobs',
				'with_front' => false,
			),
			'capability_type'    => array( 'job', 'jobs' ),
			'map_meta_cap'       => true,
		);

		register_post_type( 'jobs', $args );
	}

	/**
	 * Register job-related taxonomies.
	 *
	 * @return void
	 */
	public static function register_job_taxonomies() {
		// Job Category.
		register_taxonomy(
			'job_category',
			array( 'jobs' ),
			array(
				'hierarchical'      => true,
				'labels'            => array(
					'name'          => esc_html__( 'Job Categories', 'edu-consultancy' ),
					'singular_name' => esc_html__( 'Job Category', 'edu-consultancy' ),
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'query_var'         => true,
				'rewrite'           => array(
					'slug'       => 'job-category',
					'with_front' => false,
				),
			)
		);

		// Job Location.
		register_taxonomy(
			'job_location',
			array( 'jobs' ),
			array(
				'hierarchical'      => true,
				'labels'            => array(
					'name'          => esc_html__( 'Job Locations', 'edu-consultancy' ),
					'singular_name' => esc_html__( 'Job Location', 'edu-consultancy' ),
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'query_var'         => true,
				'rewrite'           => array(
					'slug'       => 'job-location',
					'with_front' => false,
				),
			)
		);

		// Job Type taxonomy (for filtering).
		register_taxonomy(
			'job_type',
			array( 'jobs' ),
			array(
				'hierarchical'      => false,
				'labels'            => array(
					'name'          => esc_html__( 'Job Types', 'edu-consultancy' ),
					'singular_name' => esc_html__( 'Job Type', 'edu-consultancy' ),
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'query_var'         => true,
				'rewrite'           => array(
					'slug'       => 'job-type',
					'with_front' => false,
				),
			)
		);

		// Experience Level.
		register_taxonomy(
			'experience_level',
			array( 'jobs' ),
			array(
				'hierarchical'      => false,
				'labels'            => array(
					'name'          => esc_html__( 'Experience Levels', 'edu-consultancy' ),
					'singular_name' => esc_html__( 'Experience Level', 'edu-consultancy' ),
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'query_var'         => true,
				'rewrite'           => array(
					'slug'       => 'experience-level',
					'with_front' => false,
				),
			)
		);
	}

	/**
	 * Register meta boxes for job details.
	 *
	 * @return void
	 */
	public static function add_job_meta_boxes() {
		add_meta_box(
			'edu-job-details',
			esc_html__( 'Job Details', 'edu-consultancy' ),
			array( __CLASS__, 'render_job_details_meta_box' ),
			'jobs',
			'normal',
			'default'
		);
	}

	/**
	 * Render job details meta box.
	 *
	 * @param WP_Post $post Post object.
	 *
	 * @return void
	 */
	public static function render_job_details_meta_box( $post ) {
		wp_nonce_field( 'edu_save_job_meta', 'edu_job_meta_nonce' );

		$fields = array(
			'salary_range'         => esc_html__( 'Salary Range', 'edu-consultancy' ),
			'job_type_meta'        => esc_html__( 'Job Type (meta)', 'edu-consultancy' ),
			'location'             => esc_html__( 'Location', 'edu-consultancy' ),
			'experience_required'  => esc_html__( 'Experience Required', 'edu-consultancy' ),
			'education_required'   => esc_html__( 'Education Required', 'edu-consultancy' ),
			'application_deadline' => esc_html__( 'Application Deadline', 'edu-consultancy' ),
			'company_name'         => esc_html__( 'Company Name', 'edu-consultancy' ),
			'vacancies'            => esc_html__( 'Number of Vacancies', 'edu-consultancy' ),
			'benefits'             => esc_html__( 'Benefits', 'edu-consultancy' ),
		);

		$visa_sponsorship = get_post_meta( $post->ID, 'edu_visa_sponsorship', true );
		$featured_job     = get_post_meta( $post->ID, 'edu_featured_job', true );
		$company_logo_id  = get_post_meta( $post->ID, 'edu_company_logo_id', true );
		?>
		<table class="form-table">
			<tbody>
			<?php foreach ( $fields as $key => $label ) : ?>
				<?php
				$meta_key = 'edu_' . $key;
				$value    = get_post_meta( $post->ID, $meta_key, true );
				?>
				<tr>
					<th scope="row">
						<label for="<?php echo esc_attr( $meta_key ); ?>"><?php echo esc_html( $label ); ?></label>
					</th>
					<td>
						<?php if ( 'benefits' === $key ) : ?>
							<textarea name="<?php echo esc_attr( $meta_key ); ?>" id="<?php echo esc_attr( $meta_key ); ?>" rows="3" class="large-text"><?php echo esc_textarea( $value ); ?></textarea>
						<?php else : ?>
							<input type="text" name="<?php echo esc_attr( $meta_key ); ?>" id="<?php echo esc_attr( $meta_key ); ?>" class="regular-text" value="<?php echo esc_attr( $value ); ?>" />
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>

			<tr>
				<th scope="row">
					<label for="edu_visa_sponsorship"><?php esc_html_e( 'Visa Sponsorship', 'edu-consultancy' ); ?></label>
				</th>
				<td>
					<select name="edu_visa_sponsorship" id="edu_visa_sponsorship">
						<option value=""><?php esc_html_e( 'Select', 'edu-consultancy' ); ?></option>
						<option value="yes" <?php selected( $visa_sponsorship, 'yes' ); ?>><?php esc_html_e( 'Yes', 'edu-consultancy' ); ?></option>
						<option value="no" <?php selected( $visa_sponsorship, 'no' ); ?>><?php esc_html_e( 'No', 'edu-consultancy' ); ?></option>
					</select>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="edu_featured_job"><?php esc_html_e( 'Featured Job', 'edu-consultancy' ); ?></label>
				</th>
				<td>
					<label>
						<input type="checkbox" name="edu_featured_job" id="edu_featured_job" value="1" <?php checked( $featured_job, '1' ); ?> />
						<?php esc_html_e( 'Mark as featured', 'edu-consultancy' ); ?>
					</label>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="edu_company_logo_id"><?php esc_html_e( 'Company Logo (attachment ID)', 'edu-consultancy' ); ?></label>
				</th>
				<td>
					<input type="number" name="edu_company_logo_id" id="edu_company_logo_id" class="small-text" value="<?php echo esc_attr( $company_logo_id ); ?>" />
					<p class="description">
						<?php esc_html_e( 'Store the media attachment ID for the company logo. This keeps implementation ACF-ready and simple.', 'edu-consultancy' ); ?>
					</p>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Persist job details.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public static function save_job_meta( $post_id ) {
		if ( ! isset( $_POST['edu_job_meta_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_job_meta_nonce'] ) ), 'edu_save_job_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$text_keys = array(
			'edu_salary_range',
			'edu_job_type_meta',
			'edu_location',
			'edu_experience_required',
			'edu_education_required',
			'edu_application_deadline',
			'edu_company_name',
			'edu_vacancies',
			'edu_benefits',
			'edu_company_logo_id',
		);

		foreach ( $text_keys as $key ) {
			if ( isset( $_POST[ $key ] ) ) {
				$value = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
				update_post_meta( $post_id, $key, $value );
			}
		}

		$visa_sponsorship = isset( $_POST['edu_visa_sponsorship'] ) ? sanitize_text_field( wp_unslash( $_POST['edu_visa_sponsorship'] ) ) : '';
		if ( in_array( $visa_sponsorship, array( 'yes', 'no' ), true ) ) {
			update_post_meta( $post_id, 'edu_visa_sponsorship', $visa_sponsorship );
		} else {
			delete_post_meta( $post_id, 'edu_visa_sponsorship' );
		}

		$featured_job = isset( $_POST['edu_featured_job'] ) ? '1' : '0';
		update_post_meta( $post_id, 'edu_featured_job', $featured_job );
	}
}


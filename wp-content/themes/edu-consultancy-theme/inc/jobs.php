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
		add_filter( 'excerpt_length', array( __CLASS__, 'job_excerpt_length' ), 10, 2 );
		add_filter( 'excerpt_more', array( __CLASS__, 'job_excerpt_more' ), 10, 1 );
	}

	/**
	 * Excerpt length for job cards (archive and related).
	 *
	 * @param int    $length Default length.
	 * @param string $context Unused.
	 * @return int
	 */
	public static function job_excerpt_length( $length, $context = '' ) {
		if ( is_post_type_archive( 'jobs' ) || get_post_type() === 'jobs' ) {
			return 10;
		}
		return $length;
	}

	/**
	 * Excerpt more string for jobs.
	 *
	 * @param string $more Default more string.
	 * @return string
	 */
	public static function job_excerpt_more( $more ) {
		if ( get_post_type() === 'jobs' ) {
			return ' ...';
		}
		return $more;
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

		// Ensure media library scripts are available for image field.
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		$fields = array(
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
		$company_logo_id  = (int) get_post_meta( $post->ID, 'edu_company_logo_id', true );
		$salary_min       = get_post_meta( $post->ID, 'edu_salary_min', true );
		$salary_max       = get_post_meta( $post->ID, 'edu_salary_max', true );
		$job_type_meta    = get_post_meta( $post->ID, 'edu_job_type_meta', true );
		$logo_src         = $company_logo_id ? wp_get_attachment_image_src( $company_logo_id, 'thumbnail' ) : false;
		?>
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row">
					<label><?php esc_html_e( 'Salary Range', 'edu-consultancy' ); ?></label>
				</th>
				<td>
					<input
						type="number"
						min="0"
						step="1"
						name="edu_salary_min"
						id="edu_salary_min"
						class="small-text"
						value="<?php echo esc_attr( $salary_min ); ?>"
					/>
					<span>&ndash;</span>
					<input
						type="number"
						min="0"
						step="1"
						name="edu_salary_max"
						id="edu_salary_max"
						class="small-text"
						value="<?php echo esc_attr( $salary_max ); ?>"
					/>
					<p class="description">
						<?php esc_html_e( 'Enter minimum and maximum salary as numbers only (e.g. 800 and 1200).', 'edu-consultancy' ); ?>
					</p>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="edu_job_type_meta"><?php esc_html_e( 'Job Type', 'edu-consultancy' ); ?></label>
				</th>
				<td>
					<select name="edu_job_type_meta" id="edu_job_type_meta">
						<option value=""><?php esc_html_e( 'Select type', 'edu-consultancy' ); ?></option>
						<option value="full_time" <?php selected( $job_type_meta, 'full_time' ); ?>><?php esc_html_e( 'Full-time', 'edu-consultancy' ); ?></option>
						<option value="part_time" <?php selected( $job_type_meta, 'part_time' ); ?>><?php esc_html_e( 'Part-time', 'edu-consultancy' ); ?></option>
						<option value="contract" <?php selected( $job_type_meta, 'contract' ); ?>><?php esc_html_e( 'Contract', 'edu-consultancy' ); ?></option>
						<option value="internship" <?php selected( $job_type_meta, 'internship' ); ?>><?php esc_html_e( 'Internship', 'edu-consultancy' ); ?></option>
					</select>
					<p class="description">
						<?php esc_html_e( 'This complements the Job Type taxonomy and is used for labels in cards.', 'edu-consultancy' ); ?>
					</p>
				</td>
			</tr>

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
					<label for="edu_company_logo_id"><?php esc_html_e( 'Company Image', 'edu-consultancy' ); ?></label>
				</th>
				<td>
					<div class="edu-company-logo-field">
						<div class="edu-company-logo-preview" style="margin-bottom:8px;">
							<?php
							if ( $logo_src && isset( $logo_src[0] ) ) {
								?>
								<img src="<?php echo esc_url( $logo_src[0] ); ?>" alt="" style="max-width:80px;height:auto;border-radius:50%;" />
								<?php
							}
							?>
						</div>
						<input type="hidden" name="edu_company_logo_id" id="edu_company_logo_id" value="<?php echo esc_attr( $company_logo_id ); ?>" />
						<button type="button" class="button edu-company-logo-select">
							<?php esc_html_e( 'Select Image', 'edu-consultancy' ); ?>
						</button>
						<button type="button" class="button-link-delete edu-company-logo-remove">
							<?php esc_html_e( 'Remove', 'edu-consultancy' ); ?>
						</button>
						<p class="description">
							<?php esc_html_e( 'Optional image used in job cards when there is no featured image.', 'edu-consultancy' ); ?>
						</p>
					</div>

					<script>
					jQuery(function ($) {
						var frame;
						$('.edu-company-logo-select').on('click', function (event) {
							event.preventDefault();
							if (frame) {
								frame.open();
								return;
							}

							frame = wp.media({
								title: '<?php echo esc_js( __( 'Select Company Image', 'edu-consultancy' ) ); ?>',
								button: { text: '<?php echo esc_js( __( 'Use this image', 'edu-consultancy' ) ); ?>' },
								multiple: false
							});

							frame.on('select', function () {
								var attachment = frame.state().get('selection').first().toJSON();
								$('#edu_company_logo_id').val(attachment.id);

								var url = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
								$('.edu-company-logo-preview').html('<img src="' + url + '" alt="" style="max-width:80px;height:auto;border-radius:50%;" />');
							});

							frame.open();
						});

						$('.edu-company-logo-remove').on('click', function (event) {
							event.preventDefault();
							$('#edu_company_logo_id').val('');
							$('.edu-company-logo-preview').empty();
						});
					});
					</script>
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

		$fields = array(
			'edu_salary_range'         => 'text',
			'edu_location'             => 'text',
			'edu_experience_required'  => 'text',
			'edu_education_required'   => 'text',
			'edu_application_deadline' => 'text',
			'edu_company_name'         => 'text',
			'edu_vacancies'            => 'int',
			'edu_benefits'             => 'textarea',
			'edu_company_logo_id'      => 'int',
			'edu_salary_min'           => 'int',
			'edu_salary_max'           => 'int',
			'edu_job_type_meta'        => 'choice',
		);

		foreach ( $fields as $key => $type ) {
			if ( ! isset( $_POST[ $key ] ) ) {
				continue;
			}

			$raw = wp_unslash( $_POST[ $key ] );

			switch ( $type ) {
				case 'int':
					$value = absint( $raw );
					if ( $value > 0 ) {
						update_post_meta( $post_id, $key, $value );
					} else {
						delete_post_meta( $post_id, $key );
					}
					break;
				case 'textarea':
					$value = sanitize_textarea_field( $raw );
					if ( '' !== $value ) {
						update_post_meta( $post_id, $key, $value );
					} else {
						delete_post_meta( $post_id, $key );
					}
					break;
				case 'choice':
					$allowed = array( 'full_time', 'part_time', 'contract', 'internship' );
					$value   = sanitize_text_field( $raw );
					if ( in_array( $value, $allowed, true ) ) {
						update_post_meta( $post_id, $key, $value );
					} else {
						delete_post_meta( $post_id, $key );
					}
					break;
				case 'text':
				default:
					$value = sanitize_text_field( $raw );
					if ( '' !== $value ) {
						update_post_meta( $post_id, $key, $value );
					} else {
						delete_post_meta( $post_id, $key );
					}
					break;
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


<?php
/**
 * Job listing and search shortcodes.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Job_Search {

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_shortcode( 'edu_job_search', array( __CLASS__, 'render_search_form_and_results' ) );
		add_shortcode( 'edu_job_grid', array( __CLASS__, 'render_job_grid' ) );
	}

	/**
	 * Render combined search form and results (non-AJAX; Elementor-compatible).
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function render_search_form_and_results( $atts ) {
		$atts = shortcode_atts(
			array(
				'per_page' => 10,
			),
			$atts,
			'edu_job_search'
		);

		$per_page = (int) $atts['per_page'];
		if ( $per_page <= 0 ) {
			$per_page = 10;
		}

		$keyword          = isset( $_GET['job_keyword'] ) ? sanitize_text_field( wp_unslash( $_GET['job_keyword'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$category         = isset( $_GET['job_category'] ) ? sanitize_text_field( wp_unslash( $_GET['job_category'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$location         = isset( $_GET['job_location'] ) ? sanitize_text_field( wp_unslash( $_GET['job_location'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$type             = isset( $_GET['job_type'] ) ? sanitize_text_field( wp_unslash( $_GET['job_type'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$experience_level = isset( $_GET['experience_level'] ) ? sanitize_text_field( wp_unslash( $_GET['experience_level'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$paged = isset( $_GET['job_page'] ) ? max( 1, (int) $_GET['job_page'] ) : 1; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		// Build query args.
		$query_args = array(
			'post_type'      => 'jobs',
			'post_status'    => 'publish',
			'posts_per_page' => $per_page,
			'paged'          => $paged,
		);

		if ( $keyword ) {
			$query_args['s'] = $keyword;
		}

		$tax_query = array();

		if ( $category ) {
			$tax_query[] = array(
				'taxonomy' => 'job_category',
				'field'    => 'slug',
				'terms'    => $category,
			);
		}

		if ( $location ) {
			$tax_query[] = array(
				'taxonomy' => 'job_location',
				'field'    => 'slug',
				'terms'    => $location,
			);
		}

		if ( $type ) {
			$tax_query[] = array(
				'taxonomy' => 'job_type',
				'field'    => 'slug',
				'terms'    => $type,
			);
		}

		if ( $experience_level ) {
			$tax_query[] = array(
				'taxonomy' => 'experience_level',
				'field'    => 'slug',
				'terms'    => $experience_level,
			);
		}

		if ( ! empty( $tax_query ) ) {
			if ( count( $tax_query ) > 1 ) {
				$tax_query['relation'] = 'AND';
			}
			$query_args['tax_query'] = $tax_query;
		}

		$query = new WP_Query( $query_args );

		ob_start();
		?>
		<div class="edu-job-search">
			<form method="get" class="edu-job-search__form">
				<div>
					<label for="edu_job_keyword"><?php esc_html_e( 'Keyword', 'edu-consultancy' ); ?></label>
					<input type="text" name="job_keyword" id="edu_job_keyword" value="<?php echo esc_attr( $keyword ); ?>" />
				</div>

				<div>
					<label for="edu_job_category"><?php esc_html_e( 'Category', 'edu-consultancy' ); ?></label>
					<?php
					wp_dropdown_categories(
						array(
							'taxonomy'        => 'job_category',
							'name'            => 'job_category',
							'id'              => 'edu_job_category',
							'show_option_all' => esc_html__( 'All Categories', 'edu-consultancy' ),
							'hide_empty'      => false,
							'orderby'         => 'name',
							'selected'        => $category,
							'value_field'     => 'slug',
						)
					);
					?>
				</div>

				<div>
					<label for="edu_job_location"><?php esc_html_e( 'Location', 'edu-consultancy' ); ?></label>
					<?php
					wp_dropdown_categories(
						array(
							'taxonomy'        => 'job_location',
							'name'            => 'job_location',
							'id'              => 'edu_job_location',
							'show_option_all' => esc_html__( 'All Locations', 'edu-consultancy' ),
							'hide_empty'      => false,
							'orderby'         => 'name',
							'selected'        => $location,
							'value_field'     => 'slug',
						)
					);
					?>
				</div>

				<div>
					<label for="edu_job_type"><?php esc_html_e( 'Job Type', 'edu-consultancy' ); ?></label>
					<?php
					wp_dropdown_categories(
						array(
							'taxonomy'        => 'job_type',
							'name'            => 'job_type',
							'id'              => 'edu_job_type',
							'show_option_all' => esc_html__( 'All Types', 'edu-consultancy' ),
							'hide_empty'      => false,
							'orderby'         => 'name',
							'selected'        => $type,
							'value_field'     => 'slug',
						)
					);
					?>
				</div>

				<div>
					<label for="edu_experience_level"><?php esc_html_e( 'Experience Level', 'edu-consultancy' ); ?></label>
					<?php
					wp_dropdown_categories(
						array(
							'taxonomy'        => 'experience_level',
							'name'            => 'experience_level',
							'id'              => 'edu_experience_level',
							'show_option_all' => esc_html__( 'All Levels', 'edu-consultancy' ),
							'hide_empty'      => false,
							'orderby'         => 'name',
							'selected'        => $experience_level,
							'value_field'     => 'slug',
						)
					);
					?>
				</div>

				<button type="submit" class="edu-btn-primary">
					<?php esc_html_e( 'Search Jobs', 'edu-consultancy' ); ?>
				</button>
			</form>

			<div class="edu-job-search__results">
				<?php self::render_job_loop( $query ); ?>
			</div>
		</div>
		<?php

		wp_reset_postdata();

		return (string) ob_get_clean();
	}

	/**
	 * Render plain job grid for use in Elementor sections.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function render_job_grid( $atts ) {
		$atts = shortcode_atts(
			array(
				'per_page'      => 6,
				'featured_only' => 'no',
			),
			$atts,
			'edu_job_grid'
		);

		$per_page = (int) $atts['per_page'];
		if ( $per_page <= 0 ) {
			$per_page = 6;
		}

		$args = array(
			'post_type'      => 'jobs',
			'post_status'    => 'publish',
			'posts_per_page' => $per_page,
		);

		if ( 'yes' === $atts['featured_only'] ) {
			$args['meta_query'] = array(
				array(
					'key'   => 'edu_featured_job',
					'value' => '1',
				),
			);
		}

		$query = new WP_Query( $args );

		ob_start();
		?>
		<div class="edu-job-grid edu-grid edu-grid--3">
			<?php self::render_job_loop( $query ); ?>
		</div>
		<?php

		wp_reset_postdata();

		return (string) ob_get_clean();
	}

	/**
	 * Render loop markup.
	 *
	 * @param WP_Query $query Query object.
	 *
	 * @return void
	 */
	private static function render_job_loop( WP_Query $query ) {
		if ( ! $query->have_posts() ) {
			echo '<p>' . esc_html__( 'No jobs found matching your criteria.', 'edu-consultancy' ) . '</p>';
			return;
		}

		while ( $query->have_posts() ) {
			$query->the_post();

			$job_id          = get_the_ID();
			$company_name    = get_post_meta( $job_id, 'edu_company_name', true );
			$location        = get_post_meta( $job_id, 'edu_location', true );
			$salary_range    = get_post_meta( $job_id, 'edu_salary_range', true );
			$featured_job    = get_post_meta( $job_id, 'edu_featured_job', true );
			$experience      = get_post_meta( $job_id, 'edu_experience_required', true );
			$visa_sponsor    = get_post_meta( $job_id, 'edu_visa_sponsorship', true );
			$featured_badge  = ( '1' === $featured_job ) ? '<span class="edu-badge edu-badge--featured">' . esc_html__( 'Featured', 'edu-consultancy' ) . '</span>' : '';
			$visa_label      = ( 'yes' === $visa_sponsor ) ? esc_html__( 'Visa Sponsorship Available', 'edu-consultancy' ) : '';
			$job_type_terms  = get_the_terms( $job_id, 'job_type' );
			$job_type_labels = $job_type_terms && ! is_wp_error( $job_type_terms ) ? wp_list_pluck( $job_type_terms, 'name' ) : array();
			$company_logo_id = (int) get_post_meta( $job_id, 'edu_company_logo_id', true );
			$company_logo    = $company_logo_id ? wp_get_attachment_image_url( $company_logo_id, 'thumbnail' ) : '';
			?>
			<article <?php post_class( 'edu-card edu-job-card' ); ?>>
				<header class="edu-job-card__header">
					<?php if ( has_post_thumbnail( $job_id ) || $company_logo ) : ?>
						<div class="edu-job-card__media">
							<?php
							if ( has_post_thumbnail( $job_id ) ) {
								echo get_the_post_thumbnail( $job_id, 'medium', array( 'class' => 'edu-job-card__image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							} elseif ( $company_logo ) {
								echo '<img class="edu-job-card__image edu-job-card__image--logo" src="' . esc_url( $company_logo ) . '" alt="' . esc_attr( $company_name ) . '"/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</div>
					<?php endif; ?>

					<h3 class="edu-job-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<?php
					if ( $featured_badge ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $featured_badge;
					}
					?>
				</header>

				<div class="edu-job-card__meta">
					<?php if ( $company_name ) : ?>
						<div class="edu-job-card__company">
							<?php echo esc_html( $company_name ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $location ) : ?>
						<div class="edu-job-card__location">
							<?php echo esc_html( $location ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $salary_range ) : ?>
						<div class="edu-job-card__salary">
							<?php echo esc_html( $salary_range ); ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $job_type_labels ) ) : ?>
						<div class="edu-job-card__type">
							<?php echo esc_html( implode( ', ', $job_type_labels ) ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="edu-job-card__summary">
					<?php the_excerpt(); ?>

					<?php if ( $experience ) : ?>
						<p class="edu-job-card__experience">
							<?php esc_html_e( 'Experience:', 'edu-consultancy' ); ?>
							<?php echo ' ' . esc_html( $experience ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $visa_label ) : ?>
						<p class="edu-job-card__visa">
							<?php echo esc_html( $visa_label ); ?>
						</p>
					<?php endif; ?>
				</div>

				<footer class="edu-job-card__footer">
					<a class="edu-btn-primary" href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'View & Apply', 'edu-consultancy' ); ?>
					</a>
				</footer>
			</article>
			<?php
		}

		// Basic pagination (querystring preserved).
		$big = 999999;
		$pagination = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( add_query_arg( 'job_page', $big ) ) ),
				'format'    => '',
				'current'   => max( 1, (int) get_query_var( 'paged', 1 ) ),
				'total'     => (int) $query->max_num_pages,
				'type'      => 'list',
				'prev_text' => esc_html__( 'Previous', 'edu-consultancy' ),
				'next_text' => esc_html__( 'Next', 'edu-consultancy' ),
			)
		);

		if ( $pagination ) {
			echo '<nav class="edu-job-pagination" aria-label="' . esc_attr__( 'Job navigation', 'edu-consultancy' ) . '">';
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $pagination;
			echo '</nav>';
		}
	}
}


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
				'per_page' => 6,
			),
			$atts,
			'edu_job_search'
		);

		$per_page = (int) $atts['per_page'];
		if ( $per_page <= 0 ) {
			$per_page = 6;
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

		$has_filters = $keyword || $category || $location || $type || $experience_level;
		$current_query_args = array_filter( array(
			'job_keyword'      => $keyword,
			'job_category'     => $category,
			'job_location'     => $location,
			'job_type'         => $type,
			'experience_level' => $experience_level,
		) );

		ob_start();
		?>
		<div class="edu-job-search">
			<div class="edu-job-search__filter-bar">
				<form method="get" class="edu-job-search__form" action="<?php echo esc_url( get_post_type_archive_link( 'jobs' ) ); ?>" role="search" aria-label="<?php esc_attr_e( 'Filter jobs', 'edu-consultancy' ); ?>">
					<div class="edu-job-search__form-row edu-job-search__form-row--main">
						<div class="edu-job-search__filter-group edu-job-search__filter-group--keyword">
							<label for="edu_job_keyword" class="edu-job-search__label"><?php esc_html_e( 'Keyword', 'edu-consultancy' ); ?></label>
							<input type="search" name="job_keyword" id="edu_job_keyword" class="edu-job-search__input" value="<?php echo esc_attr( $keyword ); ?>" placeholder="<?php esc_attr_e( 'Job title or keyword', 'edu-consultancy' ); ?>" />
						</div>
						<div class="edu-job-search__filter-group">
							<label for="edu_job_category" class="edu-job-search__label"><?php esc_html_e( 'Category', 'edu-consultancy' ); ?></label>
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
									'class'           => 'edu-job-search__select',
								)
							);
							?>
						</div>
						<div class="edu-job-search__filter-group">
							<label for="edu_job_location" class="edu-job-search__label"><?php esc_html_e( 'Location', 'edu-consultancy' ); ?></label>
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
									'class'           => 'edu-job-search__select',
								)
							);
							?>
						</div>
					</div>
					<div class="edu-job-search__form-row edu-job-search__form-row--sub">
						<div class="edu-job-search__filter-group">
							<label for="edu_job_type" class="edu-job-search__label"><?php esc_html_e( 'Job Type', 'edu-consultancy' ); ?></label>
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
									'class'           => 'edu-job-search__select',
								)
							);
							?>
						</div>
						<div class="edu-job-search__filter-group">
							<label for="edu_experience_level" class="edu-job-search__label"><?php esc_html_e( 'Experience', 'edu-consultancy' ); ?></label>
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
									'class'           => 'edu-job-search__select',
								)
							);
							?>
						</div>
						<div class="edu-job-search__actions">
							<button type="submit" class="edu-btn-primary edu-job-search__submit">
								<?php esc_html_e( 'Search', 'edu-consultancy' ); ?>
							</button>
							<?php if ( $has_filters ) : ?>
								<a href="<?php echo esc_url( get_post_type_archive_link( 'jobs' ) ); ?>" class="edu-job-search__clear">
									<?php esc_html_e( 'Clear filters', 'edu-consultancy' ); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</form>
			</div>

			<div class="edu-job-search__results">
				<?php
				$total = $query->found_posts;
				if ( $total > 0 ) {
					echo '<p class="edu-job-search__count">';
					echo '<strong>' . absint( $total ) . '</strong> ';
					echo esc_html( _n( 'job found', 'jobs found', $total, 'edu-consultancy' ) );
					echo '</p>';
				}
				?>
				<?php self::render_job_loop( $query, $paged, $current_query_args, $per_page ); ?>
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
	 * @param WP_Query $query              Query object.
	 * @param int     $paged              Current page number.
	 * @param array   $current_query_args  Current GET args to preserve in pagination.
	 * @param int     $per_page           Posts per page.
	 *
	 * @return void
	 */
	private static function render_job_loop( WP_Query $query, $paged = 1, $current_query_args = array(), $per_page = 10 ) {
		if ( ! $query->have_posts() ) {
			echo '<div class="edu-job-search__empty">';
			echo '<p class="edu-job-search__empty-title">' . esc_html__( 'No jobs found', 'edu-consultancy' ) . '</p>';
			echo '<p class="edu-job-search__empty-text">' . esc_html__( 'Try adjusting your filters or search keyword, or browse all jobs.', 'edu-consultancy' ) . '</p>';
			echo '<a href="' . esc_url( get_post_type_archive_link( 'jobs' ) ) . '" class="edu-btn-primary">' . esc_html__( 'View all jobs', 'edu-consultancy' ) . '</a>';
			echo '</div>';
			return;
		}

		echo '<div class="edu-job-search__grid edu-grid edu-grid--3">';

		while ( $query->have_posts() ) {
			$query->the_post();

			$job_id          = get_the_ID();
			$company_name    = get_post_meta( $job_id, 'edu_company_name', true );
			$location        = get_post_meta( $job_id, 'edu_location', true );
			$salary_min      = get_post_meta( $job_id, 'edu_salary_min', true );
			$salary_max      = get_post_meta( $job_id, 'edu_salary_max', true );
			$legacy_range    = get_post_meta( $job_id, 'edu_salary_range', true );
			$featured_job    = get_post_meta( $job_id, 'edu_featured_job', true );
			$experience      = get_post_meta( $job_id, 'edu_experience_required', true );
			$visa_sponsor    = get_post_meta( $job_id, 'edu_visa_sponsorship', true );
				$is_featured    = ( '1' === $featured_job );
			$featured_badge = $is_featured ? '<span class="edu-badge edu-badge--featured">' . esc_html__( 'Featured', 'edu-consultancy' ) . '</span>' : '';
			$visa_label     = ( 'yes' === $visa_sponsor ) ? esc_html__( 'Visa Sponsorship Available', 'edu-consultancy' ) : '';
			$job_type_terms  = get_the_terms( $job_id, 'job_type' );
			$job_type_labels = $job_type_terms && ! is_wp_error( $job_type_terms ) ? wp_list_pluck( $job_type_terms, 'name' ) : array();
			$company_logo_id = (int) get_post_meta( $job_id, 'edu_company_logo_id', true );
			$company_logo    = $company_logo_id ? wp_get_attachment_image_url( $company_logo_id, 'medium' ) : '';
			$has_media       = has_post_thumbnail( $job_id ) || $company_logo;

			$salary_range = '';
			if ( '' !== $salary_min || '' !== $salary_max ) {
				if ( '' !== $salary_min && '' !== $salary_max ) {
					$salary_range = trim( $salary_min ) . ' - ' . trim( $salary_max );
				} elseif ( '' !== $salary_min ) {
					$salary_range = trim( $salary_min );
				} else {
					$salary_range = trim( $salary_max );
				}
			} elseif ( $legacy_range ) {
				$salary_range = $legacy_range;
			}

			$card_classes = array( 'edu-card', 'edu-job-card' );
			if ( $is_featured ) {
				$card_classes[] = 'edu-job-card--featured';
			}
			?>
			<article <?php post_class( $card_classes ); ?>>
				<div class="edu-job-card__featured-section">
					<div class="edu-job-card__media<?php echo $has_media ? '' : ' edu-job-card__media--placeholder'; ?>">
						<?php
						if ( has_post_thumbnail( $job_id ) ) {
							$thumb_id = get_post_thumbnail_id( $job_id );
							echo wp_get_attachment_image( $thumb_id, 'medium_large', false, array( 'class' => 'edu-job-card__image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} elseif ( $company_logo ) {
							echo '<img class="edu-job-card__image edu-job-card__image--logo" src="' . esc_url( $company_logo ) . '" alt="' . esc_attr( $company_name ) . '"/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							?>
							<span class="edu-job-card__placeholder" aria-hidden="true"></span>
							<?php
						}
						?>
					</div>
					<?php if ( $featured_badge ) : ?>
						<div class="edu-job-card__featured-badge">
							<?php echo $featured_badge; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>
				</div>
				<header class="edu-job-card__header">
					<h3 class="edu-job-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
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
		echo '</div>';

		// Pagination with preserved filter query args.
		$total_pages = (int) $query->max_num_pages;
		if ( $total_pages > 1 ) {
			$big   = 999999;
			$base  = add_query_arg( array_merge( $current_query_args, array( 'job_page' => $big ) ) );
			$base  = str_replace( $big, '%#%', esc_url( $base ) );
			$paged = max( 1, (int) $paged );

			$pagination = paginate_links(
				array(
					'base'      => $base,
					'format'    => '',
					'current'   => $paged,
					'total'     => $total_pages,
					'type'      => 'list',
					'prev_text' => '&larr; ' . esc_html__( 'Previous', 'edu-consultancy' ),
					'next_text' => esc_html__( 'Next', 'edu-consultancy' ) . ' &rarr;',
				)
			);

			if ( $pagination ) {
				echo '<nav class="edu-job-search__pagination edu-job-pagination" aria-label="' . esc_attr__( 'Jobs pagination', 'edu-consultancy' ) . '">';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $pagination;
				echo '</nav>';
			}
		}
	}
}


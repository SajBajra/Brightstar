<?php
/**
 * Single template for Job post type.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<div class="edu-container">
		<?php
		while ( have_posts() ) {
			the_post();
			$job_id           = get_the_ID();
			$company_name     = get_post_meta( $job_id, 'edu_company_name', true );
			$location         = get_post_meta( $job_id, 'edu_location', true );
			$salary_min       = get_post_meta( $job_id, 'edu_salary_min', true );
			$salary_max       = get_post_meta( $job_id, 'edu_salary_max', true );
			$legacy_range     = get_post_meta( $job_id, 'edu_salary_range', true );
			$experience       = get_post_meta( $job_id, 'edu_experience_required', true );
			$education        = get_post_meta( $job_id, 'edu_education_required', true );
			$deadline         = get_post_meta( $job_id, 'edu_application_deadline', true );
			$benefits         = get_post_meta( $job_id, 'edu_benefits', true );
			$vacancies        = get_post_meta( $job_id, 'edu_vacancies', true );
			$visa_sponsor     = get_post_meta( $job_id, 'edu_visa_sponsorship', true );
			$company_logo_id  = (int) get_post_meta( $job_id, 'edu_company_logo_id', true );
			$company_logo     = $company_logo_id ? wp_get_attachment_image_url( $company_logo_id, 'medium' ) : '';
			$job_type_terms   = get_the_terms( $job_id, 'job_type' );
			$job_type_labels  = $job_type_terms && ! is_wp_error( $job_type_terms ) ? wp_list_pluck( $job_type_terms, 'name' ) : array();
			$category_terms   = get_the_terms( $job_id, 'job_category' );
			$category_labels  = $category_terms && ! is_wp_error( $category_terms ) ? wp_list_pluck( $category_terms, 'name' ) : array();

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
				$date_posted = get_the_date();
			?>
			<article id="job-<?php echo esc_attr( $job_id ); ?>" <?php post_class( 'edu-single-job' ); ?>>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'jobs' ) ); ?>" class="edu-single-job__back">
					&larr; <?php esc_html_e( 'Back to jobs', 'edu-consultancy' ); ?>
				</a>

				<header class="edu-single-job__header">
					<div class="edu-single-job__header-inner">
						<div class="edu-single-job__header-left">
							<?php if ( $company_logo || has_post_thumbnail( $job_id ) ) : ?>
								<div class="edu-single-job__logo">
									<?php
									if ( has_post_thumbnail( $job_id ) ) {
										$thumb_id = get_post_thumbnail_id( $job_id );
										echo wp_get_attachment_image( $thumb_id, 'thumbnail', false, array( 'class' => 'edu-single-job__logo-img' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									} elseif ( $company_logo ) {
										echo '<img class="edu-single-job__logo-img" src="' . esc_url( $company_logo ) . '" alt="' . esc_attr( $company_name ? $company_name : get_the_title() ) . '" />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									}
									?>
								</div>
							<?php endif; ?>
							<div class="edu-single-job__header-content">
								<h1 class="edu-single-job__title"><?php the_title(); ?></h1>
								<div class="edu-single-job__meta-line">
									<?php if ( $company_name ) : ?>
										<span class="edu-single-job__meta-item"><?php echo esc_html( $company_name ); ?></span>
									<?php endif; ?>
									<?php if ( $date_posted ) : ?>
										<span class="edu-single-job__meta-item"><?php echo esc_html( $date_posted ); ?></span>
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $job_type_labels ) ) : ?>
									<span class="edu-single-job__type-tag"><?php echo esc_html( implode( ', ', $job_type_labels ) ); ?></span>
								<?php endif; ?>
							</div>
						</div>
						<div class="edu-single-job__header-right">
							<?php if ( $deadline ) : ?>
								<p class="edu-single-job__deadline"><?php echo esc_html__( 'Application ends:', 'edu-consultancy' ); ?> <?php echo esc_html( $deadline ); ?></p>
							<?php endif; ?>
							<a href="#apply" class="edu-btn-primary edu-single-job__apply-now"><?php esc_html_e( 'Apply Now', 'edu-consultancy' ); ?></a>
						</div>
					</div>
				</header>

				<div class="edu-single-job__body">
					<div class="edu-single-job__main">
						<div class="edu-single-job__content">
							<?php the_content(); ?>
						</div>
					</div>

					<aside class="edu-single-job__sidebar">
						<div class="edu-single-job__overview">
							<h2 class="edu-single-job__overview-title"><?php esc_html_e( 'Job Overview', 'edu-consultancy' ); ?></h2>
							<ul class="edu-single-job__overview-list">
								<?php if ( $date_posted ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Date Posted', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $date_posted ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( $deadline ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Expiration date', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $deadline ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( $experience ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Experience', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $experience ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( $education ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Qualification', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $education ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( $company_name ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Company', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $company_name ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( $location ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Location', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $location ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( $salary_range ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Salary', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( $salary_range ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( ! empty( $job_type_labels ) ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Job Type', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( implode( ', ', $job_type_labels ) ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( ! empty( $category_labels ) ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Category', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php echo esc_html( implode( ', ', $category_labels ) ); ?></span>
									</li>
								<?php endif; ?>
								<?php if ( 'yes' === $visa_sponsor ) : ?>
									<li class="edu-single-job__overview-item">
										<span class="edu-single-job__overview-label"><?php esc_html_e( 'Visa', 'edu-consultancy' ); ?></span>
										<span class="edu-single-job__overview-value"><?php esc_html_e( 'Sponsorship available', 'edu-consultancy' ); ?></span>
									</li>
								<?php endif; ?>
							</ul>
							<?php if ( $benefits ) : ?>
								<h3 class="edu-single-job__benefits-title"><?php esc_html_e( 'Benefits', 'edu-consultancy' ); ?></h3>
								<div class="edu-single-job__benefits"><?php echo wp_kses_post( wpautop( $benefits ) ); ?></div>
							<?php endif; ?>
						</div>

						<section id="apply" class="edu-single-job__apply">
							<h2 class="edu-single-job__apply-title"><?php esc_html_e( 'Apply for this job', 'edu-consultancy' ); ?></h2>
							<?php echo do_shortcode( '[edu_job_apply_form]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</section>
					</aside>
				</div>
			</article>

			<?php
			// Related / similar jobs carousel: 3 cards per slide, pagination-style controls (no arrows/dots).
			$category_ids = $category_terms && ! is_wp_error( $category_terms ) ? wp_list_pluck( $category_terms, 'term_id' ) : array();
			$job_type_ids = $job_type_terms && ! is_wp_error( $job_type_terms ) ? wp_list_pluck( $job_type_terms, 'term_id' ) : array();
			$related_tax  = array();

			if ( ! empty( $category_ids ) ) {
				$related_tax[] = array(
					'taxonomy' => 'job_category',
					'field'    => 'term_id',
					'terms'    => $category_ids,
				);
			}
			if ( ! empty( $job_type_ids ) ) {
				$related_tax[] = array(
					'taxonomy' => 'job_type',
					'field'    => 'term_id',
					'terms'    => $job_type_ids,
				);
			}
			if ( count( $related_tax ) > 1 ) {
				$related_tax['relation'] = 'OR';
			}

			$related_args = array(
				'post_type'      => 'jobs',
				'post_status'    => 'publish',
				'post__not_in'   => array( $job_id ),
				'posts_per_page' => 12,
			);
			if ( ! empty( $related_tax ) ) {
				$related_args['tax_query'] = $related_tax;
			}
			$related_jobs = new WP_Query( $related_args );
			$related_posts = $related_jobs->have_posts() ? $related_jobs->posts : array();
			$related_slides = array_chunk( $related_posts, 3 );
			$related_jobs->reset_postdata();

			if ( ! empty( $related_slides ) ) :
				$total_slides = count( $related_slides );
				?>
				<section class="edu-related-jobs" id="edu-related-jobs">
					<h2 class="edu-related-jobs__title"><?php esc_html_e( 'Similar jobs', 'edu-consultancy' ); ?></h2>
					<div class="edu-related-jobs__carousel">
						<div class="edu-related-jobs__track" data-slides="<?php echo esc_attr( (string) $total_slides ); ?>" style="width: <?php echo esc_attr( (string) ( $total_slides * 100 ) ); ?>%;">
							<?php
							$slide_width_pct = $total_slides > 0 ? ( 100 / $total_slides ) : 100;
							foreach ( $related_slides as $slide_posts ) {
								echo '<div class="edu-related-jobs__slide" style="flex: 0 0 ' . esc_attr( $slide_width_pct ) . '%; width: ' . esc_attr( $slide_width_pct ) . '%;">';
								echo '<div class="edu-related-jobs__grid edu-grid edu-grid--3">';
								foreach ( $slide_posts as $post ) {
									setup_postdata( $post );
									get_template_part( 'template-parts/content', 'job' );
								}
								echo '</div>';
								echo '</div>';
							}
							wp_reset_postdata();
							?>
						</div>
					</div>
					<?php if ( $total_slides > 1 ) : ?>
						<nav class="edu-related-jobs__pagination edu-job-pagination edu-related-jobs-carousel-pagination" aria-label="<?php esc_attr_e( 'Similar jobs carousel', 'edu-consultancy' ); ?>">
							<ul>
								<li><a href="#" class="prev page-numbers" data-page="prev" aria-label="<?php esc_attr_e( 'Previous', 'edu-consultancy' ); ?>">&larr; <?php esc_html_e( 'Previous', 'edu-consultancy' ); ?></a></li>
								<?php for ( $i = 1; $i <= $total_slides; $i++ ) : ?>
									<li><a href="#" class="page-numbers<?php echo 1 === $i ? ' current' : ''; ?>" data-page="<?php echo esc_attr( (string) $i ); ?>"><?php echo esc_html( (string) $i ); ?></a></li>
								<?php endfor; ?>
								<li><a href="#" class="next page-numbers" data-page="next" aria-label="<?php esc_attr_e( 'Next', 'edu-consultancy' ); ?>"><?php esc_html_e( 'Next', 'edu-consultancy' ); ?> &rarr;</a></li>
							</ul>
						</nav>
					<?php endif; ?>
				</section>
				<?php if ( ! empty( $total_slides ) && $total_slides > 1 ) : ?>
				<script>
				(function() {
					var section = document.getElementById('edu-related-jobs');
					if (!section) return;
					var track = section.querySelector('.edu-related-jobs__track');
					var nav = section.querySelector('.edu-related-jobs-carousel-pagination');
					if (!track || !nav) return;
					var total = parseInt(track.getAttribute('data-slides') || '1', 10);
					var current = 1;
					function goTo(page) {
						if (page === 'prev') page = current - 1;
						else if (page === 'next') page = current + 1;
						else page = parseInt(page, 10);
						if (page < 1) page = 1;
						if (page > total) page = total;
						current = page;
						var pct = total > 0 ? (current - 1) * (100 / total) : 0;
						track.style.transform = 'translateX(-' + pct + '%)';
						nav.querySelectorAll('.page-numbers').forEach(function(a) {
							a.classList.remove('current');
							if (a.getAttribute('data-page') === String(current)) a.classList.add('current');
						});
					}
					nav.addEventListener('click', function(e) {
						var a = e.target.closest('a.page-numbers');
						if (!a) return;
						e.preventDefault();
						goTo(a.getAttribute('data-page'));
					});
				})();
				</script>
				<?php endif; ?>
				<?php
			endif;
			?>
			<?php
		}
		?>
	</div>
</main>

<?php
get_footer();

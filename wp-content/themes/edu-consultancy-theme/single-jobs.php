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
		}
		?>
	</div>
</main>

<?php
get_footer();

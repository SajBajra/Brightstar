<?php
/**
 * Archive template for Jobs post type.
 * Merged with job search: one "Find Jobs" page with filters and results.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<section class="edu-find-jobs-hero" aria-label="<?php esc_attr_e( 'Find Jobs', 'edu-consultancy' ); ?>">
		<div class="edu-find-jobs-hero__overlay"></div>
		<div class="edu-find-jobs-hero__inner">
			<nav class="edu-find-jobs-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'edu-consultancy' ); ?>">
				<ol class="edu-find-jobs-hero__breadcrumb-list">
					<li class="edu-find-jobs-hero__breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edu-consultancy' ); ?></a>
					</li>
					<li class="edu-find-jobs-hero__breadcrumb-item edu-find-jobs-hero__breadcrumb-item--current" aria-current="page">
						<?php esc_html_e( 'Find Jobs', 'edu-consultancy' ); ?>
					</li>
				</ol>
			</nav>
			<h1 class="edu-find-jobs-hero__title"><?php esc_html_e( 'Find Jobs', 'edu-consultancy' ); ?></h1>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="edu-find-jobs-hero__description"><?php the_archive_description(); ?></div>
			<?php endif; ?>
		</div>
	</section>
	<div class="edu-container">
		<?php echo do_shortcode( '[edu_job_search per_page="6"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</main>

<?php
get_footer();

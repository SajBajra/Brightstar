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
	<div class="edu-container">
		<header class="page-header edu-section__header">
			<h1 class="page-title"><?php esc_html_e( 'Find Jobs', 'edu-consultancy' ); ?></h1>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header>

		<?php echo do_shortcode( '[edu_job_search]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</main>

<?php
get_footer();

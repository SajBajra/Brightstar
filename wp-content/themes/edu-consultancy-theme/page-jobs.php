<?php
/**
 * Jobs page template.
 *
 * Uses built-in job search shortcode.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Search and filter overseas opportunities by category, location, salary and experience.', 'edu-consultancy' ); ?></p>
			</header>

			<div>
				<?php
				echo do_shortcode( '[edu_job_search per_page="10"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


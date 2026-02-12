<?php
/**
 * Employer Dashboard page.
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
				<p><?php esc_html_e( 'Post jobs, review applicants and update hiring decisions.', 'edu-consultancy' ); ?></p>
			</header>

			<div>
				<?php
				echo do_shortcode( '[edu_employer_dashboard]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


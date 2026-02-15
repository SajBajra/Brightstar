<?php
/**
 * Template Name: Job Search
 * Description: Page template that displays the job search form and results.
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
			?>
			<header class="page-header edu-section__header">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php if ( get_the_content() ) : ?>
					<div class="archive-description"><?php the_content(); ?></div>
				<?php endif; ?>
			</header>
			<?php
		}
		wp_reset_postdata();
		?>

		<?php echo do_shortcode( '[edu_job_search]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</main>

<?php
get_footer();

<?php
/**
 * Blog index template (Posts page).
 * Hero + post list, no search. Used when Settings → Reading → Posts page is set.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<section class="edu-find-jobs-hero edu-blog-hero" aria-label="<?php esc_attr_e( 'Blog', 'edu-consultancy' ); ?>">
		<div class="edu-find-jobs-hero__overlay"></div>
		<div class="edu-find-jobs-hero__inner">
			<nav class="edu-find-jobs-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'edu-consultancy' ); ?>">
				<ol class="edu-find-jobs-hero__breadcrumb-list">
					<li class="edu-find-jobs-hero__breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edu-consultancy' ); ?></a>
					</li>
					<li class="edu-find-jobs-hero__breadcrumb-item edu-find-jobs-hero__breadcrumb-item--current" aria-current="page">
						<?php esc_html_e( 'Blog', 'edu-consultancy' ); ?>
					</li>
				</ol>
			</nav>
			<h1 class="edu-find-jobs-hero__title"><?php esc_html_e( 'Blog', 'edu-consultancy' ); ?></h1>
		</div>
	</section>

	<div class="edu-container">
		<?php if ( have_posts() ) : ?>
			<div class="edu-blog-list">
				<div class="edu-blog-list__grid edu-grid edu-grid--3">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					}
					?>
				</div>
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => '&larr; ' . __( 'Previous', 'edu-consultancy' ),
						'next_text' => __( 'Next', 'edu-consultancy' ) . ' &rarr;',
						'class'     => 'edu-job-pagination edu-blog-pagination',
					)
				);
				?>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();

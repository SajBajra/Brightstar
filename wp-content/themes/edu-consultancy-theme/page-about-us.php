<?php
/**
 * Template for About Us page.
 * Hero + breadcrumb + content from Brightstar HRC.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<section class="edu-find-jobs-hero edu-page-hero edu-about-hero" aria-label="<?php esc_attr_e( 'About Us', 'edu-consultancy' ); ?>">
		<div class="edu-find-jobs-hero__overlay"></div>
		<div class="edu-find-jobs-hero__inner">
			<nav class="edu-find-jobs-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'edu-consultancy' ); ?>">
				<ol class="edu-find-jobs-hero__breadcrumb-list">
					<li class="edu-find-jobs-hero__breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edu-consultancy' ); ?></a>
					</li>
					<li class="edu-find-jobs-hero__breadcrumb-item edu-find-jobs-hero__breadcrumb-item--current" aria-current="page">
						<?php esc_html_e( 'About Us', 'edu-consultancy' ); ?>
					</li>
				</ol>
			</nav>
			<h1 class="edu-find-jobs-hero__title"><?php esc_html_e( 'About Us', 'edu-consultancy' ); ?></h1>
		</div>
	</section>

	<div class="edu-container">
		<div class="edu-about-content">
			<div class="edu-about-content__main">
				<h2 class="edu-about-content__heading"><?php esc_html_e( 'What About Us?', 'edu-consultancy' ); ?></h2>
				<div class="edu-about-content__text">
					<p><?php esc_html_e( 'Brightstar HRC delivers innovative HR solutions, enhancing talent management and workforce development to boost organizational efficiency. Elevate your strategy with us.', 'edu-consultancy' ); ?></p>
				</div>
				<div class="edu-about-content__countries">
					<h3 class="edu-about-content__subheading"><?php esc_html_e( 'Countries', 'edu-consultancy' ); ?></h3>
					<ul class="edu-about-content__list">
						<li><?php esc_html_e( 'Croatia', 'edu-consultancy' ); ?></li>
						<li><?php esc_html_e( 'Malta', 'edu-consultancy' ); ?></li>
						<li><?php esc_html_e( 'Romania', 'edu-consultancy' ); ?></li>
					</ul>
				</div>
			</div>
			<aside class="edu-about-content__image">
				<img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Team collaboration', 'edu-consultancy' ); ?>" loading="lazy" />
			</aside>
		</div>
	</div>
</main>

<?php
get_footer();

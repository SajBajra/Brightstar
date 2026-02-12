<?php
/**
 * Services overview page.
 *
 * Lists Services CPT entries.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$services_query = new WP_Query(
	array(
		'post_type'      => 'services',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);
?>

<main id="primary" class="site-main">
	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'End‑to‑end education and migration services tailored to your goals.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--3 edu-cards-row">
				<?php if ( $services_query->have_posts() ) : ?>
					<?php
					while ( $services_query->have_posts() ) :
						$services_query->the_post();
						?>
						<article id="service-<?php the_ID(); ?>" <?php post_class( 'edu-card' ); ?>>
							<h2 class="edu-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="edu-card__meta">
								<?php the_excerpt(); ?>
							</div>
							<footer>
								<a class="edu-btn-outline" href="<?php the_permalink(); ?>">
									<?php esc_html_e( 'Learn More', 'edu-consultancy' ); ?>
								</a>
							</footer>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'Services will be available here soon.', 'edu-consultancy' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


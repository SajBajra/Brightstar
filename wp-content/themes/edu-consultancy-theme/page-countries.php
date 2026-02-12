<?php
/**
 * Countries overview page.
 *
 * Lists Countries CPT entries.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$countries_query = new WP_Query(
	array(
		'post_type'      => 'countries',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)
);
?>

<main id="primary" class="site-main">
	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Explore destinations by education, work rights, PR pathways and lifestyle.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--3 edu-cards-row">
				<?php if ( $countries_query->have_posts() ) : ?>
					<?php
					while ( $countries_query->have_posts() ) :
						$countries_query->the_post();
						?>
						<article id="country-<?php the_ID(); ?>" <?php post_class( 'edu-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="edu-job-card__media">
									<?php the_post_thumbnail( 'medium_large', array( 'class' => 'edu-job-card__image' ) ); ?>
								</div>
							<?php endif; ?>

							<h2 class="edu-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="edu-card__meta">
								<?php the_excerpt(); ?>
							</div>
							<footer>
								<a class="edu-btn-outline" href="<?php the_permalink(); ?>">
									<?php esc_html_e( 'View Country', 'edu-consultancy' ); ?>
								</a>
							</footer>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'Country guides will be available here soon.', 'edu-consultancy' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


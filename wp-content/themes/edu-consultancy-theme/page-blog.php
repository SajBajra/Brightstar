<?php
/**
 * Blog / Resources page.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$paged = max( 1, get_query_var( 'paged' ) );

$posts_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 9,
		'paged'          => $paged,
	)
);
?>

<main id="primary" class="site-main">
	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Visa updates, job market insights and study tips from our counsellors.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--3 edu-cards-row">
				<?php if ( $posts_query->have_posts() ) : ?>
					<?php
					while ( $posts_query->have_posts() ) :
						$posts_query->the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'edu-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="edu-job-card__media">
									<?php the_post_thumbnail( 'medium_large', array( 'class' => 'edu-job-card__image' ) ); ?>
								</div>
							<?php endif; ?>

							<h2 class="edu-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<p class="edu-card__meta">
								<?php echo esc_html( get_the_date() ); ?>
							</p>
							<div class="edu-card__meta">
								<?php the_excerpt(); ?>
							</div>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'Articles will be published here soon.', 'edu-consultancy' ); ?></p>
				<?php endif; ?>
			</div>

			<?php
			$big        = 999999;
			$pagination = paginate_links(
				array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?paged=%#%',
					'current'   => $paged,
					'total'     => (int) $posts_query->max_num_pages,
					'type'      => 'list',
					'prev_text' => esc_html__( 'Previous', 'edu-consultancy' ),
					'next_text' => esc_html__( 'Next', 'edu-consultancy' ),
				)
			);

			if ( $pagination ) {
				echo '<nav class="edu-job-pagination" aria-label="' . esc_attr__( 'Posts navigation', 'edu-consultancy' ) . '">';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $pagination;
				echo '</nav>';
			}
			?>
		</div>
	</section>
</main>

<?php
get_footer();


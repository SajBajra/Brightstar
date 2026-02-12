<?php
/**
 * Custom front page template.
 *
 * Inspired by ZenCareerHub layout, kept minimal and Elementor-friendly.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Popular job categories.
$job_categories = get_terms(
	array(
		'taxonomy'   => 'job_category',
		'hide_empty' => false,
		'number'     => 8,
	)
);

// Popular job locations.
$job_locations = get_terms(
	array(
		'taxonomy'   => 'job_location',
		'hide_empty' => false,
		'number'     => 6,
	)
);
?>

<main id="primary" class="site-main">
	<section class="edu-hero">
		<div class="edu-container edu-hero__inner">
			<div class="edu-hero__content">
				<p class="edu-hero__eyebrow">
					<?php esc_html_e( 'Education & Migration Consultancy', 'edu-consultancy' ); ?>
				</p>
				<h1 class="edu-hero__title">
					<?php esc_html_e( 'Find Your Perfect Overseas Job & Study Pathway', 'edu-consultancy' ); ?>
				</h1>
				<p class="edu-hero__subtitle">
					<?php esc_html_e( 'Browse international opportunities, apply in a few clicks, and track your migration journey from one simple portal.', 'edu-consultancy' ); ?>
				</p>

				<div class="edu-hero__actions">
					<a class="edu-btn-primary" href="<?php echo esc_url( home_url( '/jobs/' ) ); ?>">
						<?php esc_html_e( 'Find Jobs', 'edu-consultancy' ); ?>
					</a>
					<a class="edu-btn-outline" href="<?php echo esc_url( home_url( '/free-consultation/' ) ); ?>">
						<?php esc_html_e( 'Book Free Consultation', 'edu-consultancy' ); ?>
					</a>
				</div>

				<div class="edu-hero__meta">
					<span><?php esc_html_e( 'Hospitality', 'edu-consultancy' ); ?></span>
					<span><?php esc_html_e( 'Construction', 'edu-consultancy' ); ?></span>
					<span><?php esc_html_e( 'Healthcare', 'edu-consultancy' ); ?></span>
					<span><?php esc_html_e( 'Marketing & HR', 'edu-consultancy' ); ?></span>
				</div>
			</div>

			<div class="edu-hero__image">
				<img src="https://images.pexels.com/photos/1181579/pexels-photo-1181579.jpeg?auto=compress&cs=tinysrgb&w=800" alt="<?php esc_attr_e( 'Students and professionals planning their overseas career', 'edu-consultancy' ); ?>" />
			</div>
		</div>
	</section>

	<section class="edu-section edu-section--light">
		<div class="edu-container">
			<header class="edu-section__header">
				<h2><?php esc_html_e( 'Popular Job Categories', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Focus on in-demand industries across hospitality, construction, HR, healthcare and more.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--4 edu-cards-row">
				<?php if ( ! empty( $job_categories ) && ! is_wp_error( $job_categories ) ) : ?>
					<?php foreach ( $job_categories as $term ) : ?>
						<article class="edu-card edu-card--pill">
							<h3 class="edu-card__title">
								<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
									<?php echo esc_html( $term->name ); ?>
								</a>
							</h3>
							<p class="edu-card__meta">
								<?php
								printf(
									/* translators: %d: job count. */
									esc_html( _n( '%d open position', '%d open positions', (int) $term->count, 'edu-consultancy' ) ),
									(int) $term->count
								);
								?>
							</p>
						</article>
					<?php endforeach; ?>
				<?php else : ?>
					<article class="edu-card edu-card--pill">
						<h3 class="edu-card__title"><?php esc_html_e( 'Hospitality', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'Multiple roles across EU & GCC.', 'edu-consultancy' ); ?></p>
					</article>
					<article class="edu-card edu-card--pill">
						<h3 class="edu-card__title"><?php esc_html_e( 'Construction', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'Skilled and semi-skilled opportunities.', 'edu-consultancy' ); ?></p>
					</article>
					<article class="edu-card edu-card--pill">
						<h3 class="edu-card__title"><?php esc_html_e( 'Healthcare', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'Nursing, support staff and more.', 'edu-consultancy' ); ?></p>
					</article>
					<article class="edu-card edu-card--pill">
						<h3 class="edu-card__title"><?php esc_html_e( 'Marketing & HR', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'Office & corporate placements.', 'edu-consultancy' ); ?></p>
					</article>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header edu-section__header--row">
				<div>
					<h2><?php esc_html_e( 'Featured Jobs', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'Hand-picked roles with strong career growth, fair packages and visa guidance.', 'edu-consultancy' ); ?></p>
				</div>
				<div>
					<a class="site-header__link" href="<?php echo esc_url( home_url( '/jobs/' ) ); ?>">
						<?php esc_html_e( 'View All Jobs', 'edu-consultancy' ); ?>
					</a>
				</div>
			</header>

			<?php
			// Reuse shortcode logic for consistency.
			echo do_shortcode( '[edu_job_grid per_page="6" featured_only="yes"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	</section>

	<section class="edu-section edu-section--light">
		<div class="edu-container">
			<header class="edu-section__header">
				<h2><?php esc_html_e( 'Popular Countries', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Target high-demand destinations with clear visa and PR pathways.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--3 edu-cards-row">
				<?php if ( ! empty( $job_locations ) && ! is_wp_error( $job_locations ) ) : ?>
					<?php foreach ( $job_locations as $location ) : ?>
						<article class="edu-card">
							<h3 class="edu-card__title">
								<a href="<?php echo esc_url( get_term_link( $location ) ); ?>">
									<?php echo esc_html( $location->name ); ?>
								</a>
							</h3>
							<p class="edu-card__meta">
								<?php
								printf(
									/* translators: %d: job count. */
									esc_html( _n( '%d job', '%d jobs', (int) $location->count, 'edu-consultancy' ) ),
									(int) $location->count
								);
								?>
							</p>
						</article>
					<?php endforeach; ?>
				<?php else : ?>
					<article class="edu-card">
						<h3 class="edu-card__title"><?php esc_html_e( 'Dubai', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'Hospitality, retail and corporate roles.', 'edu-consultancy' ); ?></p>
					</article>
					<article class="edu-card">
						<h3 class="edu-card__title"><?php esc_html_e( 'Croatia', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'EU hospitality & seasonal work.', 'edu-consultancy' ); ?></p>
					</article>
					<article class="edu-card">
						<h3 class="edu-card__title"><?php esc_html_e( 'Canada', 'edu-consultancy' ); ?></h3>
						<p class="edu-card__meta"><?php esc_html_e( 'Study + PR track for students.', 'edu-consultancy' ); ?></p>
					</article>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h2><?php esc_html_e( 'Find Jobs in 3 Easy Steps', 'edu-consultancy' ); ?></h2>
			</header>

			<div class="edu-grid edu-grid--3 edu-steps">
				<article class="edu-card edu-step">
					<div class="edu-step__badge">01</div>
					<h3 class="edu-card__title"><?php esc_html_e( 'Register a Free Account', 'edu-consultancy' ); ?></h3>
					<p><?php esc_html_e( 'Sign up as a candidate and complete your basic profile in a few minutes.', 'edu-consultancy' ); ?></p>
				</article>
				<article class="edu-card edu-step">
					<div class="edu-step__badge">02</div>
					<h3 class="edu-card__title"><?php esc_html_e( 'Explore Curated Overseas Jobs', 'edu-consultancy' ); ?></h3>
					<p><?php esc_html_e( 'Filter by country, salary, job type and experience to find the right fit.', 'edu-consultancy' ); ?></p>
				</article>
				<article class="edu-card edu-step">
					<div class="edu-step__badge">03</div>
					<h3 class="edu-card__title"><?php esc_html_e( 'Apply & Track Your Journey', 'edu-consultancy' ); ?></h3>
					<p><?php esc_html_e( 'Submit applications, upload your CV and follow every step with our team.', 'edu-consultancy' ); ?></p>
				</article>
			</div>
		</div>
	</section>

	<section class="edu-section edu-section--accent">
		<div class="edu-container edu-cta">
			<div class="edu-cta__content">
				<h2><?php esc_html_e( 'Ready to Start Your Overseas Journey?', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Book a free consultation to discuss your study, work or PR options with a senior counsellor.', 'edu-consultancy' ); ?></p>
			</div>
			<div class="edu-cta__actions">
				<a class="edu-btn-primary" href="<?php echo esc_url( home_url( '/free-consultation/' ) ); ?>">
					<?php esc_html_e( 'Book Free Consultation', 'edu-consultancy' ); ?>
				</a>
				<a class="edu-btn-outline" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
					<?php esc_html_e( 'Contact Us', 'edu-consultancy' ); ?>
				</a>
			</div>
		</div>
	</section>

	<section class="edu-section">
		<div class="edu-container">
			<?php
			// Allow Elementor or the block editor to append custom content if desired.
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			}
			?>
		</div>
	</section>
</main>

<?php
get_footer();


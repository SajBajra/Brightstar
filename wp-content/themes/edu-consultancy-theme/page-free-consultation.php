<?php
/**
 * Free / Book Consultation page.
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
				<p><?php esc_html_e( 'Share your goals and we will map the best study, work or migration options for you.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--2">
				<div>
					<div class="edu-card">
						<h2 class="edu-card__title"><?php esc_html_e( 'Tell us about yourself', 'edu-consultancy' ); ?></h2>
						<?php
						echo do_shortcode( '[edu_consultation_form]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				</div>
				<div>
					<div class="edu-card">
						<h2 class="edu-card__title"><?php esc_html_e( 'What to expect', 'edu-consultancy' ); ?></h2>
						<ul class="site-footer__links">
							<li><?php esc_html_e( 'A 20–30 minute call with a senior counsellor.', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'High‑level assessment of your study / work options.', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'Clarification on timelines, budgets and next steps.', 'edu-consultancy' ); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


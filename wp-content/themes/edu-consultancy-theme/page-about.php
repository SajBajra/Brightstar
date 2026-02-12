<?php
/**
 * About page template.
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
				<p><?php esc_html_e( 'BrightStar connects students and professionals with trusted global education and migration pathways.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--2">
				<div>
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							the_content();
						}
					}
					?>
				</div>
				<div>
					<div class="edu-card">
						<h2><?php esc_html_e( 'Our Mission', 'edu-consultancy' ); ?></h2>
						<p><?php esc_html_e( 'To simplify study and migration decisions with honest advice, transparent processes and end‑to‑end support.', 'edu-consultancy' ); ?></p>
						<h2><?php esc_html_e( 'Our Vision', 'edu-consultancy' ); ?></h2>
						<p><?php esc_html_e( 'To become a trusted long‑term partner for students, workers and employers across the globe.', 'edu-consultancy' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="edu-section edu-section--light">
		<div class="edu-container">
			<header class="edu-section__header">
				<h2><?php esc_html_e( 'How We Work', 'edu-consultancy' ); ?></h2>
			</header>
			<div class="edu-grid edu-grid--3 edu-steps">
				<article class="edu-card edu-step">
					<div class="edu-step__badge">01</div>
					<h3 class="edu-card__title"><?php esc_html_e( 'Discovery & Eligibility', 'edu-consultancy' ); ?></h3>
					<p><?php esc_html_e( 'We understand your education, work history and goals to shortlist realistic pathways.', 'edu-consultancy' ); ?></p>
				</article>
				<article class="edu-card edu-step">
					<div class="edu-step__badge">02</div>
					<h3 class="edu-card__title"><?php esc_html_e( 'Application & Documentation', 'edu-consultancy' ); ?></h3>
					<p><?php esc_html_e( 'Our team supports university selection, documentation, job matching and visa filing.', 'edu-consultancy' ); ?></p>
				</article>
				<article class="edu-card edu-step">
					<div class="edu-step__badge">03</div>
					<h3 class="edu-card__title"><?php esc_html_e( 'Landing & Ongoing Support', 'edu-consultancy' ); ?></h3>
					<p><?php esc_html_e( 'From pre‑departure to post‑arrival guidance, we stay with you beyond approvals.', 'edu-consultancy' ); ?></p>
				</article>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


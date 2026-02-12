<?php
/**
 * Employer information page.
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
				<p><?php esc_html_e( 'Partner with BrightStar to access vetted international talent for hospitality, construction, healthcare and more.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--3 edu-cards-row">
				<article class="edu-card">
					<h2 class="edu-card__title"><?php esc_html_e( 'Specialised Sectors', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'We focus on hospitality, construction, healthcare, HR and support roles with consistent demand.', 'edu-consultancy' ); ?></p>
				</article>
				<article class="edu-card">
					<h2 class="edu-card__title"><?php esc_html_e( 'Screened Candidates', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'Every applicant goes through profile checks, interview screening and documentation verification.', 'edu-consultancy' ); ?></p>
				</article>
				<article class="edu-card">
					<h2 class="edu-card__title"><?php esc_html_e( 'Visa & Compliance Support', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'We coordinate with your HR and legal teams to ensure smooth visa filing and onboarding.', 'edu-consultancy' ); ?></p>
				</article>
			</div>

			<div style="margin-top: var(--edu-spacing-lg); text-align: center;">
				<a class="edu-btn-primary" href="<?php echo esc_url( home_url( '/employer-dashboard/' ) ); ?>">
					<?php esc_html_e( 'Post a Job', 'edu-consultancy' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


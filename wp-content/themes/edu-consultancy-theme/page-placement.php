<?php
/**
 * Template for Placement / Work & Sponsorship Pathways page.
 * Hero + breadcrumb + content (from Interlace Work & Sponsorship Pathways).
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/' );
?>

<main id="primary" class="site-main">
	<section class="edu-find-jobs-hero edu-page-hero edu-placement-hero" aria-label="<?php esc_attr_e( 'Placement', 'edu-consultancy' ); ?>">
		<div class="edu-find-jobs-hero__overlay"></div>
		<div class="edu-find-jobs-hero__inner">
			<nav class="edu-find-jobs-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'edu-consultancy' ); ?>">
				<ol class="edu-find-jobs-hero__breadcrumb-list">
					<li class="edu-find-jobs-hero__breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edu-consultancy' ); ?></a>
					</li>
					<li class="edu-find-jobs-hero__breadcrumb-item edu-find-jobs-hero__breadcrumb-item--current" aria-current="page">
						<?php esc_html_e( 'Placement', 'edu-consultancy' ); ?>
					</li>
				</ol>
			</nav>
			<h1 class="edu-find-jobs-hero__title"><?php esc_html_e( 'Work &amp; Sponsorship Pathways', 'edu-consultancy' ); ?></h1>
			<p class="edu-find-jobs-hero__description"><?php esc_html_e( 'Connecting skilled professionals with employers through genuine opportunities.', 'edu-consultancy' ); ?></p>
		</div>
	</section>

	<div class="edu-container">
		<div class="edu-page-content edu-placement-content">
			<div class="edu-placement-intro">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Connecting Skilled Professionals with Australian Employers', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( "We don't just guide students and migrants—we help skilled individuals and employers connect through genuine opportunities. As a trusted education, migration, and visa consultancy, we work closely with both employers seeking qualified workers and skilled individuals looking for sponsorship pathways in Australia.", 'edu-consultancy' ); ?></p>
				<p><strong><?php esc_html_e( "Let's build your future together.", 'edu-consultancy' ); ?></strong> <?php esc_html_e( 'Contact us today to discuss work &amp; sponsorship opportunities.', 'edu-consultancy' ); ?></p>
				<p class="edu-placement-intro__cta">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Contact Us', 'edu-consultancy' ); ?></a>
				</p>
			</div>

			<section class="edu-placement-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'For Employers', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Finding the right employee can be challenging, especially in industries facing skill shortages. Many Australian businesses rely on us to connect them with suitable candidates who are qualified, experienced, and ready to contribute. We maintain an active database of professionals from diverse fields who have undergone skills assessment and are eligible to work or apply for employer-sponsored visas.', 'edu-consultancy' ); ?></p>
				<h3 class="edu-page-content__subheading"><?php esc_html_e( 'What we offer employers:', 'edu-consultancy' ); ?></h3>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Access to pre-screened, job-ready candidates', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Support with sponsorship and visa processes', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Guidance on visa compliance and documentation', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'End-to-end assistance until successful placement', 'edu-consultancy' ); ?></li>
				</ul>
			</section>

			<section class="edu-placement-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'For Skilled Workers', 'edu-consultancy' ); ?></h2>
				<p><strong><?php esc_html_e( 'Are you a qualified professional looking for job sponsorship or PR opportunities in Australia?', 'edu-consultancy' ); ?></strong> <?php esc_html_e( 'We can help bridge the gap between you and employers actively seeking skilled workers. Through our strong network and understanding of migration pathways, we connect you with genuine employment opportunities that may lead to long-term sponsorship or permanent residency.', 'edu-consultancy' ); ?></p>
				<h3 class="edu-page-content__subheading"><?php esc_html_e( 'What we offer skilled professionals:', 'edu-consultancy' ); ?></h3>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Job-matching with verified Australian employers', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Guidance on Employer-Sponsored Visa options (subclass 482, 186, etc.)', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Assistance with skills assessment and eligibility checks', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Support through documentation, application, and visa lodgement stages', 'edu-consultancy' ); ?></li>
				</ul>
			</section>

			<section class="edu-placement-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Hiring Process for a Company', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'We make the connection between skilled professionals and Australian employers simple and transparent. Our step-by-step process ensures both parties are supported from the first conversation to successful placement and visa approval.', 'edu-consultancy' ); ?></p>
				<p class="edu-placement-section__cta">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Start Now', 'edu-consultancy' ); ?></a>
				</p>
			</section>

			<section class="edu-placement-section edu-placement-partner">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Our Placement Partner', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Empowering students with real industry experience through our trusted placement partners. Together, we bridge the gap between education and meaningful employment opportunities, helping students build confidence, gain practical skills, and launch successful careers in their chosen fields.', 'edu-consultancy' ); ?></p>
			</section>
		</div>
	</div>
</main>

<?php
get_footer();

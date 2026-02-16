<?php
/**
 * Template for Placement / Work & Sponsorship Pathways page.
 * Hero + highlights + content with alternating sections and CTA band.
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

<main id="primary" class="site-main edu-placement-page">
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

	<div class="edu-placement-highlights">
		<div class="edu-container">
			<div class="edu-placement-highlights__grid">
				<div class="edu-placement-highlights__item">
					<span class="edu-placement-highlights__icon" aria-hidden="true">&#9679;</span>
					<span class="edu-placement-highlights__label"><?php esc_html_e( 'Pre-screened candidates', 'edu-consultancy' ); ?></span>
				</div>
				<div class="edu-placement-highlights__item">
					<span class="edu-placement-highlights__icon" aria-hidden="true">&#9679;</span>
					<span class="edu-placement-highlights__label"><?php esc_html_e( 'Verified employers', 'edu-consultancy' ); ?></span>
				</div>
				<div class="edu-placement-highlights__item">
					<span class="edu-placement-highlights__icon" aria-hidden="true">&#9679;</span>
					<span class="edu-placement-highlights__label"><?php esc_html_e( 'Visa & sponsorship support', 'edu-consultancy' ); ?></span>
				</div>
				<div class="edu-placement-highlights__item">
					<span class="edu-placement-highlights__icon" aria-hidden="true">&#9679;</span>
					<span class="edu-placement-highlights__label"><?php esc_html_e( 'End-to-end placement', 'edu-consultancy' ); ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="edu-container">
		<div class="edu-page-content edu-placement-content">
			<section id="placement-intro" class="edu-page-block edu-placement-intro edu-placement-section edu-placement-section--light">
				<div class="edu-page-block__text">
					<h2 class="edu-placement-heading"><?php esc_html_e( 'Connecting Skilled Professionals with Australian Employers', 'edu-consultancy' ); ?></h2>
					<p class="edu-placement-lead"><?php esc_html_e( "We don't just guide students and migrants—we help skilled individuals and employers connect through genuine opportunities. As a trusted education, migration, and visa consultancy, we work closely with both employers seeking qualified workers and skilled individuals looking for sponsorship pathways in Australia.", 'edu-consultancy' ); ?></p>
					<p class="edu-placement-intro__cta">
						<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Contact Us Today', 'edu-consultancy' ); ?></a>
					</p>
				</div>
				<div class="edu-page-block__media">
					<img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Team collaboration', 'edu-consultancy' ); ?>" loading="lazy" />
				</div>
			</section>

			<section id="placement-employers" class="edu-placement-card-section">
				<div class="edu-placement-card edu-placement-card--employers">
					<div class="edu-placement-card__media">
						<img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Business meeting', 'edu-consultancy' ); ?>" loading="lazy" />
					</div>
					<div class="edu-placement-card__body">
						<h2 class="edu-placement-heading"><?php esc_html_e( 'For Employers', 'edu-consultancy' ); ?></h2>
						<p><?php esc_html_e( 'Finding the right employee can be challenging, especially in industries facing skill shortages. Many Australian businesses rely on us to connect them with suitable candidates who are qualified, experienced, and ready to contribute.', 'edu-consultancy' ); ?></p>
						<h3 class="edu-placement-subheading"><?php esc_html_e( 'What we offer employers:', 'edu-consultancy' ); ?></h3>
						<ul class="edu-placement-list">
							<li><?php esc_html_e( 'Access to pre-screened, job-ready candidates', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'Support with sponsorship and visa processes', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'Guidance on visa compliance and documentation', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'End-to-end assistance until successful placement', 'edu-consultancy' ); ?></li>
						</ul>
					</div>
				</div>
			</section>

			<section id="placement-workers" class="edu-placement-section edu-placement-section--light">
				<div class="edu-placement-card edu-placement-card--workers">
					<div class="edu-placement-card__body">
						<h2 class="edu-placement-heading"><?php esc_html_e( 'For Skilled Workers', 'edu-consultancy' ); ?></h2>
						<p><strong><?php esc_html_e( 'Are you a qualified professional looking for job sponsorship or PR opportunities in Australia?', 'edu-consultancy' ); ?></strong> <?php esc_html_e( 'We can help bridge the gap between you and employers actively seeking skilled workers. Through our strong network and understanding of migration pathways, we connect you with genuine employment opportunities that may lead to long-term sponsorship or permanent residency.', 'edu-consultancy' ); ?></p>
						<h3 class="edu-placement-subheading"><?php esc_html_e( 'What we offer skilled professionals:', 'edu-consultancy' ); ?></h3>
						<ul class="edu-placement-list">
							<li><?php esc_html_e( 'Job-matching with verified Australian employers', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'Guidance on Employer-Sponsored Visa options (subclass 482, 186, etc.)', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'Assistance with skills assessment and eligibility checks', 'edu-consultancy' ); ?></li>
							<li><?php esc_html_e( 'Support through documentation, application, and visa lodgement stages', 'edu-consultancy' ); ?></li>
						</ul>
					</div>
					<div class="edu-placement-card__media">
						<img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Professional at work', 'edu-consultancy' ); ?>" loading="lazy" />
					</div>
				</div>
			</section>

			<section id="placement-process" class="edu-placement-process">
				<h2 class="edu-placement-heading edu-placement-process__title"><?php esc_html_e( 'Hiring Process', 'edu-consultancy' ); ?></h2>
				<p class="edu-placement-process__intro"><?php esc_html_e( 'We make the connection between skilled professionals and Australian employers simple and transparent. Our step-by-step process ensures both parties are supported from the first conversation to successful placement and visa approval.', 'edu-consultancy' ); ?></p>
				<div class="edu-placement-process__steps">
					<div class="edu-placement-process__step">
						<span class="edu-placement-process__num">1</span>
						<h3 class="edu-placement-process__step-title"><?php esc_html_e( 'Consultation', 'edu-consultancy' ); ?></h3>
						<p><?php esc_html_e( 'We understand your needs—whether you\'re an employer or a skilled professional—and outline the best pathway.', 'edu-consultancy' ); ?></p>
					</div>
					<div class="edu-placement-process__step">
						<span class="edu-placement-process__num">2</span>
						<h3 class="edu-placement-process__step-title"><?php esc_html_e( 'Matching', 'edu-consultancy' ); ?></h3>
						<p><?php esc_html_e( 'We connect the right candidates with the right employers based on skills, experience, and visa eligibility.', 'edu-consultancy' ); ?></p>
					</div>
					<div class="edu-placement-process__step">
						<span class="edu-placement-process__num">3</span>
						<h3 class="edu-placement-process__step-title"><?php esc_html_e( 'Documentation & Visa', 'edu-consultancy' ); ?></h3>
						<p><?php esc_html_e( 'We guide both parties through sponsorship, visa application, and compliance requirements.', 'edu-consultancy' ); ?></p>
					</div>
					<div class="edu-placement-process__step">
						<span class="edu-placement-process__num">4</span>
						<h3 class="edu-placement-process__step-title"><?php esc_html_e( 'Placement', 'edu-consultancy' ); ?></h3>
						<p><?php esc_html_e( 'We support until the candidate is successfully placed and the visa is approved.', 'edu-consultancy' ); ?></p>
					</div>
				</div>
				<p class="edu-placement-process__cta">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Start Now', 'edu-consultancy' ); ?></a>
				</p>
			</section>

			<section id="placement-partner" class="edu-page-block edu-placement-partner">
				<div class="edu-page-block__text">
					<h2 class="edu-placement-heading"><?php esc_html_e( 'Our Placement Partner', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'Empowering students with real industry experience through our trusted placement partners. Together, we bridge the gap between education and meaningful employment opportunities, helping students build confidence, gain practical skills, and launch successful careers in their chosen fields.', 'edu-consultancy' ); ?></p>
				</div>
				<div class="edu-page-block__media">
					<img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Team success', 'edu-consultancy' ); ?>" loading="lazy" />
				</div>
			</section>

			<section class="edu-placement-cta-band">
				<div class="edu-container">
					<h2 class="edu-placement-cta-band__title"><?php esc_html_e( 'Ready to connect?', 'edu-consultancy' ); ?></h2>
					<p class="edu-placement-cta-band__text"><?php esc_html_e( 'Whether you\'re an employer seeking skilled talent or a professional looking for sponsorship—we\'re here to help.', 'edu-consultancy' ); ?></p>
					<p class="edu-placement-cta-band__btn">
						<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary edu-btn-primary--large"><?php esc_html_e( 'Contact Us', 'edu-consultancy' ); ?></a>
					</p>
				</div>
			</section>
		</div>
	</div>
</main>

<?php
get_footer();

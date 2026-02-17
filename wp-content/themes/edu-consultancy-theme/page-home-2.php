<?php
/**
 * Template Name: Home 2 (Interlace Replica)
 * Full replica of Interlace.com.au UI, layout, and content structure.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueue Google Fonts (Poppins – Interlace-style typography).
wp_enqueue_style(
	'home-2-interlace-fonts',
	'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
	array(),
	null
);
// Enqueue Interlace replica styles (before any output).
wp_enqueue_style(
	'home-2-interlace',
	get_template_directory_uri() . '/assets/css/home-2-interlace.css',
	array( 'home-2-interlace-fonts' ),
	'2.0'
);

$home_url = home_url( '/' );
$contact_url = '';
$contact_page = get_page_by_path( 'contact' );
if ( $contact_page ) {
	$contact_url = get_permalink( $contact_page );
} else {
	$contact_url = $home_url;
}
$jobs_url = get_post_type_archive_link( 'jobs' ) ?: home_url( '/jobs/' );
$about_url = '';
$about_page = get_page_by_path( 'about-us' );
if ( $about_page ) {
	$about_url = get_permalink( $about_page );
} else {
	$about_url = $home_url;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body class="page-home-2 interlace-replica">
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<!-- Interlace-style header -->
<header class="il-header">
	<div class="il-header__top">
		<div class="il-container il-header__top-inner">
			<div class="il-header__locale">
				<span class="il-header__flag">🇦🇺</span>
				<span class="il-header__locale-label">AUS</span>
				<select class="il-header__locale-select" aria-label="Choose country">
					<option value="au">Australia</option>
					<option value="np">Nepal</option>
					<option value="id">Indonesia</option>
					<option value="kh">Cambodia</option>
					<option value="jp">Japan</option>
					<option value="fj">Fiji</option>
				</select>
			</div>
			<div class="il-header__contact">
				<a href="tel:1300365423" class="il-header__phone">1300 365 423</a>
				<a href="mailto:info@interlace.com.au" class="il-header__email">info@interlace.com.au</a>
			</div>
		</div>
	</div>
	<div class="il-header__main">
		<div class="il-container il-header__main-inner">
			<a href="<?php echo esc_url( $home_url ); ?>" class="il-header__logo" aria-label="Interlace Studies Home">
				<span class="il-header__logo-text">Interlace</span>
			</a>
			<nav class="il-nav" aria-label="Main navigation">
				<ul class="il-nav__list">
					<li class="il-nav__item il-nav__item--has-dropdown">
						<a href="<?php echo esc_url( $home_url ); ?>#career" class="il-nav__link">Career</a>
						<ul class="il-nav__dropdown">
							<li><a href="<?php echo esc_url( $home_url ); ?>#employer-sponsored">Employer Sponsored Visa</a></li>
							<li><a href="<?php echo esc_url( $home_url ); ?>#skilled">Skilled Visa</a></li>
							<li><a href="<?php echo esc_url( $home_url ); ?>#family">Family Visa</a></li>
							<li><a href="<?php echo esc_url( $home_url ); ?>#study">Study Visa</a></li>
						</ul>
					</li>
					<li class="il-nav__item"><a href="<?php echo esc_url( $home_url ); ?>#courses" class="il-nav__link">Courses</a></li>
					<li class="il-nav__item"><a href="<?php echo esc_url( $home_url ); ?>#help" class="il-nav__link">Help/Support</a></li>
					<li class="il-nav__item"><a href="<?php echo esc_url( $home_url ); ?>#resources" class="il-nav__link">Resources</a></li>
					<li class="il-nav__item"><a href="<?php echo esc_url( $home_url ); ?>#event" class="il-nav__link">Event</a></li>
					<li class="il-nav__item"><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'jrp' ) ) ?: $home_url ); ?>" class="il-nav__link">JRP</a></li>
					<li class="il-nav__item"><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'placement' ) ) ?: $home_url ); ?>" class="il-nav__link">Placement</a></li>
				</ul>
			</nav>
			<div class="il-header__actions">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--outline">Talk to Counselor</a>
				<a href="<?php echo esc_url( $home_url ); ?>#gsm" class="il-btn il-btn--primary">GSM Points Check</a>
			</div>
			<button type="button" class="il-header__menu-toggle" aria-label="Toggle menu" aria-expanded="false">
				<span class="il-header__menu-icon"></span>
			</button>
		</div>
	</div>
</header>

<main class="il-main">

	<!-- Hero -->
	<section class="il-hero">
		<div class="il-hero__media">
			<video class="il-hero__video" poster="" muted playsinline loop aria-hidden="true">
				<source src="" type="video/mp4">
				Your browser does not support the video tag.
			</video>
			<div class="il-hero__overlay"></div>
		</div>
		<div class="il-container il-hero__inner">
			<h1 class="il-hero__title">Your Journey to Global Learning, Migration, and Beyond Starts Here</h1>
			<p class="il-hero__subtitle">At Interlace Studies, we transform international ambitions into real-world achievements. Whether you're looking to study abroad, migrate, or begin a new chapter overseas, our Interlace team is here to guide you every step of the way.</p>
			<div class="il-hero__ctas">
				<a href="<?php echo esc_url( $home_url ); ?>#services" class="il-btn il-btn--primary il-btn--lg">
					<span class="il-btn__icon">Take Service</span>
				</a>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--secondary il-btn--lg">
					<span class="il-btn__icon">Book An Appointment</span>
				</a>
			</div>
		</div>
	</section>

	<!-- Services strip -->
	<section class="il-services-strip" id="services">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Set off with the right visa guidance</h2>
			<p class="il-section__subtitle">We simplify your study abroad journey, from choosing courses to managing visas, health insurance, and language preparation. Our expert team ensures a smooth transition, helping you pursue your dream education with confidence.</p>
			<div class="il-services-strip__grid">
				<div class="il-service-card">
					<div class="il-service-card__icon">📚</div>
					<h3 class="il-service-card__title">Academic Service</h3>
					<p class="il-service-card__desc">Select the perfect course and reach your goals.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">🛂</div>
					<h3 class="il-service-card__title">Migration Service</h3>
					<p class="il-service-card__desc">Get expert support for a smooth visa process.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">💼</div>
					<h3 class="il-service-card__title">Job Ready Program</h3>
					<p class="il-service-card__desc">Join job ready programs to boost employability.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">✓</div>
					<h3 class="il-service-card__title">Skills Assessment</h3>
					<p class="il-service-card__desc">Get your qualifications assessed by authorities.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">📅</div>
					<h3 class="il-service-card__title">Visa Extension</h3>
					<p class="il-service-card__desc">Visa expiring? Get expert help from our professionals.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">⚖️</div>
					<h3 class="il-service-card__title">Visa Appeal Support</h3>
					<p class="il-service-card__desc">Visa refused? Get expert appeal help from our experts.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">📝</div>
					<h3 class="il-service-card__title">Test Preparation</h3>
					<p class="il-service-card__desc">Prepare for PTE/IELTS with expert training support.</p>
				</div>
				<div class="il-service-card">
					<div class="il-service-card__icon">🏥</div>
					<h3 class="il-service-card__title">Health Coverage</h3>
					<p class="il-service-card__desc">Get access to reliable, affordable medical care.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Affiliations -->
	<section class="il-trust">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Our Affiliations &amp; Membership</h2>
			<p class="il-trust__text">Interlace Studies is a trusted education and migration consultancy, officially licensed with MARN and proudly ICEF certified, ensuring ethical, professional, and globally recognized guidance for your visa and study journey.</p>
		</div>
	</section>

	<!-- Stats -->
	<section class="il-stats">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Why choose Interlace?</h2>
			<p class="il-stats__lead">With years of experience and proven success, we guide individuals to the right courses, institutions, migration pathways, and PR pathways based on their goals. Our personalised support ensures positive outcomes across study, career, and migration.</p>
			<div class="il-stats__grid">
				<div class="il-stat">
					<span class="il-stat__value">7+</span>
					<span class="il-stat__label">Years of Immigration Experience</span>
				</div>
				<div class="il-stat">
					<span class="il-stat__value">1200+</span>
					<span class="il-stat__label">Permanent Residency Grants</span>
				</div>
				<div class="il-stat">
					<span class="il-stat__value">300+</span>
					<span class="il-stat__label">University &amp; College Partners</span>
				</div>
				<div class="il-stat">
					<span class="il-stat__value">250+</span>
					<span class="il-stat__label">Partner &amp; Family Visas Processed</span>
				</div>
				<div class="il-stat">
					<span class="il-stat__value">2500+</span>
					<span class="il-stat__label">Students in Leading Colleges</span>
				</div>
			</div>
		</div>
	</section>

	<!-- Value props -->
	<section class="il-value-props">
		<div class="il-container">
			<div class="il-value-props__grid">
				<div class="il-value-prop">
					<div class="il-value-prop__icon">★</div>
					<h3 class="il-value-prop__title">Expert Guidance</h3>
					<p class="il-value-prop__text">Industry leading professionals providing trusted immigration consultation and support.</p>
				</div>
				<div class="il-value-prop">
					<div class="il-value-prop__icon">🌐</div>
					<h3 class="il-value-prop__title">Global Network</h3>
					<p class="il-value-prop__text">Access worldwide connections for education, visas, and opportunities abroad.</p>
				</div>
				<div class="il-value-prop">
					<div class="il-value-prop__icon">📋</div>
					<h3 class="il-value-prop__title">Personalised Strategy</h3>
					<p class="il-value-prop__text">A custom roadmap designed specifically for your unique goals.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Editorial + CTA -->
	<section class="il-editorial">
		<div class="il-container">
			<h2 class="il-section__title">Australian Education and Migration Consultants</h2>
			<p class="il-editorial__tagline"><strong>Rely on us for your study and migration journey.</strong></p>
			<p class="il-editorial__body">Your journey abroad begins with understanding your status. Whether you're a citizen, permanent resident, or planning a fresh start in a new country, knowing where you stand is essential. At Interlace Studies, we make the process easy and guide you to the best path. Every journey is unique, and we're here to help you find the options that match your education and migration goals. Let's work together to make your dreams of studying abroad come true. We're with you every step of the way.</p>
			<ul class="il-editorial__list">
				<li>Explore top countries for study and career growth</li>
				<li>Connect your background with the right global opportunities</li>
				<li>Understand visa requirements with clarity and confidence</li>
			</ul>
			<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--primary il-btn--lg">Get Started</a>
		</div>
	</section>

	<!-- Why Australia -->
	<section class="il-why-australia">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Why Choose Australia</h2>
			<p class="il-section__subtitle">A Leading Destination for International Students</p>
			<p class="il-why-australia__intro">Australia is one of the most sought-after study destinations, and for good reason. Interlace Studies has helped thousands of students find their place in leading institutions, secure visas with ease, and earn valuable scholarships. With our strong network of trusted partners.</p>
			<div class="il-why-australia__grid">
				<div class="il-why-card">
					<h3 class="il-why-card__title">9 in top 100 universities</h3>
					<p class="il-why-card__desc">Gain entry to globally acclaimed institutions known for their academic excellence and prestige worldwide.</p>
				</div>
				<div class="il-why-card">
					<h3 class="il-why-card__title">95% universities Top Ranked</h3>
					<p class="il-why-card__desc">Select from diverse programs at highly-rated universities.</p>
				</div>
				<div class="il-why-card">
					<h3 class="il-why-card__title">6 in top 50 student cities</h3>
					<p class="il-why-card__desc">Experience vibrant student life in world-class cities known for safety, culture, and communities.</p>
				</div>
				<div class="il-why-card">
					<h3 class="il-why-card__title">Post-Study Work Paths</h3>
					<p class="il-why-card__desc">Seek foreign job experience and establish your career overseas after graduation.</p>
				</div>
			</div>
			<p class="il-why-australia__cta"><a href="<?php echo esc_url( $home_url ); ?>#why" class="il-btn il-btn--outline">Explore More</a></p>
		</div>
	</section>

	<!-- JRP section -->
	<section class="il-jrp">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Enhance your career with the Job Ready Program</h2>
			<p class="il-jrp__lead">Our Job Ready Program equips graduates with the practical skills, professional communication, and real-world experience employers are looking for. From workplace training to internships, we prepare you to enter the job market with confidence and competence.</p>
			<div class="il-jrp__grid">
				<div class="il-jrp-card">
					<div class="il-jrp-card__icon">📈</div>
					<h3 class="il-jrp-card__title">Skill Enhancement &amp; Industry Training</h3>
					<p class="il-jrp-card__desc">The program focuses on bridging the gap between academic knowledge and real-world job requirements.</p>
				</div>
				<div class="il-jrp-card">
					<div class="il-jrp-card__icon">💬</div>
					<h3 class="il-jrp-card__title">Communication &amp; Workplace Etiquette</h3>
					<p class="il-jrp-card__desc">Learn how to communicate effectively in a professional setting, handle interviews, write resumes and cover letters.</p>
				</div>
				<div class="il-jrp-card">
					<div class="il-jrp-card__icon">🤝</div>
					<h3 class="il-jrp-card__title">Internship &amp; Work Placement Opportunities</h3>
					<p class="il-jrp-card__desc">The program connects participants with internships and industry placements, giving you hands-on experience and real projects.</p>
				</div>
				<div class="il-jrp-card">
					<div class="il-jrp-card__icon">🎯</div>
					<h3 class="il-jrp-card__title">Career Coaching &amp; Job Search Support</h3>
					<p class="il-jrp-card__desc">Participants receive tailored career mentoring, LinkedIn profile optimization, job search strategies, and support in navigating the competitive Australian job market.</p>
				</div>
			</div>
			<p class="il-jrp__cta"><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'jrp' ) ) ?: $home_url ); ?>" class="il-btn il-btn--primary">Learn More</a></p>
		</div>
	</section>

	<!-- Services carousel strip -->
	<section class="il-services-carousel">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Find out how we assist students like you achieve outstanding results.</h2>
			<div class="il-services-carousel__track">
				<div class="il-services-carousel__slide">
					<div class="il-services-carousel__card">
						<div class="il-services-carousel__card-icon">🎓</div>
						<h3 class="il-services-carousel__card-title">Career Counseling</h3>
						<p class="il-services-carousel__card-desc">Career counselling is at the heart of what we do. We guide students to the right course and institution with expert advice, assessments, and personalised support.</p>
						<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--outline">Get Guidance → Start Now</a>
					</div>
				</div>
				<div class="il-services-carousel__slide">
					<div class="il-services-carousel__card">
						<div class="il-services-carousel__card-icon">🏫</div>
						<h3 class="il-services-carousel__card-title">University Admission</h3>
						<p class="il-services-carousel__card-desc">We guide international students through every step of the admissions process—choosing the right institution, applying correctly, and securing successful placements.</p>
						<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--outline">Apply Now → Expert Support</a>
					</div>
				</div>
				<div class="il-services-carousel__slide">
					<div class="il-services-carousel__card">
						<div class="il-services-carousel__card-icon">🛂</div>
						<h3 class="il-services-carousel__card-title">Migration Services</h3>
						<p class="il-services-carousel__card-desc">We assist with visas and migration for study, work, and post study stay in Australia, offering expert guidance, reliable advice, and full support throughout the process.</p>
						<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--outline">Migrate Now → Migration Planning</a>
					</div>
				</div>
				<div class="il-services-carousel__slide">
					<div class="il-services-carousel__card">
						<div class="il-services-carousel__card-icon">💼</div>
						<h3 class="il-services-carousel__card-title">Job ready Programs</h3>
						<p class="il-services-carousel__card-desc">Our Job Ready program helps international students build essential skills, prepare strong resumes, and succeed in job searches and interviews across Australia.</p>
						<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'jrp' ) ) ?: $home_url ); ?>" class="il-btn il-btn--outline">Be Job-Ready → Stay Informed</a>
					</div>
				</div>
			</div>
			<nav class="il-services-carousel__nav" aria-label="Carousel navigation">
				<button type="button" class="il-carousel-prev" aria-label="Previous">← Previous</button>
				<button type="button" class="il-carousel-next" aria-label="Next">Next →</button>
			</nav>
		</div>
	</section>

	<!-- Consultation form -->
	<section class="il-consultation" id="book">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Start Your Application with Us Today</h2>
			<p class="il-section__subtitle">Whether you're planning to study abroad or migrate, we're here to help every step of the way.</p>
			<div class="il-consultation__tabs">
				<button type="button" class="il-tab il-tab--active" data-tab="migration">Migration Consultation</button>
				<button type="button" class="il-tab" data-tab="education">Education Consultation</button>
				<button type="button" class="il-tab" data-tab="service">Take a Service</button>
			</div>
			<div class="il-consultation__durations">
				<span class="il-consultation__duration-label">Select Duration</span>
				<div class="il-consultation__duration-options">
					<label><input type="radio" name="duration" value="5"> 5 MIN</label>
					<label><input type="radio" name="duration" value="30"> 30 MIN</label>
					<label><input type="radio" name="duration" value="60" checked> 60 MIN</label>
					<label><input type="radio" name="duration" value="90"> 90 MIN</label>
				</div>
			</div>
			<form class="il-consultation__form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="edu_submit_consultation_booking">
				<h3 class="il-consultation__form-title">Book A Consultation</h3>
				<div class="il-form-row il-form-row--two">
					<p class="il-form-field">
						<label for="il-first-name">First Name *</label>
						<input type="text" id="il-first-name" name="first_name" required>
					</p>
					<p class="il-form-field">
						<label for="il-last-name">Last Name *</label>
						<input type="text" id="il-last-name" name="last_name" required>
					</p>
				</div>
				<div class="il-form-row il-form-row--two">
					<p class="il-form-field">
						<label for="il-email">Email *</label>
						<input type="email" id="il-email" name="email" required>
					</p>
					<p class="il-form-field">
						<label for="il-phone">Phone Number *</label>
						<input type="tel" id="il-phone" name="phone" required>
					</p>
				</div>
				<div class="il-form-row">
					<p class="il-form-field">
						<label for="il-consult-type">Consultation Type *</label>
						<select id="il-consult-type" name="consultation_type" required>
							<option value="">Choose Type</option>
							<option value="study">Study Visa</option>
							<option value="pr">PR Visa</option>
							<option value="family">Family Visa</option>
							<option value="employer">Employer sponsored visa</option>
						</select>
					</p>
				</div>
				<div class="il-form-row il-form-row--two">
					<p class="il-form-field">
						<label for="il-date">Select your available date *</label>
						<input type="date" id="il-date" name="date" required>
					</p>
					<p class="il-form-field">
						<label for="il-method">Preferred Method *</label>
						<select id="il-method" name="preferred_method" required>
							<option value="">Select Preferred Method</option>
							<option value="callback">Request A Callback</option>
							<option value="office">Office Visit</option>
						</select>
					</p>
				</div>
				<div class="il-form-row">
					<p class="il-form-field">
						<label for="il-branch">Preferred Branches *</label>
						<select id="il-branch" name="preferred_branch" required>
							<option value="">Select Preferred Branches</option>
							<option value="adelaide">Adelaide</option>
							<option value="brisbane">Brisbane</option>
							<option value="perth">Perth</option>
							<option value="sydney">Sydney</option>
							<option value="bali">Bali</option>
							<option value="cambodia">Cambodia</option>
							<option value="nepal">Nepal</option>
							<option value="japan">Japan</option>
						</select>
					</p>
				</div>
				<div class="il-form-row">
					<p class="il-form-field">
						<label for="il-time">Select visit Time</label>
						<input type="time" id="il-time" name="time">
					</p>
				</div>
				<div class="il-form-row">
					<p class="il-form-field">
						<label for="il-message">Anything specific you'd like to know?</label>
						<textarea id="il-message" name="message" rows="3"></textarea>
					</p>
				</div>
				<p class="il-consultation__disclaimer">Consultation details via email or WhatsApp. If you have any questions, feel free to contact us at info@interlace.com.au.</p>
				<button type="submit" class="il-btn il-btn--primary il-btn--lg">Submit</button>
			</form>
		</div>
	</section>

	<!-- Social proof band -->
	<section class="il-proof">
		<div class="il-container">
			<p class="il-proof__stat">85% of graduates secure jobs within 6 months of completing the program.</p>
			<h2 class="il-section__title il-section__title--center">Your Global Career Starts Here</h2>
			<p class="il-proof__tagline">Shape your education into a rewarding career in Australia.</p>
			<ul class="il-proof__list">
				<li>Strong Job Market</li>
				<li>Competitive Salaries</li>
				<li>Post-Study Work Visas</li>
				<li>High Quality of Life</li>
				<li>Work-Life Balance</li>
				<li>Pathway to Permanent Residency</li>
			</ul>
			<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--primary il-btn--lg">Book a Consultation</a>
		</div>
	</section>

	<!-- Testimonials -->
	<section class="il-testimonials">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">The Impact We're Proud Of</h2>
			<p class="il-section__subtitle">Witness the incredible results our students have achieved.</p>
			<div class="il-testimonials__tabs">
				<button type="button" class="il-tab il-tab--active">Client Feedback</button>
				<button type="button" class="il-tab">Employer Sponsored Visa</button>
				<button type="button" class="il-tab">Family Visa</button>
				<button type="button" class="il-tab">Skilled Visa</button>
				<button type="button" class="il-tab">Study Visa</button>
			</div>
			<div class="il-testimonials__carousel">
				<div class="il-testimonial">Video / testimonial placeholder 1</div>
				<div class="il-testimonial">Video / testimonial placeholder 2</div>
				<div class="il-testimonial">Video / testimonial placeholder 3</div>
			</div>
			<nav class="il-testimonials__nav" aria-label="Testimonials navigation">
				<button type="button" class="il-carousel-prev" aria-label="Previous">←</button>
				<button type="button" class="il-carousel-next" aria-label="Next">→</button>
			</nav>
		</div>
	</section>

	<!-- Education partners -->
	<section class="il-partners">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Our Education Partners</h2>
			<p class="il-section__subtitle">Promoting trusted, innovative partnerships to empower brighter futures.</p>
			<div class="il-partners__carousel">
				<div class="il-partner">SYDNEY POLYTECHNIC INSTITUTE</div>
				<div class="il-partner">Central Queensland University – 160 Ann St, Brisbane City</div>
				<div class="il-partner">IKON INSTITUTE OF AUSTRALIA – Edward Street, Brisbane City Queensland</div>
				<div class="il-partner">IHNA Australia – St.Georges Terrace, Perth</div>
				<div class="il-partner">IHM Australia – 1 Wentworth St, Parramatta NSW 2150</div>
				<div class="il-partner">HOLMES INSTITUTE – Melbourne</div>
				<div class="il-partner">EDUCATION CENTRE OF AUSTRALIA – Melbourne</div>
				<div class="il-partner">ACKNOWLEDGE EDUCATION – 168 Exhibition Street, Melbourne</div>
			</div>
			<nav class="il-partners__nav" aria-label="Partners carousel">
				<button type="button" class="il-carousel-prev" aria-label="Previous">←</button>
				<button type="button" class="il-carousel-next" aria-label="Next">→</button>
			</nav>
		</div>
	</section>

	<!-- Blog preview -->
	<section class="il-blogs">
		<div class="il-container">
			<h2 class="il-section__title il-section__title--center">Our Blogs</h2>
			<div class="il-blogs__grid">
				<article class="il-blog-card">
					<div class="il-blog-card__meta">Uncategorized · 20/10/2025</div>
					<h3 class="il-blog-card__title">NSW Interim Skilled Visa Quota Announced for 2025–26: What It Means for Your Australian Journey</h3>
					<p class="il-blog-card__excerpt">The Australian migration landscape has a new update: the NSW Government has received an interim allocation from the Department of Home Affairs for the 2025–26…</p>
					<a href="<?php echo esc_url( $home_url ); ?>#blog" class="il-blog-card__link">Learn More</a>
				</article>
				<article class="il-blog-card">
					<div class="il-blog-card__meta">Uncategorized · 09/10/2025</div>
					<h3 class="il-blog-card__title">How IT Graduates Can Build a Career in Australia: From Internships to PR</h3>
					<p class="il-blog-card__excerpt">For many international IT graduates, the path from graduation to a stable career and, ultimately, permanent residency (PR) can feel fragmented…</p>
					<a href="<?php echo esc_url( $home_url ); ?>#blog" class="il-blog-card__link">Learn More</a>
				</article>
				<article class="il-blog-card">
					<div class="il-blog-card__meta">Uncategorized · 25/09/2025</div>
					<h3 class="il-blog-card__title">Your Australian Dream Calling? Visa Ready?</h3>
					<p class="il-blog-card__excerpt">Dreaming sunny beaches, thriving career, world class lifestyle? pictured life Australia. build well structured plan make happen…</p>
					<a href="<?php echo esc_url( $home_url ); ?>#blog" class="il-blog-card__link">Learn More</a>
				</article>
			</div>
		</div>
	</section>

	<!-- Footer CTA -->
	<section class="il-footer-cta">
		<div class="il-container">
			<h2 class="il-footer-cta__title">Get Visa Answers, Fast and Easy</h2>
			<p class="il-footer-cta__text">Clear guidance on documentation, timelines, and the best visa options for your educational journey.</p>
			<a href="<?php echo esc_url( $contact_url ); ?>" class="il-btn il-btn--primary il-btn--lg">Claim Your Free 5 minutes Call</a>
		</div>
	</section>

</main>

<!-- Interlace-style footer -->
<footer class="il-footer">
	<div class="il-container il-footer__inner">
		<div class="il-footer__brand">
			<span class="il-footer__logo-text">Interlace</span>
			<p class="il-footer__tagline">Interlace Studies and Visa Services is an educational platform where professionals give their hearts out to help students achieve their pinnacle of success.</p>
			<p class="il-footer__legal">ABN: 88 623 971 522 | ACN: 623 971 522 | MARN: 2117623 | MARN: 2418363 | MARN 2519108</p>
		</div>
		<div class="il-footer__grid">
			<div class="il-footer__col">
				<h4 class="il-footer__heading">Company</h4>
				<ul class="il-footer__links">
					<li><a href="<?php echo esc_url( $about_url ); ?>">About</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#blog">Blog</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#event">Event</a></li>
					<li><a href="<?php echo esc_url( $jobs_url ); ?>">Career</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#help">Help Support</a></li>
				</ul>
			</div>
			<div class="il-footer__col">
				<h4 class="il-footer__heading">Resources</h4>
				<ul class="il-footer__links">
					<li><a href="<?php echo esc_url( $home_url ); ?>#courses">Courses</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#health">Health cover</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#banking">Student Banking</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#test-prep">Test Preparation</a></li>
				</ul>
			</div>
			<div class="il-footer__col">
				<h4 class="il-footer__heading">Useful Links</h4>
				<ul class="il-footer__links">
					<li><a href="<?php echo esc_url( $home_url ); ?>#why">Why Australia</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#pr">PR Eligibility</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#partner">Partner Visa Chances Estimator</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#cost">Cost of Living</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#checklist">Document Checklist</a></li>
				</ul>
			</div>
			<div class="il-footer__col">
				<h4 class="il-footer__heading">Legals</h4>
				<ul class="il-footer__links">
					<li><a href="<?php echo esc_url( $home_url ); ?>#privacy">Privacy Policy</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#conduct">Code Of Conduct</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#refund">Refund Policy</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#disclaimer">Non-Disclaimer Policy</a></li>
					<li><a href="<?php echo esc_url( $home_url ); ?>#disclaimer">Disclaimer</a></li>
				</ul>
			</div>
			<div class="il-footer__col il-footer__col--contact">
				<h4 class="il-footer__heading">Choose a Branch for Details</h4>
				<p class="il-footer__address">East Suite 3, Level 2, 50 Grenfell Street, Adelaide</p>
				<p class="il-footer__phone"><a href="tel:+61434230354">(+61) 434 230 354</a></p>
				<p class="il-footer__phone"><a href="tel:1300365423">1300 365 423</a></p>
				<p class="il-footer__email"><a href="mailto:Info@interlace.com.au">Info@interlace.com.au</a></p>
				<form class="il-footer__form" action="#" method="post">
					<label for="il-footer-email" class="screen-reader-text">Email</label>
					<input type="email" id="il-footer-email" name="email" placeholder="Get in touch" required>
					<button type="submit" class="il-btn il-btn--primary">Submit</button>
				</form>
			</div>
		</div>
		<div class="il-footer__bottom">
			<div class="il-footer__social">
				<a href="#" aria-label="LinkedIn">LinkedIn</a>
				<a href="#" aria-label="YouTube">Youtube</a>
				<a href="#" aria-label="Facebook">Facebook</a>
				<a href="#" aria-label="Instagram">Instagram</a>
				<a href="#" aria-label="TikTok">TikTok</a>
			</div>
			<p class="il-footer__copy">© 2018–2025 Interlace Studies and Visa Services Pvt. Ltd. All Rights Reserved.</p>
			<p class="il-footer__policy-links">
				<a href="<?php echo esc_url( $home_url ); ?>#under18">Under 18 Policy and Procedure</a> ·
				<a href="<?php echo esc_url( $home_url ); ?>#whistleblower">Whistleblower Policy</a> ·
				<a href="<?php echo esc_url( $home_url ); ?>#slavery">Modern Slavery Policy</a>
			</p>
			<p class="il-footer__acknowledgment">Interlace Studies Acknowledges The Aboriginal And Torres Strait Islander Peoples As The Traditional Owners Of The Land, Respecting Their Ongoing Connection To Land, Waters, And Cultures, And Honoring Their Elders Past And Present.</p>
			<p class="il-footer__dev">Developed by Tekgro</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

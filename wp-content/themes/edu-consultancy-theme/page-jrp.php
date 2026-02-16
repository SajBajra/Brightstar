<?php
/**
 * Template for Job Ready Program (JRP) page.
 * Hero + breadcrumb + content (from Interlace JRP resource).
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
	<section class="edu-find-jobs-hero edu-page-hero edu-jrp-hero" aria-label="<?php esc_attr_e( 'Job Ready Program', 'edu-consultancy' ); ?>">
		<div class="edu-find-jobs-hero__overlay"></div>
		<div class="edu-find-jobs-hero__inner">
			<nav class="edu-find-jobs-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'edu-consultancy' ); ?>">
				<ol class="edu-find-jobs-hero__breadcrumb-list">
					<li class="edu-find-jobs-hero__breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edu-consultancy' ); ?></a>
					</li>
					<li class="edu-find-jobs-hero__breadcrumb-item edu-find-jobs-hero__breadcrumb-item--current" aria-current="page">
						<?php esc_html_e( 'Job Ready Program', 'edu-consultancy' ); ?>
					</li>
				</ol>
			</nav>
			<h1 class="edu-find-jobs-hero__title"><?php esc_html_e( 'Job Ready Program (JRP)', 'edu-consultancy' ); ?></h1>
			<p class="edu-find-jobs-hero__description"><?php esc_html_e( 'Turn your Australian education into a thriving career and a clear path to permanent residency.', 'edu-consultancy' ); ?></p>
		</div>
	</section>

	<div class="edu-container">
		<div class="edu-page-content edu-jrp-content">
			<div class="edu-jrp-intro">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Launch Your Career with Our Job Ready Program', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( "Our Job Ready Program helps international graduates turn their Australian qualifications into successful careers and permanent residency. Whether you've just completed your degree or are on a graduate visa, we provide expert mentorship, guaranteed internships, and personalized migration support to make your career goals a reality.", 'edu-consultancy' ); ?></p>
				<ul class="edu-page-content__list edu-jrp-intro__list">
					<li><?php esc_html_e( 'Gain Australian work experience through guaranteed internship placement', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Receive one-on-one mentorship from industry professionals', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Get expert guidance on your PR pathway and skills assessment', 'edu-consultancy' ); ?></li>
				</ul>
				<p class="edu-jrp-intro__cta">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Start Your Job Ready Program Journey Today', 'edu-consultancy' ); ?></a>
				</p>
			</div>

			<section class="edu-jrp-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Job Ready Program for International Graduates in Australia', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Turn your Australian education into a thriving career and a clear path to permanent residency. We offer a comprehensive Job Ready Program (JRP) designed specifically for international graduates. We bridge the gap between your academic qualifications and the demands of the Australian job market, providing you with the practical skills, industry connections, and personalized migration guidance needed for long-term success.', 'edu-consultancy' ); ?></p>
			</section>

			<section class="edu-jrp-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Who Is It For?', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Our Job Ready Program is ideal for international students or graduates who have:', 'edu-consultancy' ); ?></p>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Completed a Diploma, Advanced Diploma, Bachelor\'s, or Master\'s degree from an Australian institution', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Currently hold or are applying for a Temporary Graduate Visa (Subclass 485)', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'A strong desire to build a professional career and migrate through skilled or state-nominated pathways', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Commitment to developing their professional skills and workplace communication', 'edu-consultancy' ); ?></li>
				</ul>
			</section>

			<section class="edu-jrp-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Supported Industries for Your Career Success', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'We specialize in high-demand sectors with strong employment prospects and clear migration pathways. Our JRP offers dedicated support and mentorship in the following fields:', 'edu-consultancy' ); ?></p>
				<ul class="edu-page-content__list edu-jrp-industries">
					<li><strong><?php esc_html_e( 'Disability Support', 'edu-consultancy' ); ?></strong> &mdash; <?php esc_html_e( 'Start a career in disability care with practical training and job placement support in Australia\'s growing support sector.', 'edu-consultancy' ); ?></li>
					<li><strong><?php esc_html_e( 'Hospitality', 'edu-consultancy' ); ?></strong> &mdash; <?php esc_html_e( 'Gain job-ready hospitality skills with hands-on training, work placements, and pathways to management roles in Australia.', 'edu-consultancy' ); ?></li>
					<li><strong><?php esc_html_e( 'Nursing & Aged Care', 'edu-consultancy' ); ?></strong> &mdash; <?php esc_html_e( 'Prepare for a rewarding healthcare career with real-world training and job opportunities in nursing and aged care.', 'edu-consultancy' ); ?></li>
					<li><strong><?php esc_html_e( 'Engineering', 'edu-consultancy' ); ?></strong> &mdash; <?php esc_html_e( 'Build a job-ready foundation in civil, mechanical, or software engineering with Australian industry connections and internships.', 'edu-consultancy' ); ?></li>
					<li><strong><?php esc_html_e( 'Information Technology', 'edu-consultancy' ); ?></strong> &mdash; <?php esc_html_e( 'Get job-ready in Australia\'s fast-growing tech sector. Learn essential IT skills, earn certifications, and gain career support.', 'edu-consultancy' ); ?></li>
				</ul>
			</section>

			<section class="edu-jrp-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Learn from Industry Mentors', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( "We've launched a dedicated Job Ready Program to support international graduates in Australia who want to build careers in high-demand sectors and achieve long-term migration success. Our program delivers customized, practical support with guaranteed outcomes that set you up for professional success.", 'edu-consultancy' ); ?></p>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Understand the current Australian job market and industry trends', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Identify and address your skill gaps through personalized assessment', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Learn how to meet and exceed Australian employer expectations', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Gain insider knowledge on the most in-demand roles in your field', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Receive guaranteed internship placement with our partner organizations', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Enhance your professional capabilities through hands-on training and mentorship', 'edu-consultancy' ); ?></li>
				</ul>
				<p class="edu-jrp-section__cta">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Get Help Now!', 'edu-consultancy' ); ?></a>
				</p>
			</section>

			<section class="edu-jrp-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'What Our Job Ready Program Includes', 'edu-consultancy' ); ?></h2>

				<h3 class="edu-page-content__subheading"><?php esc_html_e( 'Career & PR Pathway Guidance:', 'edu-consultancy' ); ?></h3>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Integrated PR pathway guidance tailored to your occupation', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Personalized migration planning with registered migration agents', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Identifying PR-eligible occupations that match your qualifications', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Expert advice on state nominations and skills assessments', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Up-to-date information on visa requirements and processing times', 'edu-consultancy' ); ?></li>
				</ul>

				<h3 class="edu-page-content__subheading"><?php esc_html_e( 'Job Readiness & Placement Support:', 'edu-consultancy' ); ?></h3>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Professional resume & LinkedIn profile development optimized for Australian employers', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Interview preparation & confidence building through mock interviews', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Job application coaching tailored to your specific field and career goals', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Access to our network of 200+ partner employers across Australia', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Guaranteed internship placement to gain Australian work experience', 'edu-consultancy' ); ?></li>
				</ul>

				<h3 class="edu-page-content__subheading"><?php esc_html_e( 'Mentorship & Skills Development:', 'edu-consultancy' ); ?></h3>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'One-on-one mentorship with experienced professionals in IT, Nursing, Hospitality, Engineering & more', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Guidance on soft skills and Australian workplace culture expectations', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Recommendations on bridging courses or certifications to enhance your employability (if needed)', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Industry-specific training to meet Australian standards and employer requirements', 'edu-consultancy' ); ?></li>
				</ul>
			</section>

			<section class="edu-jrp-section">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'Why Join the Job Ready Program?', 'edu-consultancy' ); ?></h2>
				<p><?php esc_html_e( 'Our Job Ready Program is specifically designed to bridge the gap between your academic qualifications and professional success in Australia. We provide international graduates with comprehensive support to build rewarding careers in high-demand sectors while establishing a clear pathway to permanent residency.', 'edu-consultancy' ); ?></p>
				<ul class="edu-page-content__list">
					<li><?php esc_html_e( 'Prepare for in-demand jobs in your industry with targeted skills training', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Strengthen your confidence through professional mentorship and guidance', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Gain deep understanding of Australian employer expectations and workplace culture', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Stay ahead of industry trends and emerging opportunities in the job market', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Successfully transition from student to skilled professional with Australian work experience', 'edu-consultancy' ); ?></li>
					<li><?php esc_html_e( 'Achieve your migration goals with expert visa and PR pathway support', 'edu-consultancy' ); ?></li>
				</ul>
				<p class="edu-jrp-section__cta">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="edu-btn-primary"><?php esc_html_e( 'Get Help Now!', 'edu-consultancy' ); ?></a>
				</p>
			</section>

			<section class="edu-jrp-section edu-jrp-faq">
				<h2 class="edu-page-content__heading"><?php esc_html_e( 'People Also Ask', 'edu-consultancy' ); ?></h2>

				<div class="edu-jrp-faq__item">
					<h3 class="edu-jrp-faq__q"><?php esc_html_e( 'What is a Job Ready Program (JRP) in Australia?', 'edu-consultancy' ); ?></h3>
					<p class="edu-jrp-faq__a"><?php esc_html_e( 'A Job Ready Program (JRP) in Australia is a career development course designed for international graduates. It focuses on providing practical, hands-on skills, local work experience, and an understanding of Australian workplace culture to make graduates more employable and prepare them for their skills assessment and permanent residency pathways.', 'edu-consultancy' ); ?></p>
				</div>

				<div class="edu-jrp-faq__item">
					<h3 class="edu-jrp-faq__q"><?php esc_html_e( 'Can I get a professional job in Australia without local experience?', 'edu-consultancy' ); ?></h3>
					<p class="edu-jrp-faq__a"><?php esc_html_e( 'While it can be challenging, it is definitely possible. A program like our JRP is designed to solve this exact problem. We provide you with industry-specific training, professional mentorship, and internship placements that count as valuable local experience, making your resume stand out to Australian employers.', 'edu-consultancy' ); ?></p>
				</div>

				<div class="edu-jrp-faq__item">
					<h3 class="edu-jrp-faq__q"><?php esc_html_e( 'How long does it take to find a job after completing the JRP?', 'edu-consultancy' ); ?></h3>
					<p class="edu-jrp-faq__a"><?php esc_html_e( 'While timelines can vary based on the individual and industry, our program is designed to accelerate your job search. By equipping you with an optimized resume, interview mastery, and access to our industry network, many of our graduates secure professional roles within a few months of completing the program.', 'edu-consultancy' ); ?></p>
				</div>

				<p class="edu-jrp-faq__cta"><?php esc_html_e( 'Still have questions?', 'edu-consultancy' ); ?> <a href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Connect with our team', 'edu-consultancy' ); ?></a>.</p>
			</section>
		</div>
	</div>
</main>

<?php
get_footer();

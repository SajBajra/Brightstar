<?php
/**
 * Login / Register landing page.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$login_url    = wp_login_url();
$register_url = wp_registration_url();
?>

<main id="primary" class="site-main">
	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Access dashboards tailored for job seekers and employers.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--2">
				<div class="edu-card">
					<h2 class="edu-card__title"><?php esc_html_e( 'Job Seekers', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'Search jobs, apply online and track your applications.', 'edu-consultancy' ); ?></p>
					<p class="edu-card__meta">
						<a class="edu-btn-primary" href="<?php echo esc_url( $login_url ); ?>">
							<?php esc_html_e( 'Login as Job Seeker', 'edu-consultancy' ); ?>
						</a>
					</p>
					<p class="edu-card__meta">
						<a class="edu-btn-outline" href="<?php echo esc_url( $register_url ); ?>">
							<?php esc_html_e( 'Create Job Seeker Account', 'edu-consultancy' ); ?>
						</a>
					</p>
				</div>

				<div class="edu-card">
					<h2 class="edu-card__title"><?php esc_html_e( 'Employers', 'edu-consultancy' ); ?></h2>
					<p><?php esc_html_e( 'Post jobs, review candidates and hire faster with BrightStar.', 'edu-consultancy' ); ?></p>
					<p class="edu-card__meta">
						<a class="edu-btn-primary" href="<?php echo esc_url( $login_url ); ?>">
							<?php esc_html_e( 'Login as Employer', 'edu-consultancy' ); ?>
						</a>
					</p>
					<p class="edu-card__meta">
						<a class="edu-btn-outline" href="<?php echo esc_url( $register_url ); ?>">
							<?php esc_html_e( 'Register as Employer', 'edu-consultancy' ); ?>
						</a>
					</p>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();


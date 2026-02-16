<?php
/**
 * Theme bootstrap.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define core constants.
if ( ! defined( 'EDU_THEME_VERSION' ) ) {
	define( 'EDU_THEME_VERSION', '1.0.0' );
}

if ( ! defined( 'EDU_THEME_DIR' ) ) {
	define( 'EDU_THEME_DIR', get_template_directory() );
}

if ( ! defined( 'EDU_THEME_URI' ) ) {
	define( 'EDU_THEME_URI', get_template_directory_uri() );
}

/**
 * Autoload theme includes.
 */
require_once EDU_THEME_DIR . '/inc/setup.php';
require_once EDU_THEME_DIR . '/inc/cpt.php';
require_once EDU_THEME_DIR . '/inc/taxonomies.php';
require_once EDU_THEME_DIR . '/inc/forms.php';
require_once EDU_THEME_DIR . '/inc/admin.php';
require_once EDU_THEME_DIR . '/inc/helpers.php';
require_once EDU_THEME_DIR . '/inc/jobs.php';
require_once EDU_THEME_DIR . '/inc/roles.php';
require_once EDU_THEME_DIR . '/inc/applications.php';
require_once EDU_THEME_DIR . '/inc/job-search.php';
require_once EDU_THEME_DIR . '/inc/dashboards.php';
require_once EDU_THEME_DIR . '/inc/elementor-widgets.php';
require_once EDU_THEME_DIR . '/inc/contact-form.php';
require_once EDU_THEME_DIR . '/inc/auth-modals.php';
require_once EDU_THEME_DIR . '/inc/consultation-booking.php';

/**
 * Initialise theme components.
 */
add_action(
	'after_setup_theme',
	static function () {
		if ( class_exists( 'Edu_Theme_Setup' ) ) {
			Edu_Theme_Setup::init();
		}

		if ( class_exists( 'Edu_Theme_CPT' ) ) {
			Edu_Theme_CPT::init();
		}

		if ( class_exists( 'Edu_Theme_Taxonomies' ) ) {
			Edu_Theme_Taxonomies::init();
		}

		if ( class_exists( 'Edu_Theme_Forms' ) ) {
			Edu_Theme_Forms::init();
		}

		if ( class_exists( 'Edu_Theme_Admin' ) ) {
			Edu_Theme_Admin::init();
		}

		if ( class_exists( 'Edu_Theme_Helpers' ) ) {
			Edu_Theme_Helpers::init();
		}

		if ( class_exists( 'Edu_Theme_Jobs' ) ) {
			Edu_Theme_Jobs::init();
		}

		if ( class_exists( 'Edu_Theme_Roles' ) ) {
			Edu_Theme_Roles::init();
		}

		if ( class_exists( 'Edu_Theme_Applications' ) ) {
			Edu_Theme_Applications::init();
		}

		if ( class_exists( 'Edu_Theme_Job_Search' ) ) {
			Edu_Theme_Job_Search::init();
		}

		if ( class_exists( 'Edu_Theme_Dashboards' ) ) {
			Edu_Theme_Dashboards::init();
		}

		if ( class_exists( 'Edu_Theme_Elementor_Widgets' ) ) {
			Edu_Theme_Elementor_Widgets::init();
		}

		if ( class_exists( 'Edu_Theme_Contact_Form' ) ) {
			Edu_Theme_Contact_Form::init();
		}

		if ( class_exists( 'Edu_Theme_Auth_Modals' ) ) {
			Edu_Theme_Auth_Modals::init();
		}

		if ( class_exists( 'Edu_Theme_Consultation_Booking' ) ) {
			Edu_Theme_Consultation_Booking::init();
		}
	}
);

/**
 * Rewrite hardcoded uploads URLs to current site domain.
 *
 * This helps when migrating a database between domains/subdomains where Elementor
 * (or other builders) stored absolute image URLs (e.g. background images) that
 * still point to the old domain.
 *
 * We only rewrite URLs that point into the uploads base path.
 *
 * @param mixed $content HTML content.
 * @return mixed
 */
function edu_theme_rewrite_upload_urls_to_current_domain( $content ) {
	if ( is_admin() || ! is_string( $content ) || '' === $content ) {
		return $content;
	}

	$uploads = wp_get_upload_dir();
	$uploads_baseurl = isset( $uploads['baseurl'] ) ? (string) $uploads['baseurl'] : '';
	$uploads_basepath = wp_parse_url( $uploads_baseurl, PHP_URL_PATH );

	// Fallback for unusual setups.
	if ( ! $uploads_basepath ) {
		$uploads_basepath = '/wp-content/uploads';
	}

	$home      = home_url();
	$scheme    = wp_parse_url( $home, PHP_URL_SCHEME );
	$host      = wp_parse_url( $home, PHP_URL_HOST );
	$port      = wp_parse_url( $home, PHP_URL_PORT );
	$origin    = $scheme && $host ? $scheme . '://' . $host : '';
	$origin   .= $origin && $port ? ':' . $port : '';

	if ( '' === $origin ) {
		return $content;
	}

	// Replace any absolute or protocol-relative URL host that points into uploads.
	$pattern = '~(?:(?:https?:)?//)[^"\'\s]+(?=' . preg_quote( $uploads_basepath, '~' ) . ')~i';

	return preg_replace( $pattern, $origin, $content );
}

// Frontend content (classic editor + builder output).
add_filter( 'the_content', 'edu_theme_rewrite_upload_urls_to_current_domain', 20 );

// Elementor frontend rendered content.
add_filter( 'elementor/frontend/the_content', 'edu_theme_rewrite_upload_urls_to_current_domain', 20 );

// Text widgets / shortcodes.
add_filter( 'widget_text', 'edu_theme_rewrite_upload_urls_to_current_domain', 20 );
add_filter( 'widget_text_content', 'edu_theme_rewrite_upload_urls_to_current_domain', 20 );


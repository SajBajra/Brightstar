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
	}
);


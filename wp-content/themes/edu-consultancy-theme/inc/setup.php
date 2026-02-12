<?php
/**
 * Theme setup and front-end assets.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Setup {

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'after_setup_theme', array( __CLASS__, 'theme_supports' ) );
		add_action( 'after_setup_theme', array( __CLASS__, 'register_menus' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'disable_gutenberg_styles' ), 100 );
		add_action( 'init', array( __CLASS__, 'cleanup_wp_head' ) );
	}

	/**
	 * Register theme supports.
	 *
	 * @return void
	 */
	public static function theme_supports() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 240,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		// Let Elementor control the full page width.
		add_theme_support( 'elementor' );
	}

	/**
	 * Register navigation menus.
	 *
	 * @return void
	 */
	public static function register_menus() {
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'edu-consultancy' ),
				'footer'  => esc_html__( 'Footer Menu', 'edu-consultancy' ),
			)
		);
	}

	/**
	 * Enqueue front-end assets.
	 *
	 * @return void
	 */
	public static function enqueue_assets() {
		$theme_version = defined( 'EDU_THEME_VERSION' ) ? EDU_THEME_VERSION : wp_get_theme()->get( 'Version' );

		// Main stylesheet (theme root style.css).
		wp_enqueue_style(
			'edu-theme-style',
			get_stylesheet_uri(),
			array(),
			$theme_version
		);

		// Additional theme CSS (optional extension point).
		$theme_css = trailingslashit( EDU_THEME_URI ) . 'assets/css/theme.css';
		wp_enqueue_style(
			'edu-theme-layout',
			esc_url( $theme_css ),
			array( 'edu-theme-style' ),
			$theme_version
		);

		// Core front-end JS (no jQuery dependency).
		$theme_js = trailingslashit( EDU_THEME_URI ) . 'assets/js/theme.js';
		wp_enqueue_script(
			'edu-theme-main',
			esc_url( $theme_js ),
			array(),
			$theme_version,
			true
		);

		// Forms JS (used for AJAX consultation form).
		$forms_js = trailingslashit( EDU_THEME_URI ) . 'assets/js/forms.js';
		wp_enqueue_script(
			'edu-theme-forms',
			esc_url( $forms_js ),
			array(),
			$theme_version,
			true
		);

		wp_localize_script(
			'edu-theme-forms',
			'eduForms',
			array(
				'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
				'nonce'    => wp_create_nonce( 'edu_consultation_nonce' ),
			)
		);
	}

	/**
	 * Remove unnecessary front-end block styles if not required.
	 *
	 * @return void
	 */
	public static function disable_gutenberg_styles() {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
	}

	/**
	 * Clean up wp_head output for performance.
	 *
	 * @return void
	 */
	public static function cleanup_wp_head() {
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
	}
}


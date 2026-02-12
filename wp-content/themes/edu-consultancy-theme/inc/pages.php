<?php
/**
 * Core page creation and routing helpers.
 *
 * Ensures required front-end pages exist so routes like /about, /services, /jobs
 * work out of the box and are powered by the custom page templates.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Pages {

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'after_setup_theme', array( __CLASS__, 'ensure_core_pages' ) );
	}

	/**
	 * Create core pages if they do not exist yet.
	 *
	 * Runs once and then stores a flag in options.
	 *
	 * @return void
	 */
	public static function ensure_core_pages() {
		if ( is_admin() && isset( $_GET['page'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			// No-op; guard only to show structure.
		}

		$already_created = get_option( 'edu_core_pages_created', false );
		if ( $already_created ) {
			return;
		}

		$core_pages = array(
			'home'                  => array(
				'title'   => __( 'Home', 'edu-consultancy' ),
				'content' => '',
			),
			'about'                 => array(
				'title'   => __( 'About Us', 'edu-consultancy' ),
				'content' => '',
			),
			'services'              => array(
				'title'   => __( 'Services', 'edu-consultancy' ),
				'content' => '',
			),
			'countries'             => array(
				'title'   => __( 'Countries', 'edu-consultancy' ),
				'content' => '',
			),
			'jobs'                  => array(
				'title'   => __( 'Jobs', 'edu-consultancy' ),
				'content' => '',
			),
			'employer'              => array(
				'title'   => __( 'Employers', 'edu-consultancy' ),
				'content' => '',
			),
			'contact'               => array(
				'title'   => __( 'Contact', 'edu-consultancy' ),
				'content' => '',
			),
			'blog'                  => array(
				'title'   => __( 'Blog', 'edu-consultancy' ),
				'content' => '',
			),
			'job-seeker-dashboard'  => array(
				'title'   => __( 'Job Seeker Dashboard', 'edu-consultancy' ),
				'content' => '',
			),
			'employer-dashboard'    => array(
				'title'   => __( 'Employer Dashboard', 'edu-consultancy' ),
				'content' => '',
			),
			'login-register'        => array(
				'title'   => __( 'Login / Register', 'edu-consultancy' ),
				'content' => '',
			),
			'free-consultation'     => array(
				'title'   => __( 'Free Consultation', 'edu-consultancy' ),
				'content' => '',
			),
		);

		$page_ids = array();

		foreach ( $core_pages as $slug => $data ) {
			$existing = get_page_by_path( $slug );

			if ( $existing instanceof WP_Post ) {
				$page_ids[ $slug ] = (int) $existing->ID;
				continue;
			}

			$page_id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_name'    => sanitize_title( $slug ),
					'post_title'   => wp_strip_all_tags( $data['title'] ),
					'post_content' => $data['content'],
					'post_status'  => 'publish',
				)
			);

			if ( ! is_wp_error( $page_id ) && $page_id ) {
				$page_ids[ $slug ] = (int) $page_id;
			}
		}

		// Assign Home as static front page if not already configured.
		if ( ! empty( $page_ids['home'] ) ) {
			if ( 'page' !== get_option( 'show_on_front' ) ) {
				update_option( 'show_on_front', 'page' );
			}

			if ( ! get_option( 'page_on_front' ) ) {
				update_option( 'page_on_front', (int) $page_ids['home'] );
			}
		}

		// Assign Blog as posts page if available and not already set.
		if ( ! empty( $page_ids['blog'] ) && ! get_option( 'page_for_posts' ) ) {
			update_option( 'page_for_posts', (int) $page_ids['blog'] );
		}

		update_option( 'edu_core_pages_created', 1 );
	}
}


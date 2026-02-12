<?php
/**
 * Custom post types.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_CPT {

	/**
	 * Hook into init.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_cpts' ) );
	}

	/**
	 * Register all custom post types.
	 *
	 * @return void
	 */
	public static function register_cpts() {
		self::register_services_cpt();
		self::register_countries_cpt();
		self::register_universities_cpt();
		self::register_testimonials_cpt();
		self::register_consultations_cpt();
	}

	/**
	 * Services CPT.
	 *
	 * @return void
	 */
	private static function register_services_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Services', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'Service', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New Service', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New Service', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit Service', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New Service', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View Service', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Services', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No services found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No services found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Services', 'edu-consultancy' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-welcome-learn-more',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'            => array(
				'slug'       => 'services',
				'with_front' => false,
			),
		);

		register_post_type( 'services', $args );
	}

	/**
	 * Countries CPT.
	 *
	 * @return void
	 */
	private static function register_countries_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Countries', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'Country', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New Country', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New Country', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit Country', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New Country', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View Country', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Countries', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No countries found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No countries found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Countries', 'edu-consultancy' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-admin-site-alt3',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'            => array(
				'slug'       => 'countries',
				'with_front' => false,
			),
		);

		register_post_type( 'countries', $args );
	}

	/**
	 * Universities CPT.
	 *
	 * @return void
	 */
	private static function register_universities_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Universities', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'University', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New University', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New University', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit University', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New University', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View University', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Universities', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No universities found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No universities found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Universities', 'edu-consultancy' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-welcome-learn-more',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'            => array(
				'slug'       => 'universities',
				'with_front' => false,
			),
		);

		register_post_type( 'universities', $args );
	}

	/**
	 * Testimonials CPT.
	 *
	 * @return void
	 */
	private static function register_testimonials_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Testimonials', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'Testimonial', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New Testimonial', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New Testimonial', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit Testimonial', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New Testimonial', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View Testimonial', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Testimonials', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No testimonials found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No testimonials found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Testimonials', 'edu-consultancy' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-format-quote',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'            => array(
				'slug'       => 'testimonials',
				'with_front' => false,
			),
		);

		register_post_type( 'testimonials', $args );
	}

	/**
	 * Consultations CPT (private, for form submissions).
	 *
	 * @return void
	 */
	private static function register_consultations_cpt() {
		$labels = array(
			'name'               => esc_html__( 'Consultations', 'edu-consultancy' ),
			'singular_name'      => esc_html__( 'Consultation', 'edu-consultancy' ),
			'add_new'            => esc_html__( 'Add New Consultation', 'edu-consultancy' ),
			'add_new_item'       => esc_html__( 'Add New Consultation', 'edu-consultancy' ),
			'edit_item'          => esc_html__( 'Edit Consultation', 'edu-consultancy' ),
			'new_item'           => esc_html__( 'New Consultation', 'edu-consultancy' ),
			'view_item'          => esc_html__( 'View Consultation', 'edu-consultancy' ),
			'search_items'       => esc_html__( 'Search Consultations', 'edu-consultancy' ),
			'not_found'          => esc_html__( 'No consultations found', 'edu-consultancy' ),
			'not_found_in_trash' => esc_html__( 'No consultations found in Trash', 'edu-consultancy' ),
			'menu_name'          => esc_html__( 'Consultations', 'edu-consultancy' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-clipboard',
			'supports'            => array( 'title', 'custom-fields' ),
			'rewrite'             => false,
			'query_var'           => false,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
		);

		register_post_type( 'consultations', $args );
	}
}


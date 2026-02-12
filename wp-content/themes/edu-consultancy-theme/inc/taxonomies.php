<?php
/**
 * Custom taxonomies.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Taxonomies {

	/**
	 * Hook registration.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
	}

	/**
	 * Register all taxonomies.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {
		self::register_service_categories();
		self::register_country_regions();
		self::register_visa_types();
	}

	/**
	 * Service Categories taxonomy.
	 *
	 * @return void
	 */
	private static function register_service_categories() {
		$labels = array(
			'name'              => esc_html__( 'Service Categories', 'edu-consultancy' ),
			'singular_name'     => esc_html__( 'Service Category', 'edu-consultancy' ),
			'search_items'      => esc_html__( 'Search Service Categories', 'edu-consultancy' ),
			'all_items'         => esc_html__( 'All Service Categories', 'edu-consultancy' ),
			'parent_item'       => esc_html__( 'Parent Service Category', 'edu-consultancy' ),
			'parent_item_colon' => esc_html__( 'Parent Service Category:', 'edu-consultancy' ),
			'edit_item'         => esc_html__( 'Edit Service Category', 'edu-consultancy' ),
			'update_item'       => esc_html__( 'Update Service Category', 'edu-consultancy' ),
			'add_new_item'      => esc_html__( 'Add New Service Category', 'edu-consultancy' ),
			'new_item_name'     => esc_html__( 'New Service Category Name', 'edu-consultancy' ),
			'menu_name'         => esc_html__( 'Service Categories', 'edu-consultancy' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'service-category',
				'with_front' => false,
			),
		);

		register_taxonomy( 'service_category', array( 'services' ), $args );
	}

	/**
	 * Country Regions taxonomy.
	 *
	 * @return void
	 */
	private static function register_country_regions() {
		$labels = array(
			'name'              => esc_html__( 'Country Regions', 'edu-consultancy' ),
			'singular_name'     => esc_html__( 'Country Region', 'edu-consultancy' ),
			'search_items'      => esc_html__( 'Search Country Regions', 'edu-consultancy' ),
			'all_items'         => esc_html__( 'All Country Regions', 'edu-consultancy' ),
			'parent_item'       => esc_html__( 'Parent Country Region', 'edu-consultancy' ),
			'parent_item_colon' => esc_html__( 'Parent Country Region:', 'edu-consultancy' ),
			'edit_item'         => esc_html__( 'Edit Country Region', 'edu-consultancy' ),
			'update_item'       => esc_html__( 'Update Country Region', 'edu-consultancy' ),
			'add_new_item'      => esc_html__( 'Add New Country Region', 'edu-consultancy' ),
			'new_item_name'     => esc_html__( 'New Country Region Name', 'edu-consultancy' ),
			'menu_name'         => esc_html__( 'Country Regions', 'edu-consultancy' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'country-region',
				'with_front' => false,
			),
		);

		register_taxonomy( 'country_region', array( 'countries' ), $args );
	}

	/**
	 * Visa Types taxonomy.
	 *
	 * @return void
	 */
	private static function register_visa_types() {
		$labels = array(
			'name'              => esc_html__( 'Visa Types', 'edu-consultancy' ),
			'singular_name'     => esc_html__( 'Visa Type', 'edu-consultancy' ),
			'search_items'      => esc_html__( 'Search Visa Types', 'edu-consultancy' ),
			'all_items'         => esc_html__( 'All Visa Types', 'edu-consultancy' ),
			'parent_item'       => esc_html__( 'Parent Visa Type', 'edu-consultancy' ),
			'parent_item_colon' => esc_html__( 'Parent Visa Type:', 'edu-consultancy' ),
			'edit_item'         => esc_html__( 'Edit Visa Type', 'edu-consultancy' ),
			'update_item'       => esc_html__( 'Update Visa Type', 'edu-consultancy' ),
			'add_new_item'      => esc_html__( 'Add New Visa Type', 'edu-consultancy' ),
			'new_item_name'     => esc_html__( 'New Visa Type Name', 'edu-consultancy' ),
			'menu_name'         => esc_html__( 'Visa Types', 'edu-consultancy' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'visa-type',
				'with_front' => false,
			),
		);

		register_taxonomy(
			'visa_type',
			array( 'services', 'countries', 'universities', 'testimonials' ),
			$args
		);
	}
}


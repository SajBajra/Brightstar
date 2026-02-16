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
		add_filter( 'wp_nav_menu_objects', array( __CLASS__, 'reorder_primary_menu' ), 10, 2 );
		add_action( 'after_switch_theme', array( __CLASS__, 'maybe_create_blog_page' ) );
		add_action( 'after_switch_theme', array( __CLASS__, 'maybe_create_about_contact_pages' ) );
		add_action( 'after_switch_theme', array( __CLASS__, 'maybe_create_placement_jrp_pages' ) );
		add_action( 'after_switch_theme', array( __CLASS__, 'maybe_populate_primary_menu' ) );
		add_action( 'init', array( __CLASS__, 'maybe_create_blog_page_once' ) );
		add_action( 'init', array( __CLASS__, 'maybe_create_about_contact_pages_once' ) );
		add_action( 'init', array( __CLASS__, 'maybe_create_placement_jrp_pages_once' ) );
		add_action( 'init', array( __CLASS__, 'maybe_populate_primary_menu_once' ) );
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
	 * Create the Blog page on theme activation.
	 *
	 * @return void
	 */
	public static function maybe_create_blog_page() {
		self::create_blog_page_if_missing();
	}

	/**
	 * Create the Blog page once (for existing installs).
	 *
	 * @return void
	 */
	public static function maybe_create_blog_page_once() {
		if ( get_option( 'edu_blog_page_created', false ) ) {
			return;
		}
		self::create_blog_page_if_missing();
		if ( get_page_by_path( 'blog' ) ) {
			update_option( 'edu_blog_page_created', true );
		}
	}

	/**
	 * Create About Us and Contact pages on theme activation.
	 *
	 * @return void
	 */
	public static function maybe_create_about_contact_pages() {
		self::create_about_contact_pages_if_missing();
	}

	/**
	 * Create About Us and Contact pages once (for existing installs).
	 *
	 * @return void
	 */
	public static function maybe_create_about_contact_pages_once() {
		if ( get_option( 'edu_about_contact_pages_created', false ) ) {
			return;
		}
		self::create_about_contact_pages_if_missing();
		if ( get_page_by_path( 'about-us' ) && get_page_by_path( 'contact' ) ) {
			update_option( 'edu_about_contact_pages_created', true );
		}
	}

	/**
	 * Create About Us and Contact pages if they don't exist.
	 *
	 * @return void
	 */
	private static function create_about_contact_pages_if_missing() {
		$pages = array(
			array(
				'slug'  => 'about-us',
				'title' => _x( 'About Us', 'Page title', 'edu-consultancy' ),
			),
			array(
				'slug'  => 'contact',
				'title' => _x( 'Contact', 'Page title', 'edu-consultancy' ),
			),
		);
		foreach ( $pages as $page ) {
			if ( get_page_by_path( $page['slug'] ) ) {
				continue;
			}
			wp_insert_post(
				array(
					'post_title'   => $page['title'],
					'post_name'    => $page['slug'],
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_author'  => 1,
					'post_content' => '',
				),
				true
			);
		}
	}

	/**
	 * Create Placement and JRP pages on theme activation.
	 *
	 * @return void
	 */
	public static function maybe_create_placement_jrp_pages() {
		self::create_placement_jrp_pages_if_missing();
	}

	/**
	 * Create Placement and JRP pages once (for existing installs).
	 *
	 * @return void
	 */
	public static function maybe_create_placement_jrp_pages_once() {
		if ( get_option( 'edu_placement_jrp_pages_created', false ) ) {
			return;
		}
		self::create_placement_jrp_pages_if_missing();
		if ( get_page_by_path( 'placement' ) && get_page_by_path( 'jrp' ) ) {
			update_option( 'edu_placement_jrp_pages_created', true );
		}
	}

	/**
	 * Create Placement and JRP pages if they don't exist.
	 *
	 * @return void
	 */
	private static function create_placement_jrp_pages_if_missing() {
		$pages = array(
			array(
				'slug'  => 'placement',
				'title' => _x( 'Placement', 'Page title', 'edu-consultancy' ),
			),
			array(
				'slug'  => 'jrp',
				'title' => _x( 'Job Ready Program (JRP)', 'Page title', 'edu-consultancy' ),
			),
		);
		foreach ( $pages as $page ) {
			if ( get_page_by_path( $page['slug'] ) ) {
				continue;
			}
			wp_insert_post(
				array(
					'post_title'   => $page['title'],
					'post_name'    => $page['slug'],
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_author'  => 1,
					'post_content' => '',
				),
				true
			);
		}
	}

	/**
	 * Create a page with slug "blog" and title "Blog" if it doesn't exist.
	 *
	 * @return int|false Page ID or false.
	 */
	private static function create_blog_page_if_missing() {
		$slug = 'blog';
		if ( get_page_by_path( $slug ) ) {
			return (int) get_page_by_path( $slug )->ID;
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => _x( 'Blog', 'Page title', 'edu-consultancy' ),
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_author'  => 1,
				'post_content' => '',
			),
			true
		);

		if ( ! is_wp_error( $page_id ) && $page_id > 0 ) {
			return $page_id;
		}

		return false;
	}

	/**
	 * Populate Primary menu with key pages on theme activation.
	 *
	 * @return void
	 */
	public static function maybe_populate_primary_menu() {
		self::populate_primary_menu_if_needed();
	}

	/**
	 * Populate Primary menu once (for existing installs).
	 *
	 * @return void
	 */
	public static function maybe_populate_primary_menu_once() {
		self::populate_primary_menu_if_needed();
	}

	/**
	 * Reorder primary menu items: About, Find Jobs, JRP, Placement, Blog, Contact.
	 *
	 * @param array    $items Menu items.
	 * @param stdClass $args  Nav menu args.
	 * @return array
	 */
	public static function reorder_primary_menu( $items, $args ) {
		if ( empty( $items ) || ! isset( $args->theme_location ) || $args->theme_location !== 'primary' ) {
			return $items;
		}
		$jobs_url  = get_post_type_archive_link( 'jobs' );
		$blog_id   = (int) get_option( 'page_for_posts' );
		$blog_url  = $blog_id ? get_permalink( $blog_id ) : home_url( '/' );
		$order_map = array(
			'about-us'  => 1,
			'find-jobs' => 2,
			'jrp'       => 3,
			'placement' => 4,
			'blog'      => 5,
			'contact'   => 6,
		);
		$top_level = array();
		$children  = array();
		foreach ( $items as $item ) {
			if ( (int) $item->menu_item_parent !== 0 ) {
				$children[ $item->menu_item_parent ][] = $item;
				continue;
			}
			$url       = trailingslashit( $item->url );
			$slug      = '';
			$title_lower = strtolower( trim( $item->title ) );
			if ( $jobs_url && ( $url === trailingslashit( $jobs_url ) || untrailingslashit( $item->url ) === untrailingslashit( $jobs_url ) ) ) {
				$slug = 'find-jobs';
			} elseif ( 'find jobs' === $title_lower && ( ! $jobs_url || strpos( $item->url, 'jobs' ) !== false ) ) {
				$slug = 'find-jobs';
			} elseif ( $blog_id && (int) $item->object_id === $blog_id ) {
				$slug = 'blog';
			} elseif ( $blog_url && $item->type === 'custom' && $url === trailingslashit( $blog_url ) ) {
				$slug = 'blog';
			} elseif ( 'page' === $item->object ) {
				$page = get_post( $item->object_id );
				$slug = $page ? $page->post_name : '';
			}
			$item->primary_order = isset( $order_map[ $slug ] ) ? $order_map[ $slug ] : 99;
			$top_level[]        = $item;
		}
		usort( $top_level, function( $a, $b ) {
			return $a->primary_order - $b->primary_order;
		} );
		$ordered = array();
		foreach ( $top_level as $item ) {
			$ordered[] = $item;
			if ( ! empty( $children[ $item->ID ] ) ) {
				foreach ( $children[ $item->ID ] as $child ) {
					$ordered[] = $child;
				}
			}
		}
		return $ordered;
	}

	/**
	 * Get or create Primary menu and add items in order: About, Find Jobs, JRP, Placement, Blog, Contact.
	 *
	 * @return void
	 */
	private static function populate_primary_menu_if_needed() {
		$locations = get_nav_menu_locations();
		$menu_id   = isset( $locations['primary'] ) ? (int) $locations['primary'] : 0;

		if ( ! $menu_id ) {
			$menu_id = wp_create_nav_menu( __( 'Primary Menu', 'edu-consultancy' ) );
			if ( is_wp_error( $menu_id ) ) {
				return;
			}
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}

		$menu_items    = wp_get_nav_menu_items( $menu_id );
		$existing     = array();
		$has_find_jobs_by_title = false;
		if ( $menu_items ) {
			foreach ( $menu_items as $item ) {
				if ( (int) $item->menu_item_parent !== 0 ) {
					continue;
				}
				$existing[ $item->url ] = true;
				$existing[ trailingslashit( $item->url ) ] = true;
				$existing[ untrailingslashit( $item->url ) ] = true;
				if ( 'post_type' === $item->type && 'page' === $item->object ) {
					$existing[ 'page:' . $item->object_id ] = true;
				}
				if ( strtolower( trim( $item->title ) ) === 'find jobs' ) {
					$has_find_jobs_by_title = true;
				}
			}
		}

		$position = 1;

		// 1. About Us
		$page = get_page_by_path( 'about-us' );
		if ( $page && empty( $existing[ 'page:' . $page->ID ] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-type'        => 'post_type',
					'menu-item-object'     => 'page',
					'menu-item-object-id'  => $page->ID,
					'menu-item-title'      => $page->post_title,
					'menu-item-status'     => 'publish',
					'menu-item-position'   => $position++,
				)
			);
		}

		// 2. Find Jobs
		$jobs_url = get_post_type_archive_link( 'jobs' );
		if ( ! $jobs_url ) {
			$jobs_url = home_url( '/jobs/' );
		}
		$has_find_jobs = $has_find_jobs_by_title || ( $jobs_url && ( ! empty( $existing[ $jobs_url ] ) || ! empty( $existing[ trailingslashit( $jobs_url ) ] ) || ! empty( $existing[ untrailingslashit( $jobs_url ) ] ) ) );
		if ( $jobs_url && ! $has_find_jobs ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-type'      => 'custom',
					'menu-item-title'     => __( 'Find Jobs', 'edu-consultancy' ),
					'menu-item-url'       => $jobs_url,
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position++,
				)
			);
		}

		// 3. JRP
		$page = get_page_by_path( 'jrp' );
		if ( $page && empty( $existing[ 'page:' . $page->ID ] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-type'       => 'post_type',
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page->ID,
					'menu-item-title'     => $page->post_title,
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position++,
				)
			);
		}

		// 4. Placement
		$page = get_page_by_path( 'placement' );
		if ( $page && empty( $existing[ 'page:' . $page->ID ] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-type'       => 'post_type',
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page->ID,
					'menu-item-title'     => $page->post_title,
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position++,
				)
			);
		}

		// 5. Blog
		$blog_page_id = (int) get_option( 'page_for_posts' );
		if ( $blog_page_id && empty( $existing[ 'page:' . $blog_page_id ] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-type'       => 'post_type',
					'menu-item-object'     => 'page',
					'menu-item-object-id'  => $blog_page_id,
					'menu-item-title'      => get_the_title( $blog_page_id ),
					'menu-item-status'     => 'publish',
					'menu-item-position'   => $position++,
				)
			);
		}

		// 6. Contact
		$page = get_page_by_path( 'contact' );
		if ( $page && empty( $existing[ 'page:' . $page->ID ] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-type'       => 'post_type',
					'menu-item-object'     => 'page',
					'menu-item-object-id'  => $page->ID,
					'menu-item-title'     => $page->post_title,
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position++,
				)
			);
		}
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


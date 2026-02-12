<?php
/**
 * Helper utilities: script attributes, schema, etc.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Helpers {

	/**
	 * Init helpers.
	 *
	 * @return void
	 */
	public static function init() {
		add_filter( 'script_loader_tag', array( __CLASS__, 'add_defer_to_theme_scripts' ), 10, 3 );
		add_action( 'wp_head', array( __CLASS__, 'output_organization_schema' ) );
		add_action( 'wp_head', array( __CLASS__, 'output_article_schema' ) );
	}

	/**
	 * Add defer attribute to selected theme scripts.
	 *
	 * @param string $tag    Script tag.
	 * @param string $handle Handle.
	 * @param string $src    Source URL.
	 *
	 * @return string
	 */
	public static function add_defer_to_theme_scripts( $tag, $handle, $src ) {
		$defer_handles = array(
			'edu-theme-main',
			'edu-theme-forms',
		);

		if ( is_admin() ) {
			return $tag;
		}

		if ( in_array( $handle, $defer_handles, true ) ) {
			// Ensure we only modify valid script tags.
			$tag = str_replace( ' src', ' defer src', $tag );
		}

		return $tag;
	}

	/**
	 * Output basic Organization schema.
	 *
	 * @return void
	 */
	public static function output_organization_schema() {
		if ( ! is_front_page() && ! is_home() ) {
			return;
		}

		$site_name = get_bloginfo( 'name' );
		$site_url  = home_url( '/' );

		$logo_id = get_theme_mod( 'custom_logo' );
		$logo    = $logo_id ? wp_get_attachment_image_src( $logo_id, 'full' ) : false;

		$data = array(
			'@context' => 'https://schema.org',
			'@type'    => 'Organization',
			'name'     => $site_name,
			'url'      => $site_url,
		);

		if ( $logo && isset( $logo[0] ) ) {
			$data['logo'] = esc_url_raw( $logo[0] );
		}

		echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Output basic BlogPosting schema for single posts.
	 *
	 * @return void
	 */
	public static function output_article_schema() {
		if ( ! is_single() || is_singular( 'page' ) ) {
			return;
		}

		global $post;

		if ( ! $post instanceof WP_Post ) {
			return;
		}

		$author_id = $post->post_author;
		$schema    = array(
			'@context'      => 'https://schema.org',
			'@type'         => 'BlogPosting',
			'headline'      => get_the_title( $post ),
			'datePublished' => get_the_date( 'c', $post ),
			'dateModified'  => get_the_modified_date( 'c', $post ),
			'author'        => array(
				'@type' => 'Person',
				'name'  => get_the_author_meta( 'display_name', $author_id ),
			),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink( $post ),
			),
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


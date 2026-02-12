<?php
/**
 * Lightweight Elementor widgets wrapping job portal shortcodes.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Elementor_Widgets {

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'elementor/widgets/register', array( __CLASS__, 'register_widgets' ) );
	}

	/**
	 * Register custom widgets if Elementor is active.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
	 *
	 * @return void
	 */
	public static function register_widgets( $widgets_manager ) {
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		require_once __DIR__ . '/elementor/class-edu-widget-job-grid.php';
		require_once __DIR__ . '/elementor/class-edu-widget-featured-jobs.php';
		require_once __DIR__ . '/elementor/class-edu-widget-job-search.php';
		require_once __DIR__ . '/elementor/class-edu-widget-apply-button.php';
		require_once __DIR__ . '/elementor/class-edu-widget-company-card.php';

		$widgets_manager->register( new \Edu_Elementor_Widget_Job_Grid() );
		$widgets_manager->register( new \Edu_Elementor_Widget_Featured_Jobs() );
		$widgets_manager->register( new \Edu_Elementor_Widget_Job_Search() );
		$widgets_manager->register( new \Edu_Elementor_Widget_Apply_Button() );
		$widgets_manager->register( new \Edu_Elementor_Widget_Company_Card() );
	}
}


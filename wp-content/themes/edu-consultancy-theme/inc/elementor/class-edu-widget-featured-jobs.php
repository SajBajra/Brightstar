<?php
/**
 * Elementor widget: Featured Jobs Slider (simple grid hook).
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Featured_Jobs extends Widget_Base {

	public function get_name() {
		return 'edu-featured-jobs';
	}

	public function get_title() {
		return esc_html__( 'Featured Jobs (Edu)', 'edu-consultancy' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'per_page',
			array(
				'label'   => esc_html__( 'Number of Jobs', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 1,
				'max'     => 20,
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$per_page = isset( $settings['per_page'] ) ? (int) $settings['per_page'] : 6;

		// Frontend designers can wrap this output in Elementor's sliders/carousels.
		echo do_shortcode(
			sprintf(
				'[edu_job_grid per_page="%d" featured_only="yes"]',
				$per_page
			)
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


<?php
/**
 * Elementor widget: Job Search + Filter.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Job_Search extends Widget_Base {

	public function get_name() {
		return 'edu-job-search';
	}

	public function get_title() {
		return esc_html__( 'Job Search (Edu)', 'edu-consultancy' );
	}

	public function get_icon() {
		return 'eicon-search';
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
				'label'   => esc_html__( 'Results Per Page', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 1,
				'max'     => 50,
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$per_page = isset( $settings['per_page'] ) ? (int) $settings['per_page'] : 10;

		echo do_shortcode(
			sprintf(
				'[edu_job_search per_page=\"%d\"]',
				$per_page
			)
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


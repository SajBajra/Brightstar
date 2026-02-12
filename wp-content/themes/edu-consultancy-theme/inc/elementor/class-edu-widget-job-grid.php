<?php
/**
 * Elementor widget: Job Grid.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Job_Grid extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'edu-job-grid';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Job Grid (Edu)', 'edu-consultancy' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-posts-grid';
	}

	/**
	 * Categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Register controls.
	 *
	 * @return void
	 */
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
				'label'   => esc_html__( 'Jobs Per Page', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 1,
				'max'     => 50,
			)
		);

		$this->add_control(
			'featured_only',
			array(
				'label'        => esc_html__( 'Featured Jobs Only', 'edu-consultancy' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edu-consultancy' ),
				'label_off'    => esc_html__( 'No', 'edu-consultancy' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget.
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$per_page      = isset( $settings['per_page'] ) ? (int) $settings['per_page'] : 6;
		$featured_only = ( isset( $settings['featured_only'] ) && 'yes' === $settings['featured_only'] ) ? 'yes' : 'no';

		echo do_shortcode(
			sprintf(
				'[edu_job_grid per_page="%d" featured_only="%s"]',
				$per_page,
				esc_attr( $featured_only )
			)
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


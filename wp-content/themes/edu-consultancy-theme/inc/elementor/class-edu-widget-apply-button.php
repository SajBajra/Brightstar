<?php
/**
 * Elementor widget: Job Application Button.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Apply_Button extends Widget_Base {

	public function get_name() {
		return 'edu-apply-button';
	}

	public function get_title() {
		return esc_html__( 'Job Apply Button (Edu)', 'edu-consultancy' );
	}

	public function get_icon() {
		return 'eicon-button';
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
			'label',
			array(
				'label'   => esc_html__( 'Button Label', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Apply Now', 'edu-consultancy' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$label    = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Apply Now', 'edu-consultancy' );

		// On single job pages we output the full form; elsewhere, we can link to job page.
		if ( is_singular( 'jobs' ) ) {
			echo '<div class="edu-apply-widget">';
			echo '<div class="edu-apply-widget__header"><button type="button" class="edu-btn-primary" onclick="this.nextElementSibling.classList.toggle(\'is-open\');">' . esc_html( $label ) . '</button></div>';
			echo '<div class="edu-apply-widget__body">';
			echo do_shortcode( '[edu_job_apply_form]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
			echo '</div>';
		} else {
			if ( is_singular() ) {
				$link = get_permalink();
			} else {
				$link = get_post_type_archive_link( 'jobs' );
			}

			echo '<a class="edu-btn-primary" href="' . esc_url( $link ) . '">' . esc_html( $label ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}


<?php
/**
 * Elementor widget: Company Card (for job listings or about sections).
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Company_Card extends Widget_Base {

	public function get_name() {
		return 'edu-company-card';
	}

	public function get_title() {
		return esc_html__( 'Company Card (Edu)', 'edu-consultancy' );
	}

	public function get_icon() {
		return 'eicon-person';
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
			'company_name',
			array(
				'label'   => esc_html__( 'Company Name', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'company_logo',
			array(
				'label' => esc_html__( 'Logo', 'edu-consultancy' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => '',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$name        = isset( $settings['company_name'] ) ? $settings['company_name'] : '';
		$description = isset( $settings['description'] ) ? $settings['description'] : '';
		$logo        = isset( $settings['company_logo']['url'] ) ? $settings['company_logo']['url'] : '';

		?>
		<div class="edu-card edu-company-card">
			<?php if ( $logo ) : ?>
				<div class="edu-company-card__logo">
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
				</div>
			<?php endif; ?>

			<?php if ( $name ) : ?>
				<h3 class="edu-company-card__name"><?php echo esc_html( $name ); ?></h3>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="edu-company-card__description"><?php echo esc_html( $description ); ?></p>
			<?php endif; ?>
		</div>
		<?php
	}
}


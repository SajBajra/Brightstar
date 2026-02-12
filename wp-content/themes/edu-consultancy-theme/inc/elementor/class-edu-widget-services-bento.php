<?php
/**
 * Elementor widget: Services Bento Grid.
 *
 * Displays Services CPT entries in a bento-style card grid.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Services_Bento extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'edu-services-bento';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Services Bento Grid (Edu)', 'edu-consultancy' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
			'heading',
			array(
				'label'       => esc_html__( 'Section Heading', 'edu-consultancy' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Our Services', 'edu-consultancy' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Section Description', 'edu-consultancy' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'End-to-end education and migration solutions tailored to your goals.', 'edu-consultancy' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Services to Show', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 3,
				'max'     => 12,
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

		$heading     = isset( $settings['heading'] ) ? $settings['heading'] : '';
		$description = isset( $settings['description'] ) ? $settings['description'] : '';

		// Static services for this project – no CPT query.
		$services = array(
			array(
				'title' => __( 'Study Abroad Admissions', 'edu-consultancy' ),
				'text'  => __( 'Shortlist the right universities and colleges based on your profile, budget, and long‑term goals. We handle applications, SOPs, and documentation from start to finish.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
			),
			array(
				'title' => __( 'Student Visa Processing', 'edu-consultancy' ),
				'text'  => __( 'End‑to‑end support for student visas, including document checklists, financials, interview preparation, and compliance with each country’s latest rules.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=900&q=80',
			),
			array(
				'title' => __( 'PR & Skilled Migration Pathways', 'edu-consultancy' ),
				'text'  => __( 'Assessment of your profile against current immigration programs (PR, work permits, skill‑based visas), with guidance on points, documentation, and timelines.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80',
			),
			array(
				'title' => __( 'Work & Job Placement Abroad', 'edu-consultancy' ),
				'text'  => __( 'Connect with trusted overseas employers across hospitality, construction, healthcare, and corporate roles, with transparent offers and visa guidance.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=900&q=80',
			),
			array(
				'title' => __( 'Family, Spouse & Dependent Visas', 'edu-consultancy' ),
				'text'  => __( 'Assistance with partner, spouse, and dependent visas so your family can join you abroad with the correct documentation and sponsorship structure.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=900&q=80',
			),
			array(
				'title' => __( 'Career & Education Counselling', 'edu-consultancy' ),
				'text'  => __( 'One‑to‑one strategy sessions to map your education, skills and experience to a realistic study or migration plan, including course and country selection.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=900&q=80',
			),
			array(
				'title' => __( 'Test Preparation & Language Coaching', 'edu-consultancy' ),
				'text'  => __( 'Preparation support for IELTS, PTE and other language or admission tests, with focused strategies to achieve the scores your application needs.', 'edu-consultancy' ),
				'image' => 'https://images.unsplash.com/photo-1523580846011-485a21c868ed?auto=format&fit=crop&w=900&q=80',
			),
		);

		?>
		<section class="edu-services-bento">
			<?php if ( $heading || $description ) : ?>
				<header class="edu-services-bento__header">
					<?php if ( $heading ) : ?>
						<h2 class="edu-services-bento__title"><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>
					<?php if ( $description ) : ?>
						<p class="edu-services-bento__description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</header>
			<?php endif; ?>

			<div class="edu-services-bento__grid">
				<?php
				$index = 0;
				foreach ( $services as $service ) :
					$index++;

					$classes = array( 'edu-services-bento__item' );

					// Basic bento-style variation: make first card large, others smaller.
					if ( 1 === $index ) {
						$classes[] = 'edu-services-bento__item--featured';
					} elseif ( in_array( $index, array( 2, 3 ), true ) ) {
						$classes[] = 'edu-services-bento__item--tall';
					}

					?>
					<article class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $classes ) ) ); ?>">
						<?php if ( ! empty( $service['image'] ) ) : ?>
							<div class="edu-services-bento__media">
								<img
									src="<?php echo esc_url( $service['image'] ); ?>"
									alt="<?php echo esc_attr( $service['title'] ); ?>"
									class="edu-services-bento__image"
									loading="lazy"
								/>
							</div>
						<?php endif; ?>
						<div class="edu-services-bento__body">
							<h3 class="edu-services-bento__service-title">
								<?php echo esc_html( $service['title'] ); ?>
							</h3>
							<p class="edu-services-bento__service-text">
								<?php echo esc_html( $service['text'] ); ?>
							</p>
						</div>
					</article>
					<?php
				endforeach;
				?>
			</div>
		</section>
		<?php
	}
}


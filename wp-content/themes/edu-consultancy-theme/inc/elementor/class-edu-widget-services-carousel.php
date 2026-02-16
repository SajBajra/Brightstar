<?php
/**
 * Elementor widget: Services Carousel – "Find out how we assist students like you achieve outstanding results."
 * Replicates Interlace homepage services carousel.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Edu_Elementor_Widget_Services_Carousel
 */
class Edu_Elementor_Widget_Services_Carousel extends Widget_Base {

	public function get_name() {
		return 'edu-services-carousel';
	}

	public function get_title() {
		return esc_html__( 'Services Carousel (Assist Students)', 'edu-consultancy' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore -- Elementor compatibility
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Section title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Find out how we assist students like you achieve outstanding results.', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'show_personalized_badge',
			array(
				'label'        => esc_html__( 'Show "Personalized" badge on cards', 'edu-consultancy' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edu-consultancy' ),
				'label_off'    => esc_html__( 'No', 'edu-consultancy' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Card image', 'edu-consultancy' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(),
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Icon (shown when no image)', 'edu-consultancy' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'eicon-user',
					'library' => 'elementor-icons',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Career Counseling', 'edu-consultancy' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Career counselling is at the heart of what we do. We guide students to the right course and institution with expert advice, assessments, and personalised support.', 'edu-consultancy' ),
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button text', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Guidance', 'edu-consultancy' ),
			)
		);

		$repeater->add_control(
			'button_url',
			array(
				'label'   => esc_html__( 'Button URL', 'edu-consultancy' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'services',
			array(
				'label'       => esc_html__( 'Services', 'edu-consultancy' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'title'       => esc_html__( 'Career Counseling', 'edu-consultancy' ),
						'description' => esc_html__( 'Career counselling is at the heart of what we do. We guide students to the right course and institution with expert advice, assessments, and personalised support.', 'edu-consultancy' ),
						'button_text' => esc_html__( 'Get Guidance', 'edu-consultancy' ),
					),
					array(
						'title'       => esc_html__( 'University Admission', 'edu-consultancy' ),
						'description' => esc_html__( 'We guide international students through every step of the admissions process—choosing the right institution, applying correctly, and securing successful placements.', 'edu-consultancy' ),
						'button_text' => esc_html__( 'Apply Now', 'edu-consultancy' ),
					),
					array(
						'title'       => esc_html__( 'Migration Services', 'edu-consultancy' ),
						'description' => esc_html__( 'We assist with visas and migration for study, work, and post study stay in Australia, offering expert guidance, reliable advice, and full support throughout the process.', 'edu-consultancy' ),
						'button_text' => esc_html__( 'Migrate Now', 'edu-consultancy' ),
					),
					array(
						'title'       => esc_html__( 'Job ready Programs', 'edu-consultancy' ),
						'description' => esc_html__( 'Our Job Ready program helps international students build essential skills, prepare strong resumes, and succeed in job searches and interviews across Australia.', 'edu-consultancy' ),
						'button_text' => esc_html__( 'Be Job-Ready', 'edu-consultancy' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_title',
			array(
				'label' => esc_html__( 'Section title', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .edu-services-carousel__title',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .edu-services-carousel__title' => 'color: {{VALUE}};' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style_cards',
			array(
				'label' => esc_html__( 'Cards', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'card_bg',
			array(
				'label'     => esc_html__( 'Card background', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .edu-services-carousel__card' => 'background-color: {{VALUE}};' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_title_typography',
				'selector' => '{{WRAPPER}} .edu-services-carousel__card-title',
			)
		);
		$this->add_control(
			'card_title_color',
			array(
				'label'     => esc_html__( 'Card title color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .edu-services-carousel__card-title' => 'color: {{VALUE}};' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_desc_typography',
				'selector' => '{{WRAPPER}} .edu-services-carousel__card-desc',
			)
		);
		$this->add_control(
			'card_desc_color',
			array(
				'label'     => esc_html__( 'Description color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .edu-services-carousel__card-desc' => 'color: {{VALUE}};' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = isset( $settings['title'] ) ? $settings['title'] : '';
		$services = isset( $settings['services'] ) && is_array( $settings['services'] ) ? $settings['services'] : array();
		$show_badge = ! empty( $settings['show_personalized_badge'] ) && $settings['show_personalized_badge'] === 'yes';
		$widget_id = 'edu-services-carousel-' . $this->get_id();
		if ( empty( $services ) ) {
			return;
		}
		$total_slides = count( $services );
		?>
		<section class="edu-services-carousel edu-services-carousel--redesign" id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="edu-container">
				<?php if ( $title ) : ?>
					<p class="edu-services-carousel__eyebrow"><?php esc_html_e( 'How we help', 'edu-consultancy' ); ?></p>
					<h2 class="edu-services-carousel__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<div class="edu-services-carousel__wrap">
					<div class="edu-services-carousel__track">
						<?php
						$default_images = array(
							'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&q=80',
							'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80',
							'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&q=80',
							'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
						);
						foreach ( $services as $index => $item ) :
							$img_url = isset( $item['image']['url'] ) && $item['image']['url'] ? $item['image']['url'] : ( isset( $default_images[ $index ] ) ? $default_images[ $index ] : '' );
							?>
							<div class="edu-services-carousel__slide">
								<div class="edu-services-carousel__card<?php echo $img_url ? '' : ' edu-services-carousel__card--no-image'; ?>">
									<div class="edu-services-carousel__card-image-wrap">
										<?php if ( $img_url ) : ?>
											<div class="edu-services-carousel__card-image">
												<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( isset( $item['title'] ) ? $item['title'] : '' ); ?>" loading="lazy" />
											</div>
										<?php elseif ( ! empty( $item['icon']['value'] ) ) : ?>
											<div class="edu-services-carousel__card-image edu-services-carousel__card-image--icon">
												<div class="edu-services-carousel__icon"><?php \Elementor\Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?></div>
											</div>
										<?php else : ?>
											<div class="edu-services-carousel__card-image edu-services-carousel__card-image--placeholder"></div>
										<?php endif; ?>
										<?php if ( $show_badge ) : ?>
											<span class="edu-services-carousel__badge"><?php esc_html_e( 'Personalized', 'edu-consultancy' ); ?></span>
										<?php endif; ?>
									</div>
									<div class="edu-services-carousel__card-body">
										<h3 class="edu-services-carousel__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
										<p class="edu-services-carousel__card-desc"><?php echo esc_html( $item['description'] ); ?></p>
										<?php
										$btn_url = isset( $item['button_url']['url'] ) ? $item['button_url']['url'] : '#';
										$btn_text = isset( $item['button_text'] ) ? $item['button_text'] : __( 'Learn More', 'edu-consultancy' );
										?>
										<a href="<?php echo esc_url( $btn_url ); ?>" class="edu-services-carousel__btn"><?php echo esc_html( $btn_text ); ?> &rarr;</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<nav class="edu-services-carousel__nav" aria-label="<?php esc_attr_e( 'Carousel navigation', 'edu-consultancy' ); ?>">
						<button type="button" class="edu-services-carousel__prev edu-pagination-btn" aria-label="<?php esc_attr_e( 'Previous', 'edu-consultancy' ); ?>"><?php esc_html_e( '← Previous', 'edu-consultancy' ); ?></button>
						<div class="edu-services-carousel__pages" role="tablist">
							<?php for ( $i = 0; $i < $total_slides; $i++ ) : ?>
								<button type="button" class="edu-services-carousel__page edu-pagination-btn<?php echo 0 === $i ? ' is-active' : ''; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Page %d', 'edu-consultancy' ), $i + 1 ) ); ?>" data-index="<?php echo (int) $i; ?>" role="tab"><?php echo (int) ( $i + 1 ); ?></button>
							<?php endfor; ?>
						</div>
						<button type="button" class="edu-services-carousel__next edu-pagination-btn" aria-label="<?php esc_attr_e( 'Next', 'edu-consultancy' ); ?>"><?php esc_html_e( 'Next →', 'edu-consultancy' ); ?></button>
					</nav>
				</div>
			</div>
			<script>
			(function(){
				var el = document.getElementById('<?php echo esc_js( $widget_id ); ?>');
				if (!el) return;
				var track = el.querySelector('.edu-services-carousel__track');
				var prev = el.querySelector('.edu-services-carousel__prev');
				var next = el.querySelector('.edu-services-carousel__next');
				if (!track || !prev || !next) return;
				var total = track.children.length;
				var current = 0;
				function getVisible() {
					return window.innerWidth <= 767 ? 1 : 3;
				}
				function update() {
					var visible = getVisible();
					var maxStep = Math.max(0, total - visible);
					if (current > maxStep) current = maxStep;
					var percent = total > 0 ? (current * 100 / total) : 0;
					track.style.transform = 'translateX(-' + percent + '%)';
					var pages = el.querySelectorAll('.edu-services-carousel__page');
					pages.forEach(function(p, i) { p.classList.toggle('is-active', i === current); });
				}
				function go(n) {
					var visible = getVisible();
					var maxStep = Math.max(0, total - visible);
					current = current + n;
					if (current < 0) current = 0;
					if (current > maxStep) current = maxStep;
					update();
				}
				prev.addEventListener('click', function(){ go(-1); });
				next.addEventListener('click', function(){ go(1); });
				el.querySelectorAll('.edu-services-carousel__page').forEach(function(btn) {
					var i = parseInt(btn.getAttribute('data-index'), 10);
					btn.addEventListener('click', function() {
						var visible = getVisible();
						var maxStep = Math.max(0, total - visible);
						current = Math.min(i, maxStep);
						update();
					});
				});
				window.addEventListener('resize', update);
				update();
			})();
			</script>
		</section>
		<?php
	}
}

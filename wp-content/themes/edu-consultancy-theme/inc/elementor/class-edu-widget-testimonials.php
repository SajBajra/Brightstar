<?php
/**
 * Elementor widget: Testimonials Carousel.
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
 * Class Edu_Elementor_Widget_Testimonials
 */
class Edu_Elementor_Widget_Testimonials extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'edu-testimonials';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Testimonials Carousel (Edu)', 'edu-consultancy' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	/**
	 * Widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Register controls.
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
			'title',
			array(
				'label'   => esc_html__( 'Section title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'What Our Students Say', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'source',
			array(
				'label'   => esc_html__( 'Testimonial source', 'edu-consultancy' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'manual',
				'options' => array(
					'manual'      => esc_html__( 'Manual entry', 'edu-consultancy' ),
					'cpt'         => esc_html__( 'From Testimonials CPT', 'edu-consultancy' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => esc_html__( 'Number of testimonials', 'edu-consultancy' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6,
				'min'       => 1,
				'max'       => 20,
				'condition' => array(
					'source' => 'cpt',
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'     => esc_html__( 'Order by', 'edu-consultancy' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => array(
					'date'  => esc_html__( 'Date', 'edu-consultancy' ),
					'title' => esc_html__( 'Title', 'edu-consultancy' ),
					'rand'  => esc_html__( 'Random', 'edu-consultancy' ),
				),
				'condition' => array(
					'source' => 'cpt',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Avatar image', 'edu-consultancy' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(),
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => esc_html__( 'Name', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'edu-consultancy' ),
			)
		);

		$repeater->add_control(
			'position',
			array(
				'label'   => esc_html__( 'Position / Title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Student', 'edu-consultancy' ),
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'   => esc_html__( 'Testimonial text', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'This is an amazing service! I highly recommend it to everyone.', 'edu-consultancy' ),
			)
		);

		$repeater->add_control(
			'rating',
			array(
				'label'   => esc_html__( 'Rating (1-5)', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'min'     => 1,
				'max'     => 5,
			)
		);

		$this->add_control(
			'testimonials',
			array(
				'label'       => esc_html__( 'Testimonials', 'edu-consultancy' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'name'     => esc_html__( 'Sarah Johnson', 'edu-consultancy' ),
						'position' => esc_html__( 'Student', 'edu-consultancy' ),
						'content'  => esc_html__( 'Brightstar helped me find the perfect university and guided me through the entire application process. I couldn\'t have done it without them!', 'edu-consultancy' ),
						'rating'   => 5,
					),
					array(
						'name'     => esc_html__( 'Michael Chen', 'edu-consultancy' ),
						'position' => esc_html__( 'Graduate', 'edu-consultancy' ),
						'content'  => esc_html__( 'The visa application support was exceptional. They made everything so easy and stress-free. Highly recommended!', 'edu-consultancy' ),
						'rating'   => 5,
					),
					array(
						'name'     => esc_html__( 'Emma Williams', 'edu-consultancy' ),
						'position' => esc_html__( 'Student', 'edu-consultancy' ),
						'content'  => esc_html__( 'Professional, friendly, and always available to answer questions. The best consultancy service I\'ve ever used.', 'edu-consultancy' ),
						'rating'   => 5,
					),
				),
				'condition'   => array(
					'source' => 'manual',
				),
			)
		);

		$this->add_control(
			'per_slide',
			array(
				'label'   => esc_html__( 'Testimonials per slide', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 4,
			)
		);

		$this->add_control(
			'show_rating',
			array(
				'label'        => esc_html__( 'Show star rating', 'edu-consultancy' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edu-consultancy' ),
				'label_off'    => esc_html__( 'No', 'edu-consultancy' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		// Style: Section title.
		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => esc_html__( 'Section title', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-testimonials__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-testimonials__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// Style: Testimonial cards.
		$this->start_controls_section(
			'section_style_cards',
			array(
				'label' => esc_html__( 'Testimonial cards', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Content typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-testimonial-card__content',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Content color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-testimonial-card__content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Name typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-testimonial-card__name',
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => esc_html__( 'Name color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-testimonial-card__name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'position_typography',
				'label'    => esc_html__( 'Position typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-testimonial-card__position',
			)
		);

		$this->add_control(
			'position_color',
			array(
				'label'     => esc_html__( 'Position color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-testimonial-card__position' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'rating_color',
			array(
				'label'     => esc_html__( 'Star rating color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-testimonial-card__rating' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = isset( $settings['title'] ) ? $settings['title'] : '';
		$source   = isset( $settings['source'] ) ? $settings['source'] : 'manual';
		$per_slide = isset( $settings['per_slide'] ) ? max( 1, min( 4, (int) $settings['per_slide'] ) ) : 3;
		$show_rating = ! empty( $settings['show_rating'] ) && $settings['show_rating'] === 'yes';
		$widget_id = 'edu-testimonials-' . $this->get_id();

		$testimonials = array();

		if ( 'cpt' === $source ) {
			$posts_per_page = isset( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;
			$orderby        = isset( $settings['orderby'] ) ? $settings['orderby'] : 'date';

			$args = array(
				'post_type'      => 'testimonials',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'orderby'        => $orderby,
				'order'          => 'desc',
			);

			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id = get_the_ID();
					$image_id = get_post_thumbnail_id( $post_id );
					$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : '';

					$testimonials[] = array(
						'image'   => array( 'url' => $image_url ),
						'name'    => get_the_title(),
						'position' => get_post_meta( $post_id, 'edu_testimonial_position', true ) ?: '',
						'content' => get_the_content(),
						'rating'  => (int) get_post_meta( $post_id, 'edu_testimonial_rating', true ) ?: 5,
					);
				}
				wp_reset_postdata();
			}
		} else {
			$testimonials = isset( $settings['testimonials'] ) && is_array( $settings['testimonials'] ) ? $settings['testimonials'] : array();
		}

		if ( empty( $testimonials ) ) {
			return;
		}

		$slides       = array_chunk( $testimonials, $per_slide );
		$total_slides = count( $slides );
		?>
		<section class="edu-testimonials" id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="edu-container">
				<?php if ( $title ) : ?>
					<h2 class="edu-testimonials__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<div class="edu-testimonials__carousel">
					<div class="edu-testimonials__track" data-slides="<?php echo esc_attr( (string) $total_slides ); ?>" style="width: <?php echo esc_attr( (string) ( $total_slides * 100 ) ); ?>%;">
						<?php
						$slide_width_pct = $total_slides > 0 ? ( 100 / $total_slides ) : 100;
						foreach ( $slides as $slide_testimonials ) {
							echo '<div class="edu-testimonials__slide" style="flex: 0 0 ' . esc_attr( $slide_width_pct ) . '%; width: ' . esc_attr( $slide_width_pct ) . '%;">';
							echo '<div class="edu-testimonials__grid edu-grid edu-grid--' . esc_attr( (string) $per_slide ) . '">';
							foreach ( $slide_testimonials as $testimonial ) {
								$image_url = isset( $testimonial['image']['url'] ) ? $testimonial['image']['url'] : '';
								$name      = isset( $testimonial['name'] ) ? $testimonial['name'] : '';
								$position  = isset( $testimonial['position'] ) ? $testimonial['position'] : '';
								$content   = isset( $testimonial['content'] ) ? $testimonial['content'] : '';
								$rating    = isset( $testimonial['rating'] ) ? max( 1, min( 5, (int) $testimonial['rating'] ) ) : 5;
								?>
								<div class="edu-card edu-testimonial-card">
									<div class="edu-testimonial-card__content">
										<?php echo wp_kses_post( wpautop( $content ) ); ?>
									</div>
									<?php if ( $show_rating ) : ?>
										<div class="edu-testimonial-card__rating" aria-label="<?php echo esc_attr( sprintf( __( '%d out of 5 stars', 'edu-consultancy' ), $rating ) ); ?>">
											<?php
											for ( $i = 1; $i <= 5; $i++ ) {
												echo $i <= $rating ? '★' : '☆';
											}
											?>
										</div>
									<?php endif; ?>
									<div class="edu-testimonial-card__footer">
										<?php if ( $image_url ) : ?>
											<div class="edu-testimonial-card__avatar">
												<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
											</div>
										<?php endif; ?>
										<div class="edu-testimonial-card__info">
											<?php if ( $name ) : ?>
												<div class="edu-testimonial-card__name"><?php echo esc_html( $name ); ?></div>
											<?php endif; ?>
											<?php if ( $position ) : ?>
												<div class="edu-testimonial-card__position"><?php echo esc_html( $position ); ?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<?php
							}
							echo '</div>';
							echo '</div>';
						}
						?>
					</div>
				</div>
				<?php if ( $total_slides > 1 ) : ?>
					<nav class="edu-testimonials__pagination" aria-label="<?php esc_attr_e( 'Testimonials carousel', 'edu-consultancy' ); ?>">
						<ul>
							<li><a href="#" class="prev page-numbers" data-page="prev" aria-label="<?php esc_attr_e( 'Previous', 'edu-consultancy' ); ?>">&larr; <?php esc_html_e( 'Previous', 'edu-consultancy' ); ?></a></li>
							<?php for ( $i = 1; $i <= $total_slides; $i++ ) : ?>
								<li><a href="#" class="page-numbers<?php echo 1 === $i ? ' current' : ''; ?>" data-page="<?php echo esc_attr( (string) $i ); ?>"><?php echo esc_html( (string) $i ); ?></a></li>
							<?php endfor; ?>
							<li><a href="#" class="next page-numbers" data-page="next" aria-label="<?php esc_attr_e( 'Next', 'edu-consultancy' ); ?>"><?php esc_html_e( 'Next', 'edu-consultancy' ); ?> &rarr;</a></li>
						</ul>
					</nav>
					<script>
					(function() {
						var section = document.getElementById('<?php echo esc_js( $widget_id ); ?>');
						if (!section) return;
						var track = section.querySelector('.edu-testimonials__track');
						var nav = section.querySelector('.edu-testimonials__pagination');
						if (!track || !nav) return;
						var total = parseInt(track.getAttribute('data-slides') || '1', 10);
						var current = 1;

						function goTo(page) {
							if (page === 'prev') page = current - 1;
							else if (page === 'next') page = current + 1;
							else page = parseInt(page, 10);
							if (page < 1) page = 1;
							if (page > total) page = total;
							current = page;
							var pct = total > 0 ? (current - 1) * (100 / total) : 0;
							track.style.transform = 'translateX(-' + pct + '%)';
							var pages = nav.querySelectorAll('a.page-numbers[data-page]:not([data-page="prev"]):not([data-page="next"])');
							pages.forEach(function(a) {
								a.classList.remove('current');
								if (a.getAttribute('data-page') === String(current)) a.classList.add('current');
							});
						}

						nav.addEventListener('click', function(e) {
							var a = e.target.closest('a.page-numbers');
							if (!a) return;
							e.preventDefault();
							goTo(a.getAttribute('data-page'));
						});
					})();
					</script>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}

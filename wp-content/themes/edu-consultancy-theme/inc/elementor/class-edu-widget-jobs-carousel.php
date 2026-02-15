<?php
/**
 * Elementor widget: Jobs Grid Carousel (same as single job "Similar jobs" carousel).
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Edu_Elementor_Widget_Jobs_Carousel
 */
class Edu_Elementor_Widget_Jobs_Carousel extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'edu-jobs-carousel';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Jobs Grid Carousel (Edu)', 'edu-consultancy' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-slides';
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
				'default' => esc_html__( 'Featured jobs', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Number of jobs', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 9,
				'min'     => 1,
				'max'     => 24,
			)
		);

		$this->add_control(
			'per_slide',
			array(
				'label'   => esc_html__( 'Jobs per slide', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 6,
			)
		);

		$this->add_control(
			'featured_only',
			array(
				'label'        => esc_html__( 'Featured jobs only', 'edu-consultancy' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edu-consultancy' ),
				'label_off'    => esc_html__( 'No', 'edu-consultancy' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'job_category',
			array(
				'label'   => esc_html__( 'Job category (slug)', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'job_type',
			array(
				'label'   => esc_html__( 'Job type (slug)', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order by', 'edu-consultancy' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'  => esc_html__( 'Date', 'edu-consultancy' ),
					'title' => esc_html__( 'Title', 'edu-consultancy' ),
					'rand'  => esc_html__( 'Random', 'edu-consultancy' ),
				),
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
				'selector' => '{{WRAPPER}} .edu-related-jobs__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-related-jobs__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// Style: Job cards.
		$this->start_controls_section(
			'section_style_cards',
			array(
				'label' => esc_html__( 'Job cards', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_title_typography',
				'label'    => esc_html__( 'Card title typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-job-card__title',
			)
		);

		$this->add_control(
			'card_title_color',
			array(
				'label'     => esc_html__( 'Card title color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-job-card__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_text_typography',
				'label'    => esc_html__( 'Card text / excerpt typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-job-card__summary',
			)
		);

		$this->add_control(
			'card_text_color',
			array(
				'label'     => esc_html__( 'Card text color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-job-card__summary' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_meta_color',
			array(
				'label'     => esc_html__( 'Card meta (type, location) color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-job-card__type, {{WRAPPER}} .edu-job-card__company' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// Style: Pagination.
		$this->start_controls_section(
			'section_style_pagination',
			array(
				'label' => esc_html__( 'Pagination', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pagination_typography',
				'label'    => esc_html__( 'Typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-related-jobs__pagination a, {{WRAPPER}} .edu-related-jobs__pagination .current',
			)
		);

		$this->add_control(
			'pagination_color',
			array(
				'label'     => esc_html__( 'Text color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-related-jobs__pagination a' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_hover_color',
			array(
				'label'     => esc_html__( 'Hover / current color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-related-jobs__pagination a:hover, {{WRAPPER}} .edu-related-jobs__pagination .current' => 'background-color: {{VALUE}}; border-color: {{VALUE}}; color: #fff;',
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
		$title    = isset( $settings['title'] ) ? $settings['title'] : esc_html__( 'Featured jobs', 'edu-consultancy' );
		$count    = isset( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 9;
		$per_slide = isset( $settings['per_slide'] ) ? max( 1, min( 6, (int) $settings['per_slide'] ) ) : 3;
		$featured_only = ( isset( $settings['featured_only'] ) && 'yes' === $settings['featured_only'] );
		$category_slug = isset( $settings['job_category'] ) ? sanitize_text_field( $settings['job_category'] ) : '';
		$type_slug     = isset( $settings['job_type'] ) ? sanitize_text_field( $settings['job_type'] ) : '';
		$orderby       = isset( $settings['orderby'] ) ? $settings['orderby'] : 'date';

		$args = array(
			'post_type'      => 'jobs',
			'post_status'    => 'publish',
			'posts_per_page' => $count,
			'orderby'        => $orderby,
			'order'          => 'desc',
		);

		if ( $featured_only ) {
			$args['meta_query'] = array(
				array(
					'key'   => 'edu_featured_job',
					'value' => '1',
				),
			);
		}

		$tax_query = array();
		if ( '' !== $category_slug ) {
			$tax_query[] = array(
				'taxonomy' => 'job_category',
				'field'    => 'slug',
				'terms'    => $category_slug,
			);
		}
		if ( '' !== $type_slug ) {
			$tax_query[] = array(
				'taxonomy' => 'job_type',
				'field'    => 'slug',
				'terms'    => $type_slug,
			);
		}
		if ( ! empty( $tax_query ) ) {
			$args['tax_query'] = $tax_query;
		}

		$query = new WP_Query( $args );
		// Deduplicate by ID (in case of duplicate rows) and keep order.
		$seen_ids = array();
		$posts    = array();
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $p ) {
				$id = (int) $p->ID;
				if ( ! isset( $seen_ids[ $id ] ) ) {
					$seen_ids[ $id ] = true;
					$posts[]        = $p;
				}
			}
		}
		$query->reset_postdata();

		$slides       = array_chunk( $posts, $per_slide );
		$total_slides = count( $slides );
		$widget_id    = 'edu-jobs-carousel-' . $this->get_id();
		?>
		<section class="edu-related-jobs edu-jobs-carousel-widget" id="<?php echo esc_attr( $widget_id ); ?>">
			<?php if ( $title ) : ?>
				<h2 class="edu-related-jobs__title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $slides ) ) : ?>
				<div class="edu-related-jobs__carousel">
					<div class="edu-related-jobs__track" data-slides="<?php echo esc_attr( (string) $total_slides ); ?>" style="width: <?php echo esc_attr( (string) ( $total_slides * 100 ) ); ?>%;">
						<?php
						$slide_width_pct = $total_slides > 0 ? ( 100 / $total_slides ) : 100;
						foreach ( $slides as $slide_posts ) {
							echo '<div class="edu-related-jobs__slide" style="flex: 0 0 ' . esc_attr( $slide_width_pct ) . '%; width: ' . esc_attr( $slide_width_pct ) . '%;">';
							echo '<div class="edu-related-jobs__grid edu-grid edu-grid--' . esc_attr( (string) $per_slide ) . '">';
							foreach ( $slide_posts as $job_post ) {
								$GLOBALS['post'] = $job_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
								setup_postdata( $job_post );
								get_template_part( 'template-parts/content', 'job' );
							}
							echo '</div>';
							echo '</div>';
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php if ( $total_slides > 1 ) : ?>
					<nav class="edu-related-jobs__pagination edu-job-pagination edu-related-jobs-carousel-pagination" aria-label="<?php esc_attr_e( 'Jobs carousel', 'edu-consultancy' ); ?>">
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
						var track = section.querySelector('.edu-related-jobs__track');
						var nav = section.querySelector('.edu-related-jobs-carousel-pagination');
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
							nav.querySelectorAll('.page-numbers').forEach(function(a) {
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
			<?php else : ?>
				<p class="edu-related-jobs__empty"><?php esc_html_e( 'No jobs found.', 'edu-consultancy' ); ?></p>
			<?php endif; ?>
		</section>
		<?php
	}
}

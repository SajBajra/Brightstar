<?php
/**
 * Elementor widget: Hero Jobs Slider.
 *
 * Hero section with heading, CTA buttons and a vertical auto-sliding list of jobs.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Elementor_Widget_Hero_Jobs extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'edu-hero-jobs';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Hero Jobs Slider (Edu)', 'edu-consultancy' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
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
			'title',
			array(
				'label'       => esc_html__( 'Title', 'edu-consultancy' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Find Your Perfect Overseas Job & Study Pathway', 'edu-consultancy' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'edu-consultancy' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Browse international opportunities, apply in a few clicks, and track your migration journey from one simple portal.', 'edu-consultancy' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'primary_button_text',
			array(
				'label'   => esc_html__( 'Primary Button Text', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Find Jobs', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'primary_button_url',
			array(
				'label'       => esc_html__( 'Primary Button URL', 'edu-consultancy' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_url( home_url( '/jobs/' ) ),
			)
		);

		$this->add_control(
			'secondary_button_text',
			array(
				'label'   => esc_html__( 'Secondary Button Text', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Book Free Consultation', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'secondary_button_url',
			array(
				'label'       => esc_html__( 'Secondary Button URL', 'edu-consultancy' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_url( home_url( '/free-consultation/' ) ),
			)
		);

		$this->add_control(
			'jobs_per_page',
			array(
				'label'   => esc_html__( 'Jobs to Show', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 1,
				'max'     => 20,
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

		$this->add_control(
			'scroll_interval',
			array(
				'label'   => esc_html__( 'Scroll Interval (ms)', 'edu-consultancy' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 7000,
				'min'     => 2000,
				'max'     => 15000,
			)
		);

		$this->end_controls_section();

		// Style: Heading.
		$this->start_controls_section(
			'section_heading_style',
			array(
				'label' => esc_html__( 'Heading', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-hero__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-hero__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Subtitle Typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-hero__subtitle',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'Subtitle Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-hero__subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// Style: Buttons.
		$this->start_controls_section(
			'section_buttons_style',
			array(
				'label' => esc_html__( 'Buttons', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'primary_button_bg',
			array(
				'label'     => esc_html__( 'Primary Button Background', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-btn-primary' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'primary_button_text_color',
			array(
				'label'     => esc_html__( 'Primary Button Text Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-btn-primary' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'secondary_button_text_color',
			array(
				'label'     => esc_html__( 'Secondary Button Text Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-btn-outline' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// Style: Job Cards.
		$this->start_controls_section(
			'section_cards_style',
			array(
				'label' => esc_html__( 'Job Cards', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'job_title_typography',
				'label'    => esc_html__( 'Job Title Typography', 'edu-consultancy' ),
				'selector' => '{{WRAPPER}} .edu-hero-job-card__title',
			)
		);

		$this->add_control(
			'job_title_color',
			array(
				'label'     => esc_html__( 'Job Title Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-hero-job-card__title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'job_card_background',
			array(
				'label'     => esc_html__( 'Card Background', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-hero-job-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'job_meta_color',
			array(
				'label'     => esc_html__( 'Meta Text Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .edu-hero-job-card__meta' => 'color: {{VALUE}};',
				),
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

		$title                = isset( $settings['title'] ) ? $settings['title'] : '';
		$subtitle             = isset( $settings['subtitle'] ) ? $settings['subtitle'] : '';
		$primary_button_text  = isset( $settings['primary_button_text'] ) ? $settings['primary_button_text'] : '';
		$primary_button_url   = ( isset( $settings['primary_button_url']['url'] ) && $settings['primary_button_url']['url'] ) ? $settings['primary_button_url']['url'] : home_url( '/jobs/' );
		$secondary_button_text = isset( $settings['secondary_button_text'] ) ? $settings['secondary_button_text'] : '';
		$secondary_button_url = ( isset( $settings['secondary_button_url']['url'] ) && $settings['secondary_button_url']['url'] ) ? $settings['secondary_button_url']['url'] : home_url( '/free-consultation/' );

		$per_page      = isset( $settings['jobs_per_page'] ) ? (int) $settings['jobs_per_page'] : 6;
		$featured_only = ( isset( $settings['featured_only'] ) && 'yes' === $settings['featured_only'] );
		$interval      = isset( $settings['scroll_interval'] ) ? (int) $settings['scroll_interval'] : 4000;
		if ( $per_page <= 0 ) {
			$per_page = 6;
		}
		if ( $interval < 1000 ) {
			$interval = 1000;
		}

		$args = array(
			'post_type'      => 'jobs',
			'post_status'    => 'publish',
			'posts_per_page' => $per_page,
		);

		if ( $featured_only ) {
			$args['meta_query'] = array(
				array(
					'key'   => 'edu_featured_job',
					'value' => '1',
				),
			);
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
		} else {
			// Prioritise featured jobs first, then newest by date.
			$args['meta_key'] = 'edu_featured_job';
			$args['orderby']  = array(
				'meta_value_num' => 'DESC',
				'date'           => 'DESC',
			);
			$args['order']    = 'DESC';
		}

		$query   = new WP_Query( $args );
		$list_id = 'edu-hero-jobs-' . esc_attr( $this->get_id() );
		?>
		<section class="edu-hero edu-hero--widget">
			<div class="edu-container edu-hero__inner">
				<div class="edu-hero__content">
					<p class="edu-hero__eyebrow">
						<?php esc_html_e( 'Study • Migrate • Work Abroad', 'edu-consultancy' ); ?>
					</p>
					<?php if ( $title ) : ?>
						<h2 class="edu-hero__title"><?php echo esc_html( $title ); ?></h2>
					<?php endif; ?>

					<?php if ( $subtitle ) : ?>
						<p class="edu-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
					<?php endif; ?>

					<div class="edu-hero__actions">
						<?php if ( $primary_button_text ) : ?>
							<a class="edu-btn-primary" href="<?php echo esc_url( $primary_button_url ); ?>">
								<?php echo esc_html( $primary_button_text ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $secondary_button_text ) : ?>
							<a class="edu-btn-outline" href="<?php echo esc_url( $secondary_button_url ); ?>">
								<?php echo esc_html( $secondary_button_text ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="edu-hero__jobs">
					<div
						class="edu-hero-jobs-list"
						id="<?php echo esc_attr( $list_id ); ?>"
						data-interval="<?php echo esc_attr( $interval ); ?>"
					>
						<?php
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();

								$job_id          = get_the_ID();
								$company_name    = get_post_meta( $job_id, 'edu_company_name', true );
								$location_terms  = get_the_terms( $job_id, 'job_location' );
								$location_label  = $location_terms && ! is_wp_error( $location_terms ) ? $location_terms[0]->name : '';
								$category_terms  = get_the_terms( $job_id, 'job_category' );
								$category_label  = $category_terms && ! is_wp_error( $category_terms ) ? $category_terms[0]->name : '';
								$type_terms      = get_the_terms( $job_id, 'job_type' );
								$type_label      = $type_terms && ! is_wp_error( $type_terms ) ? $type_terms[0]->name : '';
								$featured_job    = get_post_meta( $job_id, 'edu_featured_job', true );
								$is_featured     = ( '1' === $featured_job );
								$employment_chip = $type_label ? $type_label : esc_html__( 'Full Time', 'edu-consultancy' );
								?>
								<article class="edu-hero-job-card">
									<div class="edu-hero-job-card__media">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'edu-hero-job-card__avatar' ) ); ?>
										<?php else : ?>
											<div class="edu-hero-job-card__avatar edu-hero-job-card__avatar--placeholder">
												<span><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
											</div>
										<?php endif; ?>
									</div>
									<div class="edu-hero-job-card__body">
										<div class="edu-hero-job-card__header">
											<h3 class="edu-hero-job-card__title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<?php if ( $is_featured ) : ?>
												<span class="edu-hero-job-card__badge">
													<?php esc_html_e( 'Featured', 'edu-consultancy' ); ?>
												</span>
											<?php endif; ?>
										</div>
										<ul class="edu-hero-job-card__meta">
											<?php if ( $category_label ) : ?>
												<li><?php echo esc_html( $category_label ); ?></li>
											<?php endif; ?>
											<?php if ( $location_label ) : ?>
												<li><?php echo esc_html( $location_label ); ?></li>
											<?php endif; ?>
										</ul>

										<div class="edu-hero-job-card__chips">
											<span class="edu-chip">
												<?php echo esc_html( $employment_chip ); ?>
											</span>
											<?php if ( $is_featured ) : ?>
												<span class="edu-chip edu-chip--outline">
													<?php esc_html_e( 'Urgent', 'edu-consultancy' ); ?>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</article>
								<?php
							endwhile;
							wp_reset_postdata();
						else :
							?>
							<p class="edu-card__meta">
								<?php esc_html_e( 'Jobs will appear here once created.', 'edu-consultancy' ); ?>
							</p>
							<?php
						endif;
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}


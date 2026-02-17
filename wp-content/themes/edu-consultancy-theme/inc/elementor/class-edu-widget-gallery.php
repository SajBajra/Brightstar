<?php
/**
 * Elementor widget: Gallery with Categories
 * Filterable image gallery with category tabs and 4-column grid layout.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Edu_Elementor_Widget_Gallery
 */
class Edu_Elementor_Widget_Gallery extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'edu-gallery';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Gallery with Categories', 'edu-consultancy' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Register widget scripts.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return array();
	}

	/**
	 * Register widget styles.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		// Register the CSS file if not already registered.
		if ( ! wp_style_is( 'edu-elementor-gallery', 'registered' ) ) {
			$theme_version = defined( 'EDU_THEME_VERSION' ) ? EDU_THEME_VERSION : wp_get_theme()->get( 'Version' );
			wp_register_style(
				'edu-elementor-gallery',
				get_template_directory_uri() . '/assets/css/elementor-gallery.css',
				array(),
				$theme_version
			);
		}
		return array( 'edu-elementor-gallery' );
	}

	/**
	 * Register widget controls.
	 *
	 * @return void
	 */
	protected function register_controls() {
		// Content Section.
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
				'label'   => esc_html__( 'Gallery Title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Gallery', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'show_all_category',
			array(
				'label'        => esc_html__( 'Show "All" Category', 'edu-consultancy' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edu-consultancy' ),
				'label_off'    => esc_html__( 'No', 'edu-consultancy' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		// Categories Repeater.
		$category_repeater = new Repeater();

		$category_repeater->add_control(
			'category_name',
			array(
				'label'   => esc_html__( 'Category Name', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Category', 'edu-consultancy' ),
			)
		);

		$category_repeater->add_control(
			'category_slug',
			array(
				'label'   => esc_html__( 'Category Slug (for filtering)', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'category',
				'description' => esc_html__( 'Use lowercase letters, numbers, and hyphens only (e.g., "events", "students")', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'categories',
			array(
				'label'       => esc_html__( 'Categories', 'edu-consultancy' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $category_repeater->get_controls(),
				'default'     => array(
					array(
						'category_name' => esc_html__( 'Events', 'edu-consultancy' ),
						'category_slug' => 'events',
					),
					array(
						'category_name' => esc_html__( 'Students', 'edu-consultancy' ),
						'category_slug' => 'students',
					),
					array(
						'category_name' => esc_html__( 'Campus', 'edu-consultancy' ),
						'category_slug' => 'campus',
					),
				),
				'title_field' => '{{{ category_name }}}',
			)
		);

		// Images Repeater.
		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image', 'edu-consultancy' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80',
				),
			)
		);

		$image_repeater->add_control(
			'image_title',
			array(
				'label'   => esc_html__( 'Image Title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Gallery Image', 'edu-consultancy' ),
			)
		);

		$image_repeater->add_control(
			'category',
			array(
				'label'       => esc_html__( 'Category Slug', 'edu-consultancy' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'events',
				'description' => esc_html__( 'Enter the category slug this image belongs to. Must match a category slug defined above (e.g., "events", "students", "campus").', 'edu-consultancy' ),
			)
		);

		$image_repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'edu-consultancy' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'edu-consultancy' ),
				'show_external' => true,
				'default'     => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);

		$this->add_control(
			'gallery_images',
			array(
				'label'       => esc_html__( 'Gallery Images', 'edu-consultancy' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $image_repeater->get_controls(),
				'default'     => array(
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80' ),
						'image_title' => esc_html__( 'Graduation Ceremony', 'edu-consultancy' ),
						'category'    => 'events',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80' ),
						'image_title' => esc_html__( 'Student Study Group', 'edu-consultancy' ),
						'category'    => 'students',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=800&q=80' ),
						'image_title' => esc_html__( 'Campus Building', 'edu-consultancy' ),
						'category'    => 'campus',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80' ),
						'image_title' => esc_html__( 'Team Meeting', 'edu-consultancy' ),
						'category'    => 'events',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&q=80' ),
						'image_title' => esc_html__( 'Library Study', 'edu-consultancy' ),
						'category'    => 'students',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80' ),
						'image_title' => esc_html__( 'Modern Campus', 'edu-consultancy' ),
						'category'    => 'campus',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80' ),
						'image_title' => esc_html__( 'Workshop Session', 'edu-consultancy' ),
						'category'    => 'events',
					),
					array(
						'image'       => array( 'url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&q=80' ),
						'image_title' => esc_html__( 'Student Presentation', 'edu-consultancy' ),
						'category'    => 'students',
					),
				),
				'title_field' => '{{{ image_title }}}',
			)
		);

		$this->end_controls_section();

		// Style Section - Title.
		$this->start_controls_section(
			'style_title_section',
			array(
				'label' => esc_html__( 'Title', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Text Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1e293b',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .edu-gallery__title',
			)
		);

		$this->add_control(
			'title_spacing',
			array(
				'label'      => esc_html__( 'Bottom Spacing', 'edu-consultancy' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 32,
				),
				'selectors'  => array(
					'{{WRAPPER}} .edu-gallery__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Style Section - Categories.
		$this->start_controls_section(
			'style_categories_section',
			array(
				'label' => esc_html__( 'Category Filters', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => esc_html__( 'Text Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#64748b',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__category' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_active_color',
			array(
				'label'     => esc_html__( 'Active Text Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#25247B',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__category.is-active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f1f5f9',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__category' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_active_bg_color',
			array(
				'label'     => esc_html__( 'Active Background Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#25247B',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__category.is-active' => 'background-color: {{VALUE}}; color: #fff;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'selector' => '{{WRAPPER}} .edu-gallery__category',
			)
		);

		$this->add_control(
			'category_padding',
			array(
				'label'      => esc_html__( 'Padding', 'edu-consultancy' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'    => '10',
					'right'  => '20',
					'bottom' => '10',
					'left'   => '20',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .edu-gallery__category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'category_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'edu-consultancy' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 999,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 999,
				),
				'selectors'  => array(
					'{{WRAPPER}} .edu-gallery__category' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'category_gap',
			array(
				'label'      => esc_html__( 'Gap Between Categories', 'edu-consultancy' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 30,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .edu-gallery__categories' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Style Section - Images.
		$this->start_controls_section(
			'style_images_section',
			array(
				'label' => esc_html__( 'Gallery Images', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'edu-consultancy' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .edu-gallery__item img' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .edu-gallery__item' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_gap',
			array(
				'label'      => esc_html__( 'Gap Between Images', 'edu-consultancy' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .edu-gallery__grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .edu-gallery__item',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .edu-gallery__item',
			)
		);

		$this->add_control(
			'image_hover_scale',
			array(
				'label'        => esc_html__( 'Hover Scale Effect', 'edu-consultancy' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edu-consultancy' ),
				'label_off'    => esc_html__( 'No', 'edu-consultancy' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'image_overlay_color',
			array(
				'label'     => esc_html__( 'Overlay Color (on hover)', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(37, 36, 123, 0.8)',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__item:hover .edu-gallery__overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'image_title_color',
			array(
				'label'     => esc_html__( 'Image Title Color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .edu-gallery__item-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'image_title_typography',
				'selector' => '{{WRAPPER}} .edu-gallery__item-title',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$title            = isset( $settings['title'] ) ? $settings['title'] : '';
		$show_all         = isset( $settings['show_all_category'] ) && 'yes' === $settings['show_all_category'];
		$categories       = isset( $settings['categories'] ) && is_array( $settings['categories'] ) ? $settings['categories'] : array();
		$gallery_images   = isset( $settings['gallery_images'] ) && is_array( $settings['gallery_images'] ) ? $settings['gallery_images'] : array();
		$hover_scale      = isset( $settings['image_hover_scale'] ) && 'yes' === $settings['image_hover_scale'];

		// Build category slugs array for filtering.
		$category_slugs = array();
		foreach ( $categories as $cat ) {
			if ( isset( $cat['category_slug'] ) && ! empty( $cat['category_slug'] ) ) {
				$category_slugs[] = sanitize_key( $cat['category_slug'] );
			}
		}

		// Get first category slug for default filtering.
		$default_category = ! empty( $category_slugs ) ? $category_slugs[0] : '';

		// Widget ID for unique instance.
		$widget_id = 'edu-gallery-' . $this->get_id();
		?>
		<div class="edu-gallery" id="<?php echo esc_attr( $widget_id ); ?>">
			<?php if ( $title ) : ?>
				<h2 class="edu-gallery__title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $categories ) || $show_all ) : ?>
				<div class="edu-gallery__categories-wrapper">
					<div class="edu-gallery__categories" role="tablist" aria-label="<?php esc_attr_e( 'Gallery categories', 'edu-consultancy' ); ?>">
						<?php if ( $show_all ) : ?>
							<button type="button" class="edu-gallery__category is-active" data-category="all" role="tab" aria-selected="true">
								<?php esc_html_e( 'All', 'edu-consultancy' ); ?>
							</button>
						<?php endif; ?>
						<?php foreach ( $categories as $index => $cat ) : ?>
							<?php
							$cat_slug = isset( $cat['category_slug'] ) ? sanitize_key( $cat['category_slug'] ) : '';
							$cat_name = isset( $cat['category_name'] ) ? $cat['category_name'] : '';
							if ( empty( $cat_slug ) || empty( $cat_name ) ) {
								continue;
							}
							?>
							<button type="button" class="edu-gallery__category<?php echo ( ! $show_all && 0 === $index ) ? ' is-active' : ''; ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>" role="tab" aria-selected="<?php echo ( ! $show_all && 0 === $index ) ? 'true' : 'false'; ?>">
								<?php echo esc_html( $cat_name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="edu-gallery__grid" role="tabpanel">
				<?php foreach ( $gallery_images as $index => $item ) : ?>
					<?php
					$image_url = isset( $item['image']['url'] ) ? $item['image']['url'] : '';
					$image_title = isset( $item['image_title'] ) ? $item['image_title'] : '';
					$category = isset( $item['category'] ) ? sanitize_key( $item['category'] ) : '';
					$link = isset( $item['link']['url'] ) ? $item['link']['url'] : '';
					$link_target = isset( $item['link']['is_external'] ) && $item['link']['is_external'] ? '_blank' : '';
					$link_rel = isset( $item['link']['nofollow'] ) && $item['link']['nofollow'] ? 'nofollow' : '';

					if ( empty( $image_url ) ) {
						continue;
					}

					// Hide items that don't match the default category if "All" is not shown.
					$should_show = $show_all || empty( $default_category ) || $category === $default_category;
					$item_classes = 'edu-gallery__item';
					$item_classes .= ' edu-gallery__item--' . esc_attr( $category );
					if ( $hover_scale ) {
						$item_classes .= ' edu-gallery__item--scale';
					}
					if ( ! $should_show ) {
						$item_classes .= ' edu-gallery__item--hidden';
					}
					?>
					<div class="<?php echo esc_attr( $item_classes ); ?>" data-category="<?php echo esc_attr( $category ); ?>"<?php echo $should_show ? '' : ' style="display: none;"'; ?>>
						<?php if ( $link ) : ?>
							<a href="<?php echo esc_url( $link ); ?>" <?php echo $link_target ? 'target="' . esc_attr( $link_target ) . '"' : ''; ?> <?php echo $link_rel ? 'rel="' . esc_attr( $link_rel ) . '"' : ''; ?> class="edu-gallery__link">
						<?php endif; ?>
							<div class="edu-gallery__image-wrap">
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_title ); ?>" loading="lazy" />
								<?php if ( $image_title ) : ?>
									<div class="edu-gallery__overlay">
										<span class="edu-gallery__item-title"><?php echo esc_html( $image_title ); ?></span>
									</div>
								<?php endif; ?>
							</div>
						<?php if ( $link ) : ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<script>
		(function() {
			var gallery = document.getElementById('<?php echo esc_js( $widget_id ); ?>');
			if (!gallery) return;

			var categories = gallery.querySelectorAll('.edu-gallery__category');
			var items = gallery.querySelectorAll('.edu-gallery__item');
			var showAll = <?php echo $show_all ? 'true' : 'false'; ?>;
			var defaultCategory = '<?php echo esc_js( $default_category ); ?>';

			// Initialize: show only first category items if "All" is not enabled
			if (!showAll && defaultCategory) {
				items.forEach(function(item) {
					var itemCategory = item.getAttribute('data-category');
					if (itemCategory !== defaultCategory) {
						item.style.display = 'none';
					}
				});
			}

			categories.forEach(function(btn) {
				btn.addEventListener('click', function() {
					var category = this.getAttribute('data-category');
					
					// Update active state
					categories.forEach(function(b) {
						b.classList.remove('is-active');
						b.setAttribute('aria-selected', 'false');
					});
					this.classList.add('is-active');
					this.setAttribute('aria-selected', 'true');

					// Filter items
					items.forEach(function(item) {
						var itemCategory = item.getAttribute('data-category');
						if (category === 'all' || itemCategory === category) {
							item.style.display = '';
							setTimeout(function() {
								item.style.opacity = '1';
								item.style.transform = 'scale(1)';
							}, 10);
						} else {
							item.style.opacity = '0';
							item.style.transform = 'scale(0.8)';
							setTimeout(function() {
								item.style.display = 'none';
							}, 300);
						}
					});
				});
			});
		})();
		</script>
		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * @return void
	 */
	protected function content_template() {
		?>
		<#
		var title = settings.title || '';
		var showAll = settings.show_all_category === 'yes';
		var categories = settings.categories || [];
		var galleryImages = settings.gallery_images || [];
		var hoverScale = settings.image_hover_scale === 'yes';
		var widgetId = 'edu-gallery-' + view.getID();
		var defaultCategory = categories.length > 0 && categories[0].category_slug ? categories[0].category_slug : '';
		#>
		<div class="edu-gallery" id="{{{ widgetId }}}">
			<# if (title) { #>
				<h2 class="edu-gallery__title">{{{ title }}}</h2>
			<# } #>

			<# if (categories.length || showAll) { #>
				<div class="edu-gallery__categories-wrapper">
					<div class="edu-gallery__categories" role="tablist">
						<# if (showAll) { #>
							<button type="button" class="edu-gallery__category is-active" data-category="all"><?php esc_html_e( 'All', 'edu-consultancy' ); ?></button>
						<# } #>
						<# _.each(categories, function(cat, index) { #>
							<button type="button" class="edu-gallery__category<# if (!showAll && index === 0) { #> is-active<# } #>" data-category="{{{ cat.category_slug }}}">{{{ cat.category_name }}}</button>
						<# }); #>
					</div>
				</div>
			<# } #>

			<div class="edu-gallery__grid">
				<# _.each(galleryImages, function(item, index) { #>
					<# if (!item.image || !item.image.url) return; #>
					<# var shouldShow = showAll || !defaultCategory || item.category === defaultCategory; #>
					<div class="edu-gallery__item edu-gallery__item--{{{ item.category }}}<# if (hoverScale) { #> edu-gallery__item--scale<# } #><# if (!shouldShow) { #> edu-gallery__item--hidden<# } #>" data-category="{{{ item.category }}}"<# if (!shouldShow) { #> style="display: none;"<# } #>>
						<# if (item.link && item.link.url) { #>
							<a href="{{{ item.link.url }}}" class="edu-gallery__link">
						<# } #>
							<div class="edu-gallery__image-wrap">
								<img src="{{{ item.image.url }}}" alt="{{{ item.image_title || '' }}}" />
								<# if (item.image_title) { #>
									<div class="edu-gallery__overlay">
										<span class="edu-gallery__item-title">{{{ item.image_title }}}</span>
									</div>
								<# } #>
							</div>
						<# if (item.link && item.link.url) { #>
							</a>
						<# } #>
					</div>
				<# }); #>
			</div>
		</div>
		<?php
	}
}

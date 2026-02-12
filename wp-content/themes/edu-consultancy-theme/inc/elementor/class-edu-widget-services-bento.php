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
		$limit       = isset( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;

		if ( $limit < 1 ) {
			$limit = 6;
		}

		$query = new WP_Query(
			array(
				'post_type'      => 'services',
				'post_status'    => 'publish',
				'posts_per_page' => $limit,
				'orderby'        => 'menu_order title',
				'order'          => 'ASC',
			)
		);

		if ( ! $query->have_posts() ) {
			return;
		}

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
				while ( $query->have_posts() ) :
					$query->the_post();
					$index++;

					$classes = array( 'edu-services-bento__item' );

					// Basic bento-style variation: make first card large, others smaller.
					if ( 1 === $index ) {
						$classes[] = 'edu-services-bento__item--featured';
					} elseif ( in_array( $index, array( 2, 3 ), true ) ) {
						$classes[] = 'edu-services-bento__item--tall';
					}

					$excerpt = get_the_excerpt();
					?>
					<article <?php post_class( implode( ' ', array_map( 'sanitize_html_class', $classes ) ) ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="edu-services-bento__media">
								<?php the_post_thumbnail( 'large', array( 'class' => 'edu-services-bento__image' ) ); ?>
							</div>
						<?php endif; ?>
						<div class="edu-services-bento__body">
							<h3 class="edu-services-bento__service-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<?php if ( $excerpt ) : ?>
								<p class="edu-services-bento__service-text">
									<?php echo esc_html( wp_trim_words( $excerpt, 20, '…' ) ); ?>
								</p>
							<?php endif; ?>
						</div>
						<footer class="edu-services-bento__footer">
							<a class="edu-services-bento__link" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Learn more', 'edu-consultancy' ); ?>
							</a>
						</footer>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php
	}
}


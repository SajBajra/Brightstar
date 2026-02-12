<?php
/**
 * Theme footer.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If Elementor Theme Builder defines a footer, output it and bail.
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
	wp_footer();
	?>
	</body>
	</html>
	<?php
	return;
}
?>

<footer class="site-footer">
	<div class="edu-container">
		<div class="site-footer-inner">
			<p>
				<?php
				/* translators: %s: site name. */
				printf( esc_html__( '© %s. All rights reserved.', 'edu-consultancy' ), esc_html( get_bloginfo( 'name' ) ) );
				?>
			</p>

			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'edu-consultancy' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>


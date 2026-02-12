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
	<div class="edu-container site-footer__inner">
		<div class="site-footer__col site-footer__brand">
			<h3 class="site-footer__title">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</h3>
			<p class="site-footer__text">
				<?php esc_html_e( 'Education & migration consultancy helping students and professionals find the right pathway abroad.', 'edu-consultancy' ); ?>
			</p>
			<p class="site-footer__text">
				<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
			</p>
			<p class="site-footer__text">
				<?php
				$admin_email = get_option( 'admin_email' );
				if ( $admin_email ) {
					printf(
						/* translators: %s: admin email. */
						esc_html__( 'Email: %s', 'edu-consultancy' ),
						esc_html( $admin_email )
					);
				}
				?>
			</p>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php esc_html_e( 'Important Links', 'edu-consultancy' ); ?></h4>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'edu-consultancy' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => '__return_empty_string',
					)
				);
				?>
			</nav>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php esc_html_e( 'Helpful Resources', 'edu-consultancy' ); ?></h4>
			<ul class="site-footer__links">
				<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms of Use', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'edu-consultancy' ); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="edu-container site-footer__bottom-inner">
			<p class="site-footer__copy">
				<?php
				/* translators: %s: site name. */
				printf( esc_html__( '© %s. All rights reserved.', 'edu-consultancy' ), esc_html( get_bloginfo( 'name' ) ) );
				?>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>


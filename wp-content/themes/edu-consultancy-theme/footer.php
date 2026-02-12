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
	<div class="edu-container site-footer__top">
		<div class="site-footer__col site-footer__brand">
			<h3 class="site-footer__title">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</h3>
			<p class="site-footer__text">
				<?php esc_html_e( 'Your trusted education & migration partner for study, work and PR pathways abroad.', 'edu-consultancy' ); ?>
			</p>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php esc_html_e( 'Services', 'edu-consultancy' ); ?></h4>
			<ul class="site-footer__links">
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Study Abroad', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Student Visa', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'PR / Skilled Migration', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Family & Partner Visa', 'edu-consultancy' ); ?></a></li>
			</ul>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php esc_html_e( 'Company', 'edu-consultancy' ); ?></h4>
			<ul class="site-footer__links">
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/countries/' ) ); ?>"><?php esc_html_e( 'Countries', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/jobs/' ) ); ?>"><?php esc_html_e( 'Jobs', 'edu-consultancy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'edu-consultancy' ); ?></a></li>
			</ul>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php esc_html_e( 'Contact Us', 'edu-consultancy' ); ?></h4>
			<ul class="site-footer__links">
				<li>
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
				</li>
				<li><?php esc_html_e( 'Phone: Add your number', 'edu-consultancy' ); ?></li>
				<li><?php esc_html_e( 'Address: Add your office location', 'edu-consultancy' ); ?></li>
			</ul>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="edu-container site-footer__bottom-inner">
			<div class="site-footer__bottom-links">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'edu-consultancy' ); ?></a>
				<span>•</span>
				<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'edu-consultancy' ); ?></a>
				<span>•</span>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'edu-consultancy' ); ?></a>
			</div>
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


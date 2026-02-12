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
	<div class="site-footer__overlay"></div>

	<div class="site-footer__inner">
		<div class="site-footer__card">
			<div class="site-footer__top">
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

				<div class="site-footer__col site-footer__subscribe">
					<h4 class="site-footer__heading"><?php esc_html_e( 'Stay Updated', 'edu-consultancy' ); ?></h4>
					<p class="site-footer__text">
						<?php esc_html_e( 'Get visa, jobs and study updates in your inbox.', 'edu-consultancy' ); ?>
					</p>
					<form class="site-footer__form" action="#" method="post">
						<label class="screen-reader-text" for="edu-footer-email"><?php esc_html_e( 'Email address', 'edu-consultancy' ); ?></label>
						<input type="email" id="edu-footer-email" name="email" placeholder="<?php esc_attr_e( 'Enter your email', 'edu-consultancy' ); ?>" />
						<button type="submit" class="edu-btn-primary site-footer__submit">
							<?php esc_html_e( 'Subscribe', 'edu-consultancy' ); ?>
						</button>
					</form>
				</div>
			</div>

			<div class="site-footer__bottom">
				<div class="site-footer__bottom-inner">
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
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>


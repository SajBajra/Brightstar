<?php
/**
 * Theme header.
 *
 * Intentionally minimal so Elementor Theme Builder can fully control the header.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}

// If Elementor Theme Builder defines a header, output it and do not render the default header markup.
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
	return;
}
?>

<header class="site-header">
	<div class="edu-container site-header__inner">
		<button type="button" class="site-header__toggle" aria-expanded="false" aria-controls="site-header-nav" aria-label="<?php esc_attr_e( 'Toggle menu', 'edu-consultancy' ); ?>">
			<span class="site-header__toggle-icon" aria-hidden="true"></span>
		</button>
		<div class="site-header__brand">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				Edu_Theme_Helpers::render_site_logo( 'site-header__logo-img' );
			}
			?>
		</div>

		<div class="site-header__center" id="site-header-nav">
			<nav class="site-header__nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'edu-consultancy' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'primary-menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		</div>

		<div class="site-header__actions">
			<?php if ( is_user_logged_in() ) : ?>
				<a class="edu-btn-outline site-header__btn" href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">
					<?php esc_html_e( 'Logout', 'edu-consultancy' ); ?>
				</a>
			<?php else : ?>
				<a class="edu-btn-outline site-header__btn edu-modal-trigger" href="#" data-modal="login" aria-haspopup="dialog">
					<?php esc_html_e( 'Login', 'edu-consultancy' ); ?>
				</a>
				<a class="edu-btn-primary site-header__btn edu-modal-trigger" href="#" data-modal="register" aria-haspopup="dialog">
					<?php esc_html_e( 'Register', 'edu-consultancy' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>


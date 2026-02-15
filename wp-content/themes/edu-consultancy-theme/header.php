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
		<div class="site-header__brand">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__title">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</a>
				<?php
			}
			?>
		</div>

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

		<div class="site-header__actions">
			<a class="site-header__link" href="<?php echo esc_url( get_post_type_archive_link( 'jobs' ) ); ?>">
				<?php esc_html_e( 'Find Jobs', 'edu-consultancy' ); ?>
			</a>
			<?php if ( is_user_logged_in() ) : ?>
				<a class="edu-btn-outline site-header__btn" href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">
					<?php esc_html_e( 'Logout', 'edu-consultancy' ); ?>
				</a>
			<?php else : ?>
				<a class="edu-btn-outline site-header__btn" href="<?php echo esc_url( wp_login_url() ); ?>">
					<?php esc_html_e( 'Login', 'edu-consultancy' ); ?>
				</a>
				<a class="edu-btn-primary site-header__btn" href="<?php echo esc_url( wp_registration_url() ); ?>">
					<?php esc_html_e( 'Register', 'edu-consultancy' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>


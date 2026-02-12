<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'brightstar' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Z7vg^D,h 9<[P>zU}aptSv&%AIQ$vj3_bWC{/*HE~3H/!2EmOKdwBcbn} Kh[Ga4' );
define( 'SECURE_AUTH_KEY',  'S>%ev<=QP-2}na1xcOcw<e%9$<Xs]&cR6nCu0&`J|wVHm~ >}7o<No?I0gJ|}i}}' );
define( 'LOGGED_IN_KEY',    '}e}dgIvy;.5Zu^rMC~~K8(zrTaVfn)Uq]9q1ln^pApp~1sL+M5*a7P>Kxig rhRA' );
define( 'NONCE_KEY',        '42}h;^%z.iXzk^< FDd)FwAgt;*J%@_0coMZaV{cN)y#)Z(|aqAm/.V2Yz3Xuba;' );
define( 'AUTH_SALT',        '_}^=1c}{W:@rD$wyW>c^%y^m++5;`Ns+dWsu:;cTWU|g8J#`6=epY&y%-xwlo%.8' );
define( 'SECURE_AUTH_SALT', '?Q~8>?@#Snf!qLXP3`h>? Nv{jxC0<$N=)+0d((0;S)CV7QbE6`|4 3E267W. J_' );
define( 'LOGGED_IN_SALT',   '#E;{8{.ufdvRLq8NJcG)=y>u80DtC5:=.z|c2%Cf,5` ]}jln1@y5U=+k@ )i?1b' );
define( 'NONCE_SALT',       ' /r7Sg|+Ob+wefmOx?Plu[K]woUr&nvZph(EjfFhp$}ofdEP!m7j8!thC6)}]#d,' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

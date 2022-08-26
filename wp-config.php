<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'harper_db' );

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
define( 'AUTH_KEY',         '4_a`<Q CivCXT9 <K:E6R9d4[-rcmzf9<MLz%iXqT|F&D1jA,NI7Kw8<hTVB0dN.' );
define( 'SECURE_AUTH_KEY',  '|im@9!Y1m#UmR)!L,FfcJee*rZ!tE0L!!&.AA?QBZLLj[2};|y6cPzR,ZaR$$IRN' );
define( 'LOGGED_IN_KEY',    'r#f%]_X#leB3t-5bZH(6qaqc]5;D,rx2:CTmxMY%S5M!R}u3r$kO/Y:AYl]d.!^W' );
define( 'NONCE_KEY',        'G3`QkgP/8&eej|^[t ;+ekpe`O(+<G )|LL4&W`^T_Lz-n@fEc`iTS2(SNp}5K{B' );
define( 'AUTH_SALT',        'k9B.cC7tp^%&EMZiWbA>{Oex{OSr>wM%u#~59ZLx^a!(<eLFHDD:8ab{/>0Yd.95' );
define( 'SECURE_AUTH_SALT', '(rI,rFt*-^vRl#O|,Ek@|Arpn@n(P$vh*cZ&RbX ca1NGAga@BS,WaPssWF|us/x' );
define( 'LOGGED_IN_SALT',   'MlLcaa*&oRKI_jgOb_q;E>,LM&}}q!s*bcd1>cZ)/)pZuCyK9GXx),&@QbD@bXqo' );
define( 'NONCE_SALT',       'mp$d9!a;U&k_#0S~d@U&K_7McuCdaiG{%]Zrl,n,e;dtT$fDm,Xpe-vK]pNiQcF%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbs40443' );

/** MySQL database username */
define( 'DB_USER', 'dbu105886' );

/** MySQL database password */
define( 'DB_PASSWORD', 'TheorVbdd6#' );

/** MySQL hostname */
define( 'DB_HOST', 'db5000045538.hosting-data.io' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '`|wRt![3JF)*W,`Be6QOq|-oA7>+0e|O@vj/0h:Dyx1>/mLr;-?fCB+26CW+o[V=' );
define( 'SECURE_AUTH_KEY',  '~y*$W9Ph)5U@GzA4Z#|{b g:]*.=>tQ-u-%24Q$&$r957(pgj,7AT3eZ@^2jO|j+' );
define( 'LOGGED_IN_KEY',    'IM*?sDtN4U9##i__;/~v^->nu@Hqj6C.C|!V]~40,`A-Y4S cdkLJF=#9S3%{JsE' );
define( 'NONCE_KEY',        'yC<R%xniR 0<G+(>/8wDL9T^bz*Q,7A&/B3!BP:sX135tME7T+K<>9}Qu*pBSBsa' );
define( 'AUTH_SALT',        '6z@orX5KsA#;A~UYGe<R>+dhJ$#y0vKdJ*.U6ECRdimB)$xca=2;asxgzKAFkKAu' );
define( 'SECURE_AUTH_SALT', 'R[aTccH1z|T,q6D0i-<XnN,G6R2L7`G}sx&EpQB_j!W+:HGDn C3U6]^Mv5,mDN[' );
define( 'LOGGED_IN_SALT',   '4AErnKcfs`0jOI]n_jyVi#t-0lK/p:Ie(*^*<l1Qd`H+XwD1$2Ls7Zi$*^,}:AT^' );
define( 'NONCE_SALT',       'c&vsK*n_q5J_ ?`LBb)AE_VVla95CP`n!Z3/Or>l$CbS2~^L8n#RO3yBTEdV8?*n' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpstg0_';// = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

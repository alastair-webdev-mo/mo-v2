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


if ( file_exists( dirname( __FILE__ ) . '/local-config-file.php')) {
	include( dirname( __FILE__ ) . '/local-config-file.php'); 
} else {
	define('DB_NAME','mo-wp-wp-ahzKBv1f');
	define('DB_USER','kvDcurilJpSQ');
	define('DB_PASSWORD','ally622524');
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*~izfLhJd=io>JK.cTR1M3x,AL]GNYPL$:)DPkYHm=DNZ-R!!>qzeNM03PUX6fNC');
define('SECURE_AUTH_KEY',  '&J^ENV1!hPJA_V7+J%H4nU!GtU 32^d&r iW[Ju0:9DIDF#-FBn4!E|v|LHXfSSt');
define('LOGGED_IN_KEY',    'XA??K0.v&VDTcBK!.Clww)vJOHWNbi$SeW]<ut-f[qLZsQb%C;~]K3!<GU:NTAat');
define('NONCE_KEY',        '.MXDZx,Qtt-c$C8_fV/#s8?BrqgjqM+l,8MO5)1rv k{=iTs@a}{rWVX}YD:g[~|');
define('AUTH_SALT',        ' O+y7Uz|.s20S1lkhi8d$p,!gx:ES*#`^i:CmQl.~[&0RM46p(C>yj/W6La1><A`');
define('SECURE_AUTH_SALT', 'S*9)a(TR%UMdf.E:*g~+r``bJ]20~&JWt]6&&5-dp18#fKYY5JCrW-0oHoP(H|*&');
define('LOGGED_IN_SALT',   'KqYD%YJ%nK^QhtT>oI!K.cGg`n$Xexlb^czQ[7lzvOK*4p4%j}<yq_P/(&/%<-V$');
define('NONCE_SALT',       'S7<J:|@TN^Ro4PRXGor_=!=$E&+Ko$a[k+BYFINB}8NlMxt;|rNW;y}DQ3OvWJ0V');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

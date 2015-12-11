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
define('DB_NAME', 'treble');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '8P&W?Hj+-Ge|EZtvwI0#0Y}nN<%m3TOel-b9Awd)w-^hW`ek=F;;K O0e0Y,1JZO');
define('SECURE_AUTH_KEY',  ';(7Bz q *^WAfXxE/-TT7}N`-Fl6G+[>:Tmo(W^UWLZSL8{6J,wyMt(zzp!,u#_6');
define('LOGGED_IN_KEY',    '/@(*[v?/*HMJY+1T|5+JyQq@/?shB-(9J>;OS`{*?-vGD<rN3WBRz%yYu}[VEQ:O');
define('NONCE_KEY',        ',3QK=<]cD/?/4QFq*Yu L{8-SP26C%tO8mCm[67`}D}Y]z%X~rBnVL?p#@|_lf0`');
define('AUTH_SALT',        'CKlrUL4+6v<|zQ(zYa=m.p0N`9}H1-pBCbF61Ba<|jKC>t-/w}GJ?%e9c=6Y.2!+');
define('SECURE_AUTH_SALT', 'jmeJ(N<(`{m. [:#ZWlO|Tz]|Ti`P@N8:&vU%q^99o/x@Rne2u|:+9DS<JbG=YFp');
define('LOGGED_IN_SALT',   ']dS|%E!c+*0)^:{+w$r$d~!z,3mqPV6.x7r9l8yuDA:+7&[e1~1RbD XYs2L7wJ1');
define('NONCE_SALT',       'qj^U+s_xehr-~w%)|:#}e(+xTEBOfK}L+;+*a$KD>w@%ur5l>i>,7@QX-d_V6[~W');

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

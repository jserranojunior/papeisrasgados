<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('FS_METHOD', 'direct');

/** The name of the database for WordPress */
define('DB_NAME', 'papeisrasgados');
/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');




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
define('AUTH_KEY',         'QI!K_n{Ot^za(a$+l /*|Ej[/!jql>ZF7pw9^kY?VV?-- Ufaj>BDb?L+unmCGj;');
define('SECURE_AUTH_KEY',  'c_8AL.Bz@Nh->r5a<0.qCzAi%$=-Yy]*qli(I9?7}g%u6p*~6*PPB&#};8zH+s?;');
define('LOGGED_IN_KEY',    'Y?uEpCtOO8EK;z1bi|Y/mCo7)O59$KZ)IcW0T;g:GVSK>.REI4E)fh^k?;d$0:7+');
define('NONCE_KEY',        'y#oSbta?e>tg#hG^KMSzbbM,g//*Bp=~ ]@sk?RRmQ4cL6`(t7|5a)JrisZ%*|H7');
define('AUTH_SALT',        'jR}cy:?l`R0j#TKTUn$|$5S/I++i=8t@?c*Ij2fX3xfsow%YI:^ys4[K12j]4bKH');
define('SECURE_AUTH_SALT', '~`:P+iR*k^k%&-0.NcVB_A1`?(K6mF~1n`HI)eCf&Mu#a?F&OI,p]GFNk20yuUga');
define('LOGGED_IN_SALT',   'SDm5?g;4Dh|)-(}H{hQf|RE625|c7{QmdFV| 84)cxLXah5d:-!3^-q.$Q87%E)F');
define('NONCE_SALT',       'XW|.Z0|0ru|+be7L_6NMSD$P)o~nQW*A9rt(noF;39m:<8#=/P0eH[+f-E;QrEp~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

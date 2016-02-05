<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'ovgroningen');

/** MySQL database username */
define('DB_USER', 'ovgroningen');

/** MySQL database password */
define('DB_PASSWORD', '$_Vng2015');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
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
define('AUTH_KEY',         'W_!E+p%>WNHZK)L,ZU>-ay)|radlq4-<Y!l.LT+O~N5EMBa4nM-o*<6t_AT %w1 ');
define('SECURE_AUTH_KEY',  '$/+RY:/bzw%1NOSiN7@,}4] qv--R[SKauu9;5HP`ykT(Cs$$E?g9{b{MJt0<pUy');
define('LOGGED_IN_KEY',    'J=GU%YFv= x{d?p)k*iosUv,?R`:oN=?M$ok1Z&=yTqi*ZVe5$_qAB>TvYl n=s{');
define('NONCE_KEY',        '=:+l!DPLWRF]r:4*6+18,[/2q&_W*&rsSrwOfX-1j-KVoUrSP#zpWo`EE.%[L;rg');
define('AUTH_SALT',        'q{X+9(_;#*a.xIo!8cN(|f`hV-3V.IU.:=[tsU5uPolJ8[SfD]x~.+;J ZOUM2;c');
define('SECURE_AUTH_SALT', 'VVbsM$s!<G1)#kK_N%g e)&ISU->h+MvB)D~)aKtGLg@>.M,^|{x&h~(Vul^@h:h');
define('LOGGED_IN_SALT',   '8|ms/Q~`!$FDWzK6h5+{6a7vrIr(ZCc.omS=qL|IeItHP0(]=`;&/R*ebAId9i{K');
define('NONCE_SALT',       '$%A+K]xZUepl-)}KD}rGlf(_2Py3{je=0BLkqM}zRY2HsdTlY>=FowB DSso5Ie)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
define('WP_TEMP_DIR', dirname(__FILE__) . '/wp-content/temp/');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

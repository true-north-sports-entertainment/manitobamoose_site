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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/** @desc this loads the composer autoload file */
require_once __DIR__ . '/vendor/autoload.php';
/** @desc this instantiates Dotenv and passes in our path to .env */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
defined('DB_NAME') or define('DB_NAME', $_ENV['DB_NAME']);

/** Database username */
defined('DB_USER') or define('DB_USER', $_ENV['DB_USER']);

/** Database password */
defined('DB_PASSWORD') or define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

/** Database hostname */
defined('DB_HOST') or define('DB_HOST', $_ENV['DB_HOST']);

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_DEBUG', $_ENV['WP_DEBUG'] );
define( 'WP_DEBUG_LOG', $_ENV['WP_DEBUG_LOG'] );
define( 'WP_DEBUG_DISPLAY', $_ENV['WP_DEBUG_DISPLAY'] );

// Extra measure to prevent warnings from displaying
@ini_set('display_errors', 0);
@ini_set('display_startup_errors', 0);

define( 'SAVEQUERIES', $_ENV['SAVEQUERIES'] );
if ( $_ENV['WP_ENVIRONMENT_TYPE'] != 'local' ) {
	define( 'WP_AUTO_UPDATE_CORE', false );
	define( 'DISALLOW_FILE_MODS', true );
}

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
define('AUTH_KEY',         'XalJG|*g[4[6jtwgHEQyp+w/<|x!D2wPt|.ybQd]IrE5A4.(rx`]|flFCT=Y&TMo');
define('SECURE_AUTH_KEY',  '/,&1.-Tq|L0kA^uZ1v,_ex-?u0S+&BAXgRyuv;ejn>pe}:-0*|J)m-G~HQ9gYU0h');
define('LOGGED_IN_KEY',    '53uM+D7=XK`?VnJP;Wy7RT_FutAMP?f<~q/ds^Ij-9dxDN#+d|-DFYzFqsO04:WL');
define('NONCE_KEY',        '#pD:Uc?4_817aKP*h9z&o|LBvPfq&?iJ<;pND,k)F`J:t&8TIY=0[q.*8txp30QD');
define('AUTH_SALT',        'Lc&f+1S+9I{h:)5&,5PfzDtvI[tJSBHBoXS8|}UJW+Ovke>^IE#-cya(5JdJ<r()');
define('SECURE_AUTH_SALT', 'x,$KWk)5)}fbFef:~#(am8ysC)zn?-&&X] F>n+%x?-g-&|mmawL]`A7YT,q xeC');
define('LOGGED_IN_SALT',   'plL?_56<I-d=}QH(&<5-)B.-1-X[hXXDb>rac9{^C|G$;naD%DX_#UF>-n$uP1TP');
define('NONCE_SALT',       '2=sKLHiP[GZ-?~fop{CfRx1|NcQv2&0AmDDL^|VAZ$e#>}53(/(O@=BGaF}&@UqS');

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
defined('WP_DEBUG') or define('WP_DEBUG', $_ENV['WP_DEBUG']);

/* Add any custom values between this line and the "stop editing" line. */
defined('WP_HOME') or define('WP_HOME', $_ENV['WP_HOME']);
defined('WP_SITEURL') or define('WP_SITEURL', $_ENV['WP_SITEURL']);
defined('WP_DEBUG_DISPLAY') or define('WP_DEBUG_DISPLAY', $_ENV['WP_DEBUG_DISPLAY']);

defined('AWS_ACCESS_KEY_ID') or define('AWS_ACCESS_KEY_ID', $_ENV['AWS_ACCESS_KEY_ID']);
defined('AWS_SECRET_ACCESS_KEY') or define('AWS_SECRET_ACCESS_KEY', $_ENV['AWS_SECRET_ACCESS_KEY']);

/**
 * Allow WordPress to detect HTTPS when used behind Amazon AWS CloudFront
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO']) && $_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'] === 'https') {
  $_SERVER['HTTPS'] = 'on';
}
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

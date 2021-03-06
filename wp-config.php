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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JdM1dmkylpzNEJvxW3j2H7aIA2sqSO2sXlby4sFlLQTy7pqucTgbwglufqV4mxThRRhpiZy7m9NkRKM3bPVNxQ==');
define('SECURE_AUTH_KEY',  'ZGWOdT43JELw1/ma+KLVded58mWSLN4d52rUZsxbxaY2Ea33lIPnkujVacH9zXgoMaV6C7ntpXJAnOkOTJ2QsA==');
define('LOGGED_IN_KEY',    'MwOlW9LrIPD3237lq5yep2OLwglFhuWCDrru2TtrcVrwYXy51jMtrYXuV3fLpdiIj8d+Iv7gtSUWfTe0C9fOdg==');
define('NONCE_KEY',        'fuYe3w8RthldVgbidxL0xWgotyt1T0T74j29R3Pa0Jmc07tvO2GnRufyWpmd/3Sptz7Wpm4adCIntsvQguRQHw==');
define('AUTH_SALT',        'Oe1RcQ+pKyp3gIRN8CdHiw9RgPFERb0rM1rpLD5ahCPcYBenlloa1eOBmT3WWE+0yzSjyz8+MnHaIuTkwX4Hyw==');
define('SECURE_AUTH_SALT', 'gGLsT2xFPdRusD/2mqo0D2FzUa9Qkf1tKcFFRxwyNDBT54PRr50/bauHR+xsecpS70wt/W+I9t05RiUXmlwtKw==');
define('LOGGED_IN_SALT',   'HDYSwStUQ3cxBDuzITD38Kg86gk/Y/YbMI1nVymOIt6dhn74zaYMN/D8UP6YGdzf/goS6/kRoxgNfmwP9jVy0w==');
define('NONCE_SALT',       '5cSUvkiAueGwUSmImQyUV1xo61x04B23pm47eMIbG4smIVGGFReInrCmx3U4x7w7RQvG6iT6tOc33n0tpAsrBw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

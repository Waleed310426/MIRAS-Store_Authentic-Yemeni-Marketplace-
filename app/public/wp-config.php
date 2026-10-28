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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'ND]}<lqq6$<;W$v0.z&;3T!>0KwMaeU0W/]a$FN{034.NI1m2HkW#NY*7`bm7!wd' );
define( 'SECURE_AUTH_KEY',   'z `LsZ<K4Y ZG}H#J^zT|LzaMDu4TI6#L>r:/@!b_$:@ZOnuZ>4mgoi!!fum.MG}' );
define( 'LOGGED_IN_KEY',     'PJ0(!jAhVa&$~F19wp[w-1?!GmnSi@E=HNst:Yf^e>)!MC71I$DU&Jm^:nN(;PZn' );
define( 'NONCE_KEY',         'b].Y*j;3Pd}E/2Vu)?#hc/9z/A/ni9TTLkyja+ng:F@^tO!gDuwP8ix+n,nSDWgQ' );
define( 'AUTH_SALT',         '^X$Si#C7YXCx5k:p4PcI.}Zfh;!)!nMXp^/2<_(86A$2Be!<jHUtDv2k3{~]Ow(/' );
define( 'SECURE_AUTH_SALT',  '&]TkNhos<]T&I/13G6ZtzZ]1mwh|} YGXnLECORR=vNdikRNPs=6_LH0T<G$vz<@' );
define( 'LOGGED_IN_SALT',    'w9tw2rtQ^/ml/WVX.ba#9=ijhhjKu0D3@z|a}&y7/d.5K$0ek(`P?PW^#Xcu~Sw}' );
define( 'NONCE_SALT',        '`ZocT-u0X[(:h6@*E[9ZEfc0l?;wbSAh,cpBhqBO~aej0$D<8oDwSy093b6fhMBo' );
define( 'WP_CACHE_KEY_SALT', '1=FZ_A]Ai75  MP @0QbQFmY]0dp9RF4%%EXY6vIjk]TIBu3_%TK,+J6qwr9@d,=' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );

// --- Antigravity Fixes ---
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');
@ini_set('display_errors', 0);
@ini_set('display_startup_errors', 0);
define('WP_DEBUG_DISPLAY', false);
// -------------------------
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


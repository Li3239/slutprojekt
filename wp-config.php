<?php
// $_SERVER["HTTPS"] = "on";
// define('WP_HOME', 'http://slutprojekt.test');
// define('WP_SITEURL', 'http://slutprojekt.test');

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'slutprojekt' );

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
define( 'AUTH_KEY',         '<Wp|I/lSwF1c!P!+:BRwua(DMgJnLmyOp:A-I19K/hOyE!y~rK<j]P:=-#>B}CJ9' );
define( 'SECURE_AUTH_KEY',  'q-w{T5]zNn2BihKugAQ+_Qr W+3uu[c<]:t@4N[ZH_|D+B^ibkDImZ|LrE22C&WQ' );
define( 'LOGGED_IN_KEY',    '};f}$3+ho&}rx:rA< %|T%J#)W#{ Lz,[7(T52zG|v^$,`3h_S`)9.+j!1`bnrI1' );
define( 'NONCE_KEY',        'b6XAsazni8m:&kT|(Bb*jn*?!+=GX.7:m_M~](++0(y@1OTxA%dC@qQX[25C%$3E' );
define( 'AUTH_SALT',        '0 )gV:{@U*LLAM*P+mj[T^wQQd&Bv2p>~<zNE<AH^?P9%/]W1JTy<thS7hD5&([J' );
define( 'SECURE_AUTH_SALT', '%Xk)fScf<|SD?!2:Z7<,]<!b|FecCc Sanx]c&/W5WDNF%)Z*|2l#j4*C[VgovF.' );
define( 'LOGGED_IN_SALT',   'Nr&Q;gn+nX/>=SgyfB][*], ?W[>X5n=$G<)MDR0mcM`0gIppa}0ZOwd`PL`TeWj' );
define( 'NONCE_SALT',       '9[S}YS2ssIspZ)jf>w78QZyd1]sM$&BL1Ndf^fMRivXy:1<Pjyw]=6C:Hi4_<]1C' );

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

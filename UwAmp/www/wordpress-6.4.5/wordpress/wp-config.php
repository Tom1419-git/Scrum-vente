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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'oh- @;rx{]HK6qCcH>9>#n[iDf!V2tWXy*GA8T=uF<C&JjGx^9kuQ+|;[e0f;@](' );
define( 'SECURE_AUTH_KEY',  'V/B+!_:p4j^%R2dYx7)XtZ/V`b)xQCM{,bA.n]6&H$,:|Jq@jKr+E S6@Um)h,co' );
define( 'LOGGED_IN_KEY',    'X|C=~y0?yM(3#vY]%XPo-lg2YW5!5nz#tX7kH.4Sv@^VX|`^tEf1#(h/W!%2t?)s' );
define( 'NONCE_KEY',        '^@s/TuRfZSi+W6EPbUdBJSHWFq5y?KQ>iU?AlRhVe!^cVc;kp,gzRW{-ZO6U75z{' );
define( 'AUTH_SALT',        'p6/y:0ZK|[G.=&))Q;2x`_VP*DD.BQ)rJ8 V4g}`j,e9(BC]@lAR(du5,ZQp^iY>' );
define( 'SECURE_AUTH_SALT', '7QIuU;$2Kh h(Pzy>FxB*@r}q/#+=@V=-N!gR}OX2o.y$w4R%qDfv&W-,h6)0uvP' );
define( 'LOGGED_IN_SALT',   '*426mC*i_F@lpIg2x j>Uva86YaL3pG _{F|f;=z!h=AA^c+A-yGac-ulE5$<Q&@' );
define( 'NONCE_SALT',       '[0nxm(fN`aM6=h*`r}ph2Acef(Xk{#Pd).:_mH)EevfK>`:-F%+u%c/.,+$Hp;~ ' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

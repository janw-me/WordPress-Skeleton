<?php

$enviroment = getenv('APP_ENV');

if ($enviroment == 'development') {
    define('DB_NAME', '%%');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('WP_SITEURL', '%%');
    define('WP_HOME', '%%');
    define('WP_DEBUG', true);
} else { //live
    define('DB_NAME', '%%');
    define('DB_USER', '%%');
    define('DB_PASSWORD', '%%');
    define('DB_HOST', 'localhost');
    define('WP_SITEURL', '%%');
    define('WP_HOME', '%%');
    define('WP_DEBUG', false);
}
define('FS_METHOD','direct');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
$table_prefix  = 'wp_'; // please change

//content dir
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// https://api.wordpress.org/secret-key/1.1/salt
define('AUTH_KEY',         '%%');
define('SECURE_AUTH_KEY',  '%%');
define('LOGGED_IN_KEY',    '%%');
define('NONCE_KEY',        '%%');
define('AUTH_SALT',        '%%');
define('SECURE_AUTH_SALT', '%%');
define('LOGGED_IN_SALT',   '%%');
define('NONCE_SALT',       '%%');

//define('WPLANG', 'nl_NL'); // NL
define('WPLANG', ''); // English

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
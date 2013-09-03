<?php
// set with: SetEnv APP_ENV development. In a vhost or a higher .htaccess
$enviroment = getenv( 'APP_ENV' );

if ( $enviroment == 'development' ) {
	// Database
	define( 'DB_NAME', '%%' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
	// ftp
	define( 'FTP_USER', '%%' );
	define( 'FTP_PASS', '%%' );
	define( 'FTP_HOST', '%%' );
	define( 'FTP_SSL', false );
	// Url
	define( 'WP_HOME', '%%' ); // example http://example.com  (no trailing slash)
	// Debug
	define( 'WP_DEBUG', true );
} else { //live
	// Database
	define( 'DB_NAME', '%%' );
	define( 'DB_USER', '%%' );
	define( 'DB_PASSWORD', '%%' );
	define( 'DB_HOST', 'localhost' );
	// ftp
	define( 'FTP_USER', '%%' );
	define( 'FTP_PASS', '%%' );
	define( 'FTP_HOST', '%%' );
	define( 'FTP_SSL', false );
	// Url
	define( 'WP_HOME', '%%' ); // example http://example.com  (no trailing slash)
	// Debug
	define( 'WP_DEBUG', false );
}
// DB
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
$table_prefix = 'wp_'; // please change with 2-3 random characters
// URL and dirs
define( 'WP_SITEURL', WP_HOME . '/wp' );
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', WP_HOME . '/content' );

// https://api.wordpress.org/secret-key/1.1/salt
define( 'AUTH_KEY', '%%' );
define( 'SECURE_AUTH_KEY', '%%' );
define( 'LOGGED_IN_KEY', '%%' );
define( 'NONCE_KEY', '%%' );
define( 'AUTH_SALT', '%%' );
define( 'SECURE_AUTH_SALT', '%%' );
define( 'LOGGED_IN_SALT', '%%' );
define( 'NONCE_SALT', '%%' );

define( 'WPLANG', 'nl_NL' ); // leave empty for English
// Auto save and Revisions
define( 'AUTOSAVE_INTERVAL', 300 ); // seconds
define( 'WP_POST_REVISIONS', 10 );
define( 'DISALLOW_FILE_EDIT', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
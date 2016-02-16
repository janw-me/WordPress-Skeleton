<?php
// Check if a local development file is defined and include it.
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
  include( dirname( __FILE__ ) . '/local-config.php' );
}

//====================================================================
// Fill in all the needed constants below
//====================================================================

// Database
define( 'DB_NAME',    '%%' );
define( 'DB_USER',    '%%' );
define( 'DB_PASSWORD','%%' );
define( 'DB_HOST',    'localhost' );
// ftp
define( 'FTP_USER', '%%' );
define( 'FTP_PASS', '%%' );
define( 'FTP_HOST', '%%' );
define( 'FTP_SSL',  false );
// Url
define( 'WP_HOME', 'http://example.com' ); // no trailing slash

$table_prefix = 'wp_'; // please change with 2-3 random letters

// https://api.wordpress.org/secret-key/1.1/salt
define( 'AUTH_KEY', '%%' );
define( 'SECURE_AUTH_KEY', '%%' );
define( 'LOGGED_IN_KEY', '%%' );
define( 'NONCE_KEY', '%%' );
define( 'AUTH_SALT', '%%' );
define( 'SECURE_AUTH_SALT', '%%' );
define( 'LOGGED_IN_SALT', '%%' );
define( 'NONCE_SALT', '%%' );

// Multisite
define( 'WP_ALLOW_MULTISITE', false );
/* // Unquote for multisites
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'example.com'); // no `http://` Also set it in the `local-config.php`
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
/**/

//====================================================================
// That's all, stop editing! Happy blogging.
//====================================================================
// Minor tweaks
define( 'AUTOSAVE_INTERVAL', 300 ); // autosave every 300 seconds
define( 'WP_POST_REVISIONS', 10 ); // 10 post revisions
define( 'DISALLOW_FILE_EDIT', true ); // don't allow to edit files in the wp-admin

// URL and dirs
define( 'WP_SITEURL', WP_HOME . '/wp' );
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', WP_HOME . '/content' );
define( 'PLUGINDIR', 'content/plugins' ); // Relative to ABSPATH. For back compat.
define( 'MUPLUGINDIR', 'content/mu-plugins' ); // Relative to ABSPATH. For back compat.

// Debug
define( 'WP_DEBUG', true );

// log errors when it's not a development server
if ( !defined('WP_DEVELOPMENT') || WP_DEVELOPMENT !== true || WP_DEBUG_DISPLAY === false ) {
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );
    @ini_set( 'display_errors', 0 );
    @ini_set('log_errors', 1);
    @ini_set('error_log', WP_CONTENT_DIR . '/debug.log');
}

// DB
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );


/** Absolute path to the WordPress directory. */
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

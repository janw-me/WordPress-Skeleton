<?php
// Check if a local development file is defined and include it.
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	include( dirname( __FILE__ ) . '/local-config.php' );
}

//====================================================================
// Fill in all the needed constants below
//====================================================================

// Database
defined( 'DB_NAME' )     or define( 'DB_NAME', '%%' );
defined( 'DB_USER' )     or define( 'DB_USER', '%%' );
defined( 'DB_PASSWORD' ) or define( 'DB_PASSWORD', '%%' );
defined( 'DB_HOST' )     or define( 'DB_HOST', 'localhost' );
// ftp
defined( 'FTP_USER' ) or define( 'FTP_USER', '%%' );
defined( 'FTP_PASS' ) or define( 'FTP_PASS', '%%' );
defined( 'FTP_HOST' ) or define( 'FTP_HOST', '%%' );
defined( 'FTP_SSL' )  or define( 'FTP_SSL', false );
// Url
defined( 'WP_HOME' )  or define( 'WP_HOME', 'http://example.com' ); // no trailing slash

$table_prefix = 'rndm_'; // please change with 2-5 random letters/digits

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
defined( 'WP_ALLOW_MULTISITE' )   or define( 'WP_ALLOW_MULTISITE', false );
/* // Unquote for multisites
defined( 'MULTISITE' )            or define( 'MULTISITE', true );
defined( 'SUBDOMAIN_INSTALL' )    or define( 'SUBDOMAIN_INSTALL', false );
defined( 'DOMAIN_CURRENT_SITE' )  or define( 'DOMAIN_CURRENT_SITE', 'example.com' ); // no `http://` see local-config.php
defined( 'PATH_CURRENT_SITE' )    or define( 'PATH_CURRENT_SITE', '/' );
defined( 'SITE_ID_CURRENT_SITE' ) or define( 'SITE_ID_CURRENT_SITE', 1 );
defined( 'BLOG_ID_CURRENT_SITE' ) or define( 'BLOG_ID_CURRENT_SITE', 1 );
/**/

//====================================================================
// That's all, stop editing! Happy blogging.
//====================================================================
// Minor tweaks
defined( 'AUTOSAVE_INTERVAL' )  or define( 'AUTOSAVE_INTERVAL', 300 ); // autosave every 300 seconds
defined( 'WP_POST_REVISIONS' )  or define( 'WP_POST_REVISIONS', 10 ); // 10 post revisions
defined( 'DISALLOW_FILE_EDIT' ) or define( 'DISALLOW_FILE_EDIT', true ); // don't allow to edit files in the wp-admin

// URL and dirs
defined( 'WP_SITEURL' )     or define( 'WP_SITEURL', WP_HOME . '/wp' );
defined( 'WP_CONTENT_DIR' ) or define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
defined( 'WP_CONTENT_URL' ) or define( 'WP_CONTENT_URL', WP_HOME . '/content' );
defined( 'PLUGINDIR' )      or define( 'PLUGINDIR', 'content/plugins' ); // Relative to ABSPATH. For back compat.
defined( 'MUPLUGINDIR' )    or define( 'MUPLUGINDIR', 'content/mu-plugins' ); // Relative to ABSPATH. For back compat.

// Debug turned off on production
defined( 'WP_DEBUG' ) or define( 'WP_DEBUG', false );

// log errors when it's not a development server
if ( ! defined( 'WP_DEVELOPMENT' ) || WP_DEVELOPMENT !== true || ! defined( 'WP_DEVELOPMENT' ) || WP_DEBUG_DISPLAY === false ) {
	defined( 'WP_DEBUG_LOG' )     or define( 'WP_DEBUG_LOG', true );
	defined( 'WP_DEBUG_DISPLAY' ) or define( 'WP_DEBUG_DISPLAY', false );
	@ini_set( 'display_errors', 0 );
	@ini_set( 'log_errors', 1 );
	@ini_set( 'error_log', WP_CONTENT_DIR . '/debug.log' );
}

// DB
defined( 'DB_CHARSET' ) or define( 'DB_CHARSET', 'utf8' );
defined( 'DB_COLLATE' ) or define( 'DB_COLLATE', '' );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	defined( 'ABSPATH' ) or define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

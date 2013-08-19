<?php
$enviroment = getenv( 'APP_ENV' ); // set in the Vhost with: SetEnv APP_ENV development

if ( $enviroment == 'development' ) {
	// Database
	define( 'DB_NAME', 'kijken_codeles' );
	define( 'DB_USER', 'kijken_codeless' );
	define( 'DB_PASSWORD', 'sa5Voo6Rox!ooD@u' );
	define( 'DB_HOST', 'localhost' );
	// ftp
	//define( 'FTP_USER', '%%' );
	//define( 'FTP_PASS', '%%' );
	//define( 'FTP_HOST', '%%' );
	//define( 'FTP_SSL', false );
	// Url
	define( 'WP_HOME', 'http://codeless.meekijken.net' ); // example http://example.com  (no trailing slash)
	// Debug
	define( 'WP_DEBUG', false );
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
$table_prefix = 'wp_'; // please change
// URL and dirs
define( 'WP_SITEURL', WP_HOME . '/wp' );
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', WP_HOME . '/content' );

// https://api.wordpress.org/secret-key/1.1/salt
define('AUTH_KEY',         'L_Z3Fd$Y+s#:Yc+F7$l@ 8-@?PbgOSgM.#/:;J^o/B@(;$kAGqF5+{b~x:.az!<0');
define('SECURE_AUTH_KEY',  '4hebAiCXvW;xmS?v+n|z>-6g~IY=X(6>TtymeoMb(Xux0Iyv30V|u:?QPI?So?wH');
define('LOGGED_IN_KEY',    'IGws4M+#N%Itqd5ks}x.{zSC=}8K)^9i@CMT^|Z1)]riE3DR1M%F*nnrXW6wjwt>');
define('NONCE_KEY',        'e&lLMa-~|x(%-<[O<xRk1}:c-I1<AS3qSZqRvKWY.Q-ai*ZyT+Zkq.ei-D/w5+y+');
define('AUTH_SALT',        'w`1C6sf+Rn5/=in2n_-TKnEVVjJw_)v(`bpw4CL=^=4[WY.}|;E-|S*}VDb/9&xU');
define('SECURE_AUTH_SALT', '|s`XJ+UX:Y)u@WMCki+{@!6i+@>uT&fu]vM&uq|I:9kWVg.1HnABV3th`Ygw<_;+');
define('LOGGED_IN_SALT',   'f}^|ph-Kxs3AkGw|J(0aj2K+BCoxI2,5Zp 9hNcG0*FXFL9h-%Rwbr3R,)|xXc3c');
define('NONCE_SALT',       'aC-<0LK)-{)sxH4M}l|/dwqK7-i7(;1-460ZAj,bx-.7#F-qE5QbS!<+q^YR2)N$');

define( 'WPLANG', 'nl_NL' ); // default EN for Dutch: nl_NL
// Auto save and Revisions
define( 'AUTOSAVE_INTERVAL', 300 ); // seconds
define( 'WP_POST_REVISIONS', 10 );
define( 'DISALLOW_FILE_EDIT', true );

/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'codeless.meekijken.net');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

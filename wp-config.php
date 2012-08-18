<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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

// https://api.wordpress.org/secret-key/1.1/salt
define('AUTH_KEY',         '_?1b3/u[k/XV$7=eD+a Km?hxksKhj0R=A8=^FjmIS=M[^c#=ILv{QEjw|hPX!zw');
define('SECURE_AUTH_KEY',  ';Y3/Ga9cAARa)f*90_x>F3d^8M7td@HIMkO(klZ:e]].bKV_LjdWfCx.ruLiQ/Y?');
define('LOGGED_IN_KEY',    'YCnPrP()uk5wFG/-Gwy&Fe+[vBwAp&_riCY!Ffg~|Y(x(&Xba2{U/JNX5C#V}*Ur');
define('NONCE_KEY',        'g[yqv~@`[=3,8C1I<eR4dQh2vi0RhFs){XVDqN(&OAqqe}w3)TQnC!Tj7PY)y2{1');
define('AUTH_SALT',        'BdIVp+28F{@RP{>`)nf` (FW9[#MepsJgD9!.tiGu}LVcO=A#|ljufdz89+o2h|<');
define('SECURE_AUTH_SALT', '/;a-+h@[TJT7:5f@WB(AnqA`E,mdys}-?1hX(c*I6N[^F<{mZ8XXE|AXy$JU]Itd');
define('LOGGED_IN_SALT',   'gLjD.f2PxC[Yhue<;QnueD*9a^jxB@({V*<N~H(F7T!u|hAz`dvZ M&aFI8~!C16');
define('NONCE_SALT',       'e;LSW4I!OD_*-~2[ytI) H}48o7]@3yrOW8N!m7mPO+#HmwT%E/N/Tpr-EYboJ9J');

//define('WPLANG', 'nl_NL'); // NL
define('WPLANG', ''); // English

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
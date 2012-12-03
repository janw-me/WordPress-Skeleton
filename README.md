# WordPress Skeleton

This is simply a skeleton repo for a WordPress site. Use it to jump-start your WordPress site repos, or fork it and customize it to your own liking!

## Assumptions

* WordPress as a Git submodule in `/wp/`
* Custom content directory in `/content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)

## Steps to get this working

in the wp-config.php

* add a `development` enviroment to your vhost with the folloing line:  
  `SetEnv APP_ENV development`
* For development you can set the following:
  * database: user, pass, DB name and (local)host
  * FTP: user, pass, host/IP
  * The url of the home page.
* change the `$table_prefix` vairable to something else.
* Define the security keys :https://api.wordpress.org/secret-key/1.1/salt
* You might want to change the `WPLANG` constat for [translations][1]

[1]: http://codex.wordpress.org/WordPress_in_Your_Language
# WordPress Skeleton #

## Downloading This repository ##
You can get this to work in two ways, via `.git` or download it manually

### Donwloading via Git ###
In the webroot run:

````git clone https://github.com/janw-oostendorp/WordPress-Skeleton.git .````

This will download the base, next we download the WordPress submodule.

````git submodule update --init````

If needed add your own remote repository

````git remote rm origin````
````git remote add origin YOUR_REPOSITORY.URL/````

### Manual download ###
Download the [zip](https://github.com/janw-oostendorp/WordPress-Skeleton/archive/master.zip) and unzip it in the webroot. Download [Wordpress](http://wordpress.org/latest.zip) unzip it in the `/wp` folder.

## How to install ##
After downloading you can continue to install WordPress
1) Copy `local-config.sample.php` and rename it to `local-config.php`
2) Add the database constants and the domain
3) In `wp-config.php` Edit the `$table_prefix`
4) add the `*_KEY` constants which can be generated [here](https://api.wordpress.org/secret-key/1.1/salt)
5) open your website and continue with the famous 5 minute install.

## Benefits ##

- WordPress is in it's own folder `/wp`.
- Webroot only has two folders `/wp` and `/content`
- Automatic updates are enabled for production, adding more security.
- Error display and logging are setup. On production errors will be logged, on test the will be shown.


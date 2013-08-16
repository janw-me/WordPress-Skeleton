=== Lightview Plus ===
Contributors: puzich
Website link: http://www.puzich.com/
Author URI: http://www.puzich.com/
Plugin URI: http://www.puzich.com/wordpress-plugins/lightview
Donate link: http://www.puzich.com/go/donate
Tags: lightview, images, lightbox, photo, image, ajax, picture, floatbox, overlay, fancybox, thickbox, video, youtube, vimeo, blip.tv
Requires at least: 3.0
Tested up to: 3.4
Stable tag: 3.1.3

Seamless integration of Lightview (similar to Lightbox, Thickbox, Floatbox, Thickbox, Fancybox) to create a nice overlay to display images and videos without the need to change html.

== Description ==

A wordpress plugin which implements [lightview 3.0](http://projects.nickstakenburg.com/lightview) of Nick Stakenburg.

Lightview does the same as lightbox, but in a much nicer way. lightview-plus plays videos from YouTube, blip.tv and Vimeo.

This plugin automatically enhance image links to use lightview. It has the same functionality as the wordpress plugin [fancybox plus](http://wordpress.org/extend/plugins/fancybox-plus/)

This plugin needs jQuery now!

ATTENTION TO ALL USERS, THAT USES LIGHTVIEW PLUS PRIOR 3.0! If you upgrade to lightview plus 3.0, you have to install the [new lightview 3.0](http://projects.nickstakenburg.com/lightview) which uses jQuery now.

== Installation ==

Read installation instructions on [my website](http://www.puzich.com/wordpress-plugins/lightview-en)

Lies die Installationsanweisungen auf [meiner Webseite](http://www.puzich.com/wordpress-plugins/lightview)

== Frequently Asked Questions ==

Read the FAQs on [my website](http://www.puzich.com/wordpress-plugins/lightview-en)

Lies die FAQs auf [meiner Webseite](http://www.puzich.com/wordpress-plugins/lightview)

== Changelog ==

= 3.1.3 =
* [NEW] added language hindi. Welcome India!
* [FIX] spinner.js was minified in lightview. changed code to fit

= 3.1.2 =
* [FIX] disabling of default enabled options is possible again now. Thanks Martin!

= 3.1.1 =
* [FIX] videos in feeds and mobile will not play automatically again
* [NEW] plays youtube-nocookie videos

= 3.1.0 = 
* [FIX] backup option for backup fixed. Will never use the register_(de)activate-hook again for that
* [FIX] User is able now, to choose, if he want to customize lightview
* [FIX] fixed small bugs
* [NEW] more options.
* [NEW] all customizations are disabled by default. Customizations for the skin can be switched on and off
* [NEW] added german translation

= 3.0.2 = 
* [FIX] Admin Menu: Javascripts and CSS files are only loaded in the lightview plus menu now
* [FIX] Colorpicker fixed
* [FIX] added excanvas.js for IE

= 3.0.1 =
* [FIX] small and fast fix to show floats in the right way.

= 3.0 =
* [NEW] ATTENTION: Support only the new lightview 3.0 or higher, which has to be downloaded [here](http://projects.nickstakenburg.com/lightview) 
* [NEW] now, with lightview plus it is possible, to show your old embedded videos with lightview
* [FIX] Preview pictures of YouTube in hi res again

= 2.6.1.1 =
* [FIX] fixed wrong options menu

= 2.6.1 =
* [NEW] Vimeo videos are shown on mobile devices, like iPhone and iPad
* [FIX] Options Menu: option to show or not to show the video in the feed
* [FIX] Small bugfix video implementation if the feed is displayed
* [FIX] Options Menu: open of the options
* [FIX] Feed appereance

= 2.6 =
* [NEW] splitted plugin into two files, for simple future updates
* [NEW] YouTube uses iframes now
* [NEW] admin menu in new design
* [NEW] user can choose, if the videos will be shown in the feed or if there will be the video preview image
* [NEW] video preview cache will be emptied after plugin upgrade
* [NEW] some improvements under the hood
* [NEW] YouTube videos will be shown in HD every time
* [FIX] TinyMCE insert failure with videos

= 2.5.3.6 =
* [FIX] blip.tv autoplay
* [FIX] wordpress.org repository

= 2.5.3.5 =
* [NOTHING] nothing changed to 2.5.3.4, but wordpress.org doesn't got it, as actual version. Sorry for that!

= 2.5.3.4 =
* [FIX] fixed vimeo autoplay option

= 2.5.3.3 =
* [FIX] updated prototype javascript framework to v1.7

= 2.5.3.2 =
* [FIX] small YouTubeHQ bug fix

= 2.5.3.1 =
* [FIX] small fix

= 2.5.3 =
* [FIX] small YouTube Feed fix
* [NEW] new vimeo embed code to work with iphone, ipad... (haven't tested it, because I don't own an iPad)
* [NEW] use of wp_remote_fopen to use curl or fopen

= 2.5.2 = 
* [FIX] added again to wordpress repository. nothing changed to 2.5.1

= 2.5.1 = 
* [FIX] "node no longer exists" error. Websites with this error have to wait 24 hours, until the error disapiers. Sorry for this!
* [UPDATE] Danish language!
* [ATTENTION] Default values are not written. Will be fixed in next version. This release is for WP3.0 to get it work!

= 2.5 =
* [NEW] added blip.tv
* [FIX] small change loading scriptaculous effects javascript
* [FIX] CSS fix for opacity in IE
* [FIX] removed deprecated function
* [NEW] preview picture and a text of video is shown in feeds, instead of the simple text
* [NEW] Autoplay for all videos
* [FIX] some small core changes
* [NEW] added some lines for more security
* [NEW] Cache for video data
* [NEW] Debug Option for videos
* [NEW] Nice placeholder for videos which aren't available. Thanks to Zaur!

= 2.4.3 =
* [FIX] scriptaculous wasn't loading in IE
* [FIX] play button centred now (thanx to Olli)
* [UPDATE] italian language file

= 2.4.2 =
* [FIX] fixed some small html errors in the play button overlay
* [NEW] security enhancement
* [NEW] enhancement of regex due to a user's wish

= 2.4.1 =
* [FIX] small decoration fix. ###TITLE### doesn't show under videos
* [FIX] small fixes in german translation

= 2.4 =
* [FIX] vimeo videos and preview images are shown in the correct dimension, now
* [FIX] if video option "notext" is selected, no text will displayed under the lightview video window
* [UPDATE] Uses V2 of vimeos simple api
* [UPDATE] to new version of prototype and scriptaculous
* [NEW] make use of wp_enqueue function of wordpress to load javascripts
* [NEW] Added play button to video preview images
* [NEW] Play button overlay over videos

= 2.3.5 =
* [FIX] fixed language tags in lightview-popup.php
* [UPDATE] french language
* [UPDATE] german language

= 2.3.4 =
* [FIX] added prototype 1.6.1-rc3 for fixing IE8 issues. Please use under lightview-plus option the local version of prototype, instead of googles version.
* [NEW] added dansk language

= 2.3.3 =
* [FIX] fixed repository

= 2.3.2 = 
* [NEW] Language Russian

= 2.3 =
* [NEW] Language Portuguese/Brasil
* [NEW] automaitcally adds the title attribute to 
* [FIX] YouTube HQ

= 2.2.1 =
* [FIX] showing YouTube HQ videos direct in HQ mode

= 2.2 =
* [NEW] simplexml_load_file support for PHP4 and PHP5, where it is not compiled with
* [NEW] nag screen to send informations to the user
* [FIX] YouTube HQ works, now 
* [FIX] workaround for backup process, during automatic update
* [FIX] adding default values

= 2.1 =
* [NEW] Turkish language pack
* [NEW] now, the video preview images width can set seperatly
* [FIX] fixed an issue if function simplexml_load_file does not exist
* [FIX] added YouTube HQ support
* [FIX] html valid, now

= 2.0.3 =
* [NEW] French language pack
* [NEW] automatically backup and restore of the lightview javascript during automatic update
* [FIX] new scriptaculous and prototype for compatibility with new lightview version

= 2.0.1 / 2.0.2 =
* [NEW] Italian Language Pack. Many thanks to Gianni Diurno from gidibao.net
* [NOTICE] Version = 2.0.1 and = 2.0.2 are the same. The wp repository did not took = 2.0.1 :-(

= 2.0 = 
* [NEW] Support of YouTube and Vimeo (more to come). 
* [NEW] Admin Page

= 1.1.10 =
* [NOTICE] removed lightview-javascript due to gpl license

= 1.1.9 =
* [FIX] fixed a bug in the regex.

= 1.1.8 =
* [FIX] a little bug in the regex. sorry, for that!

= 1.1.7 =
* [FIX] Some enhancement at the regex. Now, no <img>-tags are replaced with lightview-tags

= 1.1.6 =
* [NEW] Lighview = 2.= 1.1 integrated

= 1.1.5 =
* [NOTICE] Developement release only

= 1.1.4 =
* [FIX] Wrong pathname in script!`

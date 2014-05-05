<?php
/**
 * Plugin Name: Enable autoupdates on production, security updates only
 * Description: Needed because we use `.git`
 * Version: 1.0
 * Author: Jan Willem Oostendorp
 * License: GPL2
 */

if (!defined('WP_DEVELOPMENT') || WP_DEVELOPMENT !== true) {
  add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );
}

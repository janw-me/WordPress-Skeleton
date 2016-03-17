<?php
/**
 * Plugin Name: Adminbar test enviroment notice
 * Description: Add a notice item to the admin bar to show it is a test envirioment
 * Version: 1.0
 * Author: Jan Willem Oostendorp
 * License: GPL2
 */

if (defined('WP_DEVELOPMENT') && WP_DEVELOPMENT === true){
  add_action( 'init', 'test_enviroment_adminbar_notice_init' );
}

function test_enviroment_adminbar_notice_init () {
  if (is_admin_bar_showing() ) {
    add_action( 'admin_bar_menu', 'test_enviroment_adminbar_notice_item', 100 );
  
    add_action( 'wp_head', 'test_enviroment_adminbar_notice_style' );
    add_action( 'admin_head', 'test_enviroment_adminbar_notice_style' );
  }
}

function test_enviroment_adminbar_notice_item( $admin_bar ) {
  $admin_bar->add_menu( array(
    'id' => 'admin-test-envirioment',
    'title' => '<span class="ab-icon"></span>Test',
    'meta' => array('title' => __('This is a test envirioment.')),
  ) );
}

function test_enviroment_adminbar_notice_style() {
  echo '<style>
  #wp-admin-bar-admin-test-envirioment .ab-icon:hover:before, #wp-admin-bar-admin-test-envirioment .ab-icon:before {
    content: "\f348"; color: #D54E21 !important; top: 2px;
  }
  #wp-admin-bar-admin-test-envirioment .ab-item:hover, #wp-admin-bar-admin-test-envirioment .ab-item {
    color: #D54E21 !important; cursor: help;
  }    
  </style>';
}

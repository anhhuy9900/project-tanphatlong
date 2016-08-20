<?php

/*
Plugin Name: Manage Admin Contact
Description: Manage Admin Contact
Author: Nguyen Hoang Anh Huy
License: Public Domain
Version: 1.1
*/

if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


require_once( ABSPATH . '/wp-content/plugins/tpl_contact/page_list.php' );
require_once( ABSPATH . '/wp-content/plugins/tpl_contact/page_handle.php' );

global $tpl_contact_db_version;
$tpl_contact_db_version = '1.1'; // version changed from 1.0 to 1.1

/**
 * register_activation_hook implementation
 *
 * will be called when user activates plugin first time
 * must create needed database tables
 */
function page_init_install()
{
    global $wpdb;
    global $tpl_contact_db_version;

    $table_name = 'tpl_contact'; // do not forget about tables prefix

    // sql to create your table
    // NOTICE that:
    // 1. each field MUST be in separate line
    // 2. There must be two spaces between PRIMARY KEY and its name
    //    Like this: PRIMARY KEY[space][space](id)
    // otherwise dbDelta will not work
    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
		  `id` int(11) NOT NULL,
		  `name` varchar(200) DEFAULT NULL,
		  `message` text,
		  `email` varchar(200) DEFAULT NULL,
		  `phone` varchar(200) DEFAULT NULL,
		  `status` smallint(1) NOT NULL DEFAULT '1',
		  `updated_date` int(10) DEFAULT NULL,
		  `created_date` int(10) DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    // we do not execute sql directly
    // we are calling dbDelta which cant migrate database
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // save current database version for later use (on upgrade)
    add_option('tpl_contact_db_version', $tpl_contact_db_version);

    /**
     * [OPTIONAL] Example of updating to 1.1 version
     *
     * If you develop new version of plugin
     * just increment $tpl_contact_db_version variable
     * and add following block of code
     *
     * must be repeated for each new version
     * in version 1.1 we change email field
     * to contain 200 chars rather 100 in version 1.0
     * and again we are not executing sql
     * we are using dbDelta to migrate table changes
     */
    $installed_ver = get_option('tpl_contact_db_version');
    if ($installed_ver != $tpl_contact_db_version) {
       $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
		  `id` int(11) NOT NULL,
		  `name` varchar(255) DEFAULT NULL,
		  `message` text,
		  `email` varchar(255) DEFAULT NULL,
		  `phone` varchar(200) DEFAULT NULL,
		  `status` smallint(1) NOT NULL DEFAULT '1',
		  `updated_date` int(10) DEFAULT NULL,
		  `created_date` int(10) DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // notice that we are updating option, rather than adding it
        update_option('tpl_contact_db_version', $tpl_contact_db_version);
    }
}

register_activation_hook(__FILE__, 'tpl_contact_install');

/**
 * Trick to update plugin database, see docs
 */
function page_init_update_db_check()
{
    global $tpl_contact_db_version;
    if (get_site_option('tpl_contact_db_version') != $tpl_contact_db_version) {
        //custom_table_example_install();
    }
}

add_action('plugins_loaded', 'page_init_update_db_check');

/**
 * admin_menu hook implementation, will add pages to list tpl_contact and to add new one
 */
function page_init_admin_menu()
{
    add_menu_page(__('Manage Contact', 'tpl_contact'), __('Manage Contact', 'tpl_contact'), 'activate_plugins', 'tpl_contact', 'page_handler');
    add_submenu_page('tpl_contact', __('Manage Contact', 'tpl_contact'), __('Manage Contact', 'tpl_contact'), 'activate_plugins', 'tpl_contact', 'page_handler');
    // add new will be described in next part
    add_submenu_page('tpl_contact', '', '', 'activate_plugins', 'tpl_contact_form', 'form_page_handler');
}

add_action('admin_menu', 'page_init_admin_menu');

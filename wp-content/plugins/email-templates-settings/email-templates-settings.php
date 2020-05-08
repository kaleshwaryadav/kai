<?php
/**
* Plugin Name: Email Templates
* Plugin URI: #
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Kushal
* Author URI: #
**/

/**
* Functions
*/
$prefix = 'WEVO';
define('WEVOPLUGINPATH', plugin_dir_path( __FILE__ ) );
if ( is_admin() ) require_once( WEVOPLUGINPATH . '/tabbed/settings.php' );

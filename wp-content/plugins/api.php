<?php
/*
 * Plugin Name: WooCommerce api
 * Plugin URI: test.com
 * Description: Handsome product gallery with asynchronous zoom for desktop and mobiles and with a good slider.
 * Author: kaleshwar
 * Developer: Ildar Akhmetov & Ruslan Askarov
 * Developer URI: https://festagency.com/
 * Text Domain:test
 * 
 */
/**
* The main plugin file 
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * WC Detection
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
    function is_woocommerce_active() {
        $active_plugins = (array) get_option( 'active_plugins', array() );

        return in_array( 'woocommerce/woocommerce.php', $active_plugins ) || array_key_exists( 'woocommerce/woocommerce.php', $active_plugins ) ;
    }
}


/**
 * WooCommerce inactive notice. 
 *
 * @return string
 */
function woocommerce_inactive_notice() {
    if ( current_user_can( 'activate_plugins' && is_admin() ) ) {
        echo '<div id="message" class="error"><p>';
        printf( __( '%1$sWooCommerce plugin is inactive%2$s. %3$sWooCommerce plugin %4$s must be active for this plugin. Please %5$sinstall and activate WooCommerce &raquo;%6$s', 'plugin'), '<strong>', '</strong>', '<a href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>', '<a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">', '</a>' );
        echo '</p></div>';
    }
    deactivate_plugins(plugin_basename(__FILE__));
}


add_action( "plugins_loaded", function() {
    if( is_woocommerce_active() )
        $do_task = "testing";
    else
        add_action( "admin_notices", 'woocommerce_inactive_notice' );
    
});


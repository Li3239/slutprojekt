<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once(get_template_directory() . "/init.php");
//test
/**
 * support Woocommerce function
 */
function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

//this function will create a location in the wordpress dashbord
function theme_register_menus() {
    register_nav_menus( array(
        'header-menu' => __( 'Header Menu', 'theme-text-domain' ),
        'home-menu' => __( 'Home Menu', 'theme-text-domain' ),
        'store-menu' => __( 'Store Menu', 'theme-text-domain' ),
        'accessories-menu' => __( 'Accessories Menu', 'theme-text-domain' ),
        'aboutUs-menu' => __( 'AboutUs Menu', 'theme-text-domain' ),
        'news-menu' => __( 'News Menu', 'theme-text-domain' ),
        'contactUs-menu' => __( 'ContactUs Menu', 'theme-text-domain' )


    ) );
}
add_action( 'after_setup_theme', 'theme_register_menus' );

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

/**
 * change checkout button text
 */
add_filter('woocommerce_proceed_to_checkout', 'customize_checkout_button_text');
function customize_checkout_button_text()
{
    return 'Check Out';
}



//this function will create a location in the wordpress dashbord
function theme_register_menus() {
    register_nav_menus( array(
        'header-menu' => __( 'Header Menu', 'theme-text-domain' ),
        'home-menu' => __( 'Home Menu', 'theme-text-domain' ),
        'store-menu' => __( 'Store Menu', 'theme-text-domain' ),
        'accessories-menu' => __( 'Accessories Menu', 'theme-text-domain' ),
        'brand-menu' => __( 'Brand Menu', 'theme-text-domain' ),
        'pages-menu' => __( 'Pages Menu', 'theme-text-domain' ),
        'aboutUs-menu' => __( 'AboutUs Menu', 'theme-text-domain' ),
        'news-menu' => __( 'News Menu', 'theme-text-domain' ),
        'ContactUs-menu' => __( 'ContactUs Menu', 'theme-text-domain' ),

    ) );
}
add_action( 'after_setup_theme', 'theme_register_menus' );
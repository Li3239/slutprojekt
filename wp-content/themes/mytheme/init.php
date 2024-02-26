<?php

require_once('vite.php');
require_once('ajax.php');

function mytheme_enqueue()
{
    $theme_directory = get_template_directory_uri();
    wp_enqueue_style("mystyle", $theme_directory . "/style.css");
}
add_action("wp_enqueue_scripts", "mytheme_enqueue");

function mytheme_init()
{
    // add theme support
    add_theme_support('post-thumbnails');

    // register MENU
    $menu = array(
        'main_menu' => 'main_menu',
        'main_menu_icons' => 'main_menu_icons',
        'footer_address' => 'footer_address',
        'footer_links' => 'footer_links',
        'footer_help' => 'footer_help',
        'footer_newsletter' => 'footer_newsletter'
    );
    register_nav_menus($menu);
}
add_action("after_setup_theme", "mytheme_init");

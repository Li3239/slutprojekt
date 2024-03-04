<?php


require_once('vite.php');
require_once('ajax.php');
require_once('settings.php');
require_once('shortcodes.php');
require_once('custom-widgets.php');
require_once('single-page-hook.php');

//__DIR__: mytheme
// require_once(__DIR__ . "/hooks/shop-product-hooks.php");
require_once('customemail.php');
require_once('shop-page-hooks.php');
require_once('checkout-page-hooks.php');

function mytheme_enqueue()
{
    $theme_directory = get_template_directory_uri();
    wp_enqueue_style("mystyle", $theme_directory . "/style.css");
    // array('jquery')确保在脚本之前加载jQuery
    // 最后的true参数表示脚本将在文档<body>的闭合标签之前加载，这通常是为了确保所有的HTML元素都已经加载，从而可以安全地绑定事件监听器等。
    wp_enqueue_script("shop_page_custom_js", $theme_directory . "/resources/js/shop-page-custom.js", array('jquery'), null, true);

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
        'footer_social_media' => 'footer_social_media',
        'footer_shopping' => 'footer_shopping',
        'footer_links' => 'footer_links',
        'footer_blog' => 'footer_blog'
    );
    register_nav_menus($menu);
}
add_action("after_setup_theme", "mytheme_init");

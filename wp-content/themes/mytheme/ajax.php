<?php

define("PRODUCT_QUANTITY_PER_PAGE", 6); 

/*
 * add js setting 
 */
function my_theme_enqueue_scripts()
{
    // wp_enqueue_script('my-custom-load-more', get_stylesheet_directory_uri() . '/resources/js/lazyload.js', array('jquery'), '1.0', true);
    // wp_enqueue_script("mytheme_jquery", get_template_directory_uri() . "/resources/js/jquery.js", array(), false, array());
    wp_enqueue_script("mytheme_lazy_load", get_template_directory_uri() . "/resources/js/lazyload.js", array("mytheme_jquery"), false, array());

    // 本地化脚本以包含 AJAX URL 和 nonce
    //wp_localize_script 函数允许将服务器端的 PHP 数据安全地传递到前端的 JavaScript 文件中
    wp_localize_script('mytheme_lazy_load', 'ajax_params', array(
        //将 WordPress 后端处理 AJAX 请求的 URL (admin-ajax.php) 传递给前端 JavaScript
        'ajax_url' => admin_url('admin-ajax.php'),
        //创建了一个称为 nonce（数字签名）的安全令牌，并将其传递给前端，Nonce 用于验证请求的合法性，确保请求是从你的网站发起的，防止 CSRF 攻击。
        'nonce' => wp_create_nonce('mytheme_lazy_load_nonce') // create nonce
    ));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');


/*
 * Lazy load 
 */
function my_load_more_products()
{
    // verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'mytheme_lazy_load_nonce')) {
        die('Nonce verification failed.');
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => PRODUCT_QUANTITY_PER_PAGE, // load product quantity for each time
        'paged' => $_POST['page'],
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    else :
        echo 'No more products to load.';
    endif;

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_nopriv_my_load_more_products', 'my_load_more_products');
add_action('wp_ajax_my_load_more_products', 'my_load_more_products');





// /*
// **
// */
// add_action("init", "init_ajax_lazy_load");
// function init_ajax_lazy_load() {
//     add_action('wp_ajax_load_more_products', 'custom_load_more_products_ajax_handler');
//     add_action('wp_ajax_nopriv_load_more_products', 'custom_load_more_products_ajax_handler');
    
//     add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
// }

// function custom_load_more_products_ajax_handler()
// {
//     $args = array(
//         'post_type' => 'product',
//         'posts_per_page' => 4, // 每次加载更多时显示的产品数量
//         'paged' => $_POST['page'],
//     );

//     $loop = new WP_Query($args);

//     if ($loop->have_posts()) :
//         while ($loop->have_posts()) : $loop->the_post();
//             wc_get_template_part('content', 'product');
//         endwhile;
//     endif;
//     wp_reset_postdata();
//     // end request
//     die();
// }

// function my_theme_enqueue_scripts()
// {
//     wp_enqueue_script("mytheme_jquery", get_template_directory_uri() . "/resources/js/jquery.js", array(), false, array());
//     wp_enqueue_script("my_custom_lazy_load", get_template_directory_uri() . "/resources/js/lazyload.js", array("mytheme_jquery"), false, array());

//     // 本地化脚本以包含 AJAX URL
//     // wp_localize_script('my-custom-load-more', 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php')));
    
//     $minarray = array();
//     // 本地化脚本以包含 AJAX URL
//     wp_localize_script("my_custom_lazy_load", "ajax_params", array(
//         "ajax_url" => admin_url("admin-ajax.php"),
//         "nonce" => wp_create_nonce("my_load_more_nonce")
//     ));

// }


//////////////////////////////////////////////////////////////////////////////

// function init_ajax()
// {
//     add_action("wp_ajax_mytheme_getbyajax", "mytheme_getbyajax");
//     add_action("wp_ajax_nopriv_mytheme_getbyajax", "mytheme_getbyajax");

//     add_action("wp_enqueue_scripts", "mytheme_enqueue_scripts");
// }
//add_action("init", "init_ajax");


// function mytheme_enqueue_scripts()
// {
//     wp_enqueue_script("mytheme_jquery", get_template_directory_uri() . "/resources/js/jquery.js", array(), false, array());
//     wp_enqueue_script("mytheme_ajax", get_template_directory_uri() . "/resources/js/ajax.js", array("mytheme_jquery"), false, array());

//     $minarray = array();
//     wp_localize_script("mytheme_ajax", "ajax_variables", array(
//         "ajaxUrl" => admin_url("admin-ajax.php"),
//         "nonce" => wp_create_nonce("mytheme_ajax_nonce"),
//         "kalleanka" => 123
//     ));
// }

// function mytheme_getbyajax()
// {
//     //get value from js : searchwords in ajax.php
//     if(isset($_POST["search"]) == false) {
//         wp_send_json_error();
//         return;
//     }
    
//     $searchwords = $_POST["search"];
//     $result = array();

//     if($searchwords == "kalle anka") {
//         // ajax.php -> success -> result
//         $result["stad"] = "Ankeborg";
//         $result["product"] = "<div></div>";
//     }

//     // $result = array();
//     // $result["minvariable"] = 99;
//     $json = json_encode($result);
//     wp_send_json($json);
// }

<?php

define("PRODUCT_QUANTITY_PER_PAGE", 6); 

//-----------------------------
// add script dependency
//-----------------------------
function my_theme_enqueue_scripts()
{
    // wp_enqueue_script("mytheme_jquery", get_template_directory_uri() . "/resources/js/jquery.js", array(), false, array());
    // 使用wordpress自带的jQuery库
    wp_enqueue_script("mytheme_lazy_load", get_template_directory_uri() . "/resources/js/lazyload.js", array("jquery"), '1.0', true);

    // 本地化脚本以包含 AJAX URL 和 nonce
    // wp_localize_script 函数允许将服务器端的 PHP 数据安全地传递到前端的 JavaScript 文件中
    wp_localize_script('mytheme_lazy_load', 'ajax_params', array(
        //将 WordPress 后端处理 AJAX 请求的 URL (admin-ajax.php) 传递给前端 JavaScript
        'ajax_url' => admin_url('admin-ajax.php'),
        //创建了一个称为 nonce（数字签名）的安全令牌，并将其传递给前端，Nonce 用于验证请求的合法性，确保请求是从你的网站发起的，防止 CSRF 攻击。
        'nonce' => wp_create_nonce('mytheme_lazy_load_nonce') // create nonce
    ));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');


//-------------------------------
// Lazy load 
// 用于实现一个“加载更多产品”的功能
// 通常与Ajax技术一起使用以提升用户体验
//-------------------------------
function my_load_more_products()
{
    // verify nonce， 检查是否传递了一个名为nonce的POST参数，并且验证这个nonce是否有效
    if (
        !isset($_POST['nonce']) ||
        !wp_verify_nonce($_POST['nonce'], 'mytheme_lazy_load_nonce')
    ) {
        // verify NG
        die('Nonce verification failed.');
    }

    // 定义创建新 WP_Query 对象时所需的参数
    $args = array(
        'post_type' => 'product',  // 查询WooCommerce的产品
        'posts_per_page' => PRODUCT_QUANTITY_PER_PAGE, // load product quantity for each time
        'paged' => $_POST['page'], // 要查询的分页数
    );

    //自定义产品查询，类型为'post_type' => 'product' 也就是产品
    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            // 准备当前循环中的产品数据，以便可以获取其详细信息，如标题、内容等
            $loop->the_post();
            // 负责加载一个模板文件，用于显示单个产品的信息
            // load template, run content-product.php
            wc_get_template_part('content', 'product');
        }
    } else {
        echo 'No more products to load.';
    }

    // 重置查询数据，清理查询后的全局数据，恢复到主查询的状态
    wp_reset_postdata();
    // 结束函数
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

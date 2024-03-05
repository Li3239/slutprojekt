<?php
/*
 * Product 
 */
//==================================================
// 使用 widgets 添加到自定义 custom_sidebar_hook 钩子
// 参考：custom-widgets.php 的设定
//==================================================
function custom_shop_sidebar()
{
    // if (is_woocommerce() && is_active_sidebar('sidebar001')) {
    if ((is_shop() || is_product_category() || is_product_taxonomy()) && is_active_sidebar('sidebar001')) {
        dynamic_sidebar('sidebar001');
    }
}
// used in archive-product.php
add_action('custom_sidebar_hook', 'custom_shop_sidebar', 15);

//---------------------------------------------------
// Add custom button for product
//  添加add to cart 按键 和 Like 按键，
//  并且将其放置在 div class=“hover-buttons”中
//  目的是为了实现当 hover到产品列表中的产品时，才显示这个div
//---------------------------------------------------
function add_custom_buttons_to_products()
{
    global $product; // 获取当前循环中的产品对象

    // 动态生成“添加到购物车”链接
    $add_to_cart_url = $product->add_to_cart_url();

    // 输出自定义按钮的HTML
    echo '<div class="hover-buttons">
            <a href="' . esc_url($add_to_cart_url) . '" class="button add_to_cart_button"></a>
            <p>|</p>
            <a href="#" class="button like_button"></a>
          </div>';
}
add_action('woocommerce_after_shop_loop_item', 'add_custom_buttons_to_products', 20);


//---------------------------------------------------
// 删除 woocommerce 固有的 add to cart 按键/link
//  因为在 add_custom_buttons_to_products 中添加了
//  add to cart 功能，所以需要将 woocommerce原有的功能去除
//---------------------------------------------------
function remove_default_add_to_cart_buttons($button, $product)
{
    return ''; // 返回一个空字符串以移除按钮
}
add_filter('woocommerce_loop_add_to_cart_link', 'remove_default_add_to_cart_buttons', 10, 2);


//---------------------------------------------------
// 删除 woocommerce 默认的shop页面的下拉菜单 filter/sorter
// 删除 woocommerce paging
//---------------------------------------------------
function remove_woocommerce_default_setting_in_shop_page()
{
    // 删除 woocommerce 默认的shop页面的下拉菜单 filter/sorter
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

    // 删除 woocommerce paging
    remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_pagination', 10);
}
add_action('init', 'remove_woocommerce_default_setting_in_shop_page');

//==================================================
// 最上部的面包屑，title部分不显示
//==================================================
add_filter('woocommerce_show_page_title', 'custom_woocommerce_show_page_title');
function custom_woocommerce_show_page_title($show_title)
{
    // 可以根据条件返回true或false，false将不显示默认的WooCommerce页面标题
    return false;
}

//==================================================
// 删除 woocommerce sidebar
//==================================================
function remove_woocommerce_sidebar_shop_page()
{
    if (is_shop() || is_product_category() || is_product_taxonomy()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}
//钩子 wp 在WordPress环境完全加载并且主查询对象已经被设置之后触发。
//使用 wp 钩子可以确保所有的条件标签（如 is_shop()）都能正常工作
add_action('wp', 'remove_woocommerce_sidebar_shop_page');


//==================================================
// 删除 woocommerce breadcrumb in shop page/
// eg：Home / Shop
//==================================================
// function remove_woocommerce_breadcrumbs_in_shop_page()
// {
//     if (is_shop() || is_product_category() || is_product_tag()) {
//         remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
//     }
// }
// add_action('template_redirect', 'remove_woocommerce_breadcrumbs_in_shop_page');
        
//==================================================
// 使用钩子 woocommerce_before_shop_loop 添加
// shop / product category 页面中产品列表上部的
// category 名称
//==================================================
function display_selected_category_above_products()
{
    global $wp_query;

    if (is_product_category() || is_shop()) {
        // 检查是否有分类被选中
        $cat_obj = $wp_query->get_queried_object();
        if ($cat_obj && isset($cat_obj->taxonomy) && $cat_obj->taxonomy == 'product_cat') {
            // 获取当前分类的名称
            $category_name = $cat_obj->name;
    
            // 显示当前分类名称
            echo '<div class="product-category-title">' . esc_html($category_name) . '</div>';
            // 如果有描述，则显示
            if (!empty($category_description)) {
                echo '<div id="current-category-description">' . esc_html($category_description) . '</div>';
            }
        } else {
            // 如果没有选中分类，可以选择显示面包屑或其他信息
            woocommerce_breadcrumb();
        }
    }
}
// add_action('woocommerce_before_shop_loop', 'display_selected_category_above_products', 20);


//==================================================
// 使用钩子 woocommerce_before_shop_loop 添加
// shop / product category 页面中产品列表上部的
// category description 
//==================================================
function add_custom_category_description()
{
    if (is_product_category()) {
        $current_term = get_queried_object();
        $category_name = $current_term->name;
        $category_description = $current_term->description;

        // 显示当前分类名称
        // echo '<div id="current-category-name">' . esc_html($category_name) . '</div>';

        // 如果有描述，则显示
        if (!empty($category_description)) {
            echo '<div class="current-category-description">' . esc_html($category_description) . '</div>';
        }
    }
}
add_action('woocommerce_before_shop_loop', 'add_custom_category_description', 10); // 确保这个动作优先于排序选项执行


//---------------------------------------------------
// 使用钩子 woocommerce_archive_description
// 添加 category 名称 处理   好像不对！！！
//---------------------------------------------------
// function custom_woocommerce_category_title()
// {
//     // shop / product category page only
//     if (is_product_category() || is_shop()) {
//         $current_category = get_queried_object();
//         $category_name = $current_category->name;
//         echo '<h1 class="product-category-title">' . $category_name . '</h1>';
//     }
// }
// add_action('woocommerce_archive_description', 'custom_woocommerce_category_title', 5);



//---------------------------------------------------
// 添加自定义的 shop页面的 filter/sorter
// 点击 FILTER&SORTER 后显示的纵向的排序列表
//---------------------------------------------------
function add_custom_sorting_options()
{
?>
    <div class="sort-button">FILTER & SORT</div>
    <!-- 显示选择的内容 -->
    <div id="selected-sort"></div>
    <div class="sorting-options" style="display: none;">
        <a href="#" data-orderby="menu_order">Default</a>
        <a href="#" data-orderby="popularity">Popular</a>
        <a href="#" data-orderby="rating">Rating</a>
        <a href="#" data-orderby="date">Date</a>
        <a href="#" data-orderby="price">Price: low to high </a>
        <a href="#" data-orderby="price-desc">Price: high to low</a>
    </div>
<?php
}
add_action('woocommerce_before_shop_loop', 'add_custom_sorting_options', 30);

//---------------------------------------------------
// 通过 WooCommerce 的 woocommerce_sale_flash 过滤器
// 拦截了原本显示的销售标记 HTML，并对其进行修改
// 函数目前被设置为返回一个空字符串 ""，
// 这意味着它实际上会移除或隐藏所有商品的销售标记
//---------------------------------------------------
function mytheme_filter_sale_flash($html)
{

    $str = __('Sale');
    // 它会将所有销售标记中的“Sale”替换为“Rea”
    //str_replace('Sale', 'Rea', $html);
    return "";
}
add_filter('woocommerce_sale_flash', 'mytheme_filter_sale_flash',  100);

//---------------------------------------------------
// 移除了 WooCommerce 默认添加在产品标题之前的缩略图动作
// 并且在产品标题之前显示一个自定义的缩略图用来显示 打折🈹消息
//---------------------------------------------------
function custom_loop_product_thumbnail()
{
    echo '<div class="image-frame">';

    global $product;
    // 检查当前产品是否正在促销
    if ($product->is_on_sale()) {
        echo '<span class="onsale"> Sale </span>';
    }
    $categories = $product->get_category_ids();
    foreach ($categories as $category) {
        $term = get_term_by('id', $category, 'product_cat');

        if ($term->name == 'New Arrivals') {
            echo '<span class="new"> News </span>';
            break;
        }
    }
    echo woocommerce_get_product_thumbnail();
    echo '</div>';
}
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
add_action('woocommerce_before_shop_loop_item_title', 'custom_loop_product_thumbnail');


//---------------------------------------------------
//通过钩子woocommerce_shop_loop_item_title 添加自定义打折🈹百分比
//---------------------------------------------------
function mytheme_woocommerce_shop_loop_item_title()
{
    global $product;
    if ($product->is_on_sale()) {
        $regular = $product->get_regular_price();
        $sale = $product->get_sale_price();
        $percent = intval((1.0 - ($sale / $regular)) * 100);
        echo '<span class="percent-off">-' . $percent . '%</span>';
    }
}
add_action('woocommerce_shop_loop_item_title', 'mytheme_woocommerce_shop_loop_item_title');


//---------------------------------------------------
// 添加自定义的 shop页面的 filter/sorter
// 点击 FILTER&SORTER 后显示的纵向的排序列表
//---------------------------------------------------
// function mytheme_woocommerce_after_shop_loop_item_title()
// {
//     global $product;
//     $rating = $product->get_average_rating();
//     $width = ($rating / 5) * 100;

//     echo '<div class="rating">
//             <div class="fill" style="width:' . $width . '%;"> </div>
//         </div>';
// }
// remove_action("woocommerce_after_shop_loop_item_title", "woocommerce_template_loop_rating", 5);
// add_action("woocommerce_after_shop_loop_item_title", "mytheme_woocommerce_after_shop_loop_item_title", 20);




// function mytheme_woocommerce_after_shop_loop_item_title()
// {
//     global $product;
//     $rating = $product->get_average_rating(); // 获取平均评分
//     $full_stars = floor($rating); // 满星的数量
//     $half_star = ($rating - $full_stars) >= 0.5 ? 1 : 0; // 判断是否需要显示半星，这里简化处理，只根据是否有半星来决定
//     $empty_stars = 5 - $full_stars - $half_star; // 剩余的空星数量

//     echo '<div class="star-rating">';
//     // 显示满星
//     for ($i = 0; $i < $full_stars; $i++) {
//         echo '<span class="star full-star">&#xf005;</span>'; // 这里使用您的黄色星星图标或类
//     }
//     // 如果需要，显示半星
//     if ($half_star) {
//         // 显示半星的代码，这里简化处理，您可以根据需要调整
//         echo '<span class="star half-star">&#xf123;</span>'; // 使用半星图标或者是黄色图标的变种
//     }
//     // 显示空星
//     for ($i = 0; $i < $empty_stars; $i++) {
//         echo '<span class="star empty-star">&#xf006;</span>'; // 这里使用您的灰色星星图标或类
//     }
//     echo '</div>';
// }
// remove_action("woocommerce_after_shop_loop_item_title", "woocommerce_template_loop_rating", 5);
// add_action("woocommerce_after_shop_loop_item_title", "mytheme_woocommerce_after_shop_loop_item_title", 5);



//---------------------------------------------------
// 计算评分review/rate
// 整数/半数 用来控制显示的星星数量
//---------------------------------------------------
function adjust_rating($rating)
{
    // 获取评分的整数部分
    $floor_rating = floor($rating);
    // 获取评分的小数部分
    $fraction = $rating - $floor_rating;

    // 检查小数部分，决定如何调整评分
    // 4.0-4.2 -> 4 / 4.3-4.7 -> 4.5 / 4.8 - 5 -> 5
    if ($fraction >= 0 && $fraction <= 0.2) {
        // 小数部分0-0.2，不增加半星
        return $floor_rating;
    }
    if ($fraction >= 0.3 && $fraction <= 0.6) {
        // 小数部分 0.3-0.7，增加半星
        return $floor_rating + 0.5;
    } else {
        // 小数部分大于等于0.8，增加一整星
        return $rating;
    }
}

//---------------------------------------------------
// 使用钩子 woocommerce_after_shop_loop_item_title
// 移除默认的 woocommerce_template_loop_rating 处理
// 添加自定义形式
//---------------------------------------------------
function mytheme_woocommerce_after_shop_loop_item_title()
{
    global $product;
    // 获取平均评分 并且调用自定义函数，处理用来显示的 rate
    $average_rating = $product->get_average_rating();
    $rating = adjust_rating($average_rating);

    error_log("Product rate :", $average_rating, "Product adjust rate :", $rating);
    // 满星数量
    $full_stars = floor($rating);

    // 半星数量
    $half_star = ($rating - $full_stars > 0) ? 1 : 0;
    // 空星数量
    $empty_stars = 5 - $full_stars - $half_star;
    // 半星占比 比如4.8分，$half_rate_width_percentage = 80
    $half_rate = ($rating - $full_stars) * 100;

    echo '<div class="star-rating">';
    // 打印满星
    for ($i = 0; $i < $full_stars; $i++) {
        echo '<span class="full-star">&#xf005;</span>'; // Font Awesome 满星图标
    }
    // 如果需要，打印半星
    if ($half_star == 1) {
        // echo '<span class="half-star">&#xf123;</span>'; // Font Awesome 半星图标
        // $half_star_width_percentage = 90; // 例如，这表示90%的宽度
        echo '<span class="half-star">
                <span class="half-star-font-awesome"
                      style="width: ' . $half_rate . '%;">
                      &#xf005;
                </span>
              </span>';
    }
    // 打印空星，有评分的商品才需要显示评分
    if ($rating > 0) {
        for ($i = 0; $i < $empty_stars; $i++) {
            // Font Awesome 空星图标
            echo '<span class="empty-star">&#xf006;</span>';
        }
    }
    echo '</div>';
}
remove_action("woocommerce_after_shop_loop_item_title", "woocommerce_template_loop_rating", 5);
add_action("woocommerce_after_shop_loop_item_title", "mytheme_woocommerce_after_shop_loop_item_title", 5);


// function mytheme_woocommerce_after_shop_loop_item_title()
// {
//     global $product;
//     $average_rating = $product->get_average_rating();
//     $rating = adjust_rating($average_rating);

//     $full_stars = floor($rating);
//     $half_star = ($rating - $full_stars > 0) ? 1 : 0;
//     $empty_stars = 5 - $full_stars - $half_star;

//     echo '<div class="star-rating">';
//     // print full stars
//     for ($i = 0; $i < $full_stars; $i++) {
//         // Font awesome full star icon
//         echo '<span class="full-star">&#xf005;</span>';
//     }
//     // print half star if exists
//     if ($half_star == 1) {
//         // Font awesome half icon
//         echo '<span class="half-star">&#xf123;</span>';
//     }
//     // print empty starts if average rating data exists
//     if ($average_rating > 0) {
//         for ($i = 0; $i < $empty_stars; $i++) {
//             // Font awesome empty icon
//             echo '<span class="empty-star">&#xf006;</span>';
//         }
//     }
//     echo '</div>';
// }
// remove_action("woocommerce_after_shop_loop_item_title", "woocommerce_template_loop_rating", 5);
// add_action("woocommerce_after_shop_loop_item_title", "mytheme_woocommerce_after_shop_loop_item_title", 5);

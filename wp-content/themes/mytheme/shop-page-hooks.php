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
// 添加内容到 产品列表前 in shop page/
// eg：Home / Shop
//==================================================
function add_custom_category_info()
{
    // if (is_product_category()) {
    $current_term = get_queried_object();
    $category_name = $current_term->name;
    $category_description = $current_term->description;

    // 显示当前分类名称
    // echo '<div id="current-category-name">' . esc_html($category_name) . '</div>';

    // 如果有描述，则显示
    if (!empty($category_description)) {
        echo '<div class="current-category-description">' . esc_html($category_description) . '</div>';
    }
    // }
}
add_action('woocommerce_before_shop_loop', 'add_custom_category_info', 10); // 确保这个动作优先于排序选项执行


//==================================================
// ？？？？？？？？？？？？？？？？
// 使用钩子 woocommerce_before_shop_loop 添加两部分，注意顺序
//==================================================
function display_selected_category_above_products()
{
    global $wp_query;

    // 检查是否有分类被选中
    $cat_obj = $wp_query->get_queried_object();
    if ($cat_obj && isset($cat_obj->taxonomy) && $cat_obj->taxonomy == 'product_cat') {
        // 获取当前分类的名称
        $category_name = $cat_obj->name;

        // 显示当前分类名称
        echo '<div class="current-category-name">' . esc_html($category_name) . '</div>';
        // 如果有描述，则显示
        if (!empty($category_description)) {
            echo '<div id="current-category-description">' . esc_html($category_description) . '</div>';
        }
    } else {
        // 如果没有选中分类，可以选择显示面包屑或其他信息
        woocommerce_breadcrumb();
    }
}
// add_action('woocommerce_before_shop_loop', 'display_selected_category_above_products', 20);


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

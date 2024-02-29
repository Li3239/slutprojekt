<?php
//==================================================
// 使用 widgets 添加到自定义 custom_sidebar_hook 钩子
// 参考：custom-widgets.php 的设定
//==================================================
function custom_shop_sidebar()
{
    if (is_woocommerce() && is_active_sidebar('sidebar001')) {
        dynamic_sidebar('sidebar001');
    }
}
// used in archive-product.php
add_action('custom_sidebar_hook', 'custom_shop_sidebar', 15);

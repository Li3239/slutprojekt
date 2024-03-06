<?php
//-------------------------------
// Ship to a different address
//-------------------------------
add_filter('woocommerce_ship_to_different_address_checked', '__return_false');

//-----------------------------------------------------------------
// Ship to a different address
// @param1: $rates 是一个包含了可用配送方式的数组
//          当使用 woocommerce_package_rates 过滤器钩子时，
//          $rates 会作为参数传入，允许开发者修改或过滤在线商店的配送选项
//-----------------------------------------------------------------
// function custom_free_shipping($rates, $package)
// {
//     // 设置免费送货的最低订单金额
//     $free_shipping_amount = 1000;
//     $cart_total = WC()->cart->cart_contents_total;
//     foreach ($rates as $rate_id => $rate) {
//         if ('free_shipping' === $rate->method_id) {
//             if ($cart_total >= $free_shipping_amount) {
//                 return array($rate_id => $rate);
//             } else {
//                 //从货运选项中移除 free_shipping
//                 unset($rates[$rate_id]);
//                 break;
//             }
//         }
//     }

//     return $rates;
// }






function custom_free_shipping($rates, $package)
{
    // 设置免费送货的最低订单金额
    $free_shipping_amount = 1000;
    $cart_total = WC()->cart->cart_contents_total;

    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            if ($cart_total >= $free_shipping_amount) {
                // 当购物车总金额达到免费配送标准时，仅保留免费送货选项
                return array($rate_id => $rate);
            } else {
                // 当购物车总金额未达到免费配送标准时，移除免费送货选项
                unset($rates[$rate_id]);
                break; // 成功移除免费送货选项后退出循环
            }
        }
    }
    //返回修改后的运费选项
    return $rates;
}
add_filter('woocommerce_package_rates', 'custom_free_shipping', 10, 2);






// add_filter('woocommerce_package_rates', 'restrict_shipping_options', 10, 2);

// RESTRICT SHIPPING OPTIONS
// function restrict_shipping_options($rates, $package)
// {

//     $free_shipping_available = false;
//     foreach ($rates as $rate) {
//         if ($rate->method_id === 'free_shipping') {
//             $free_shipping_available = true;
//             break;
//         }
//     }

//     if ($free_shipping_available) {
//         foreach ($rates as $key => $rate) {
//             if ($rate->method_id !== 'free_shipping') {
//                 unset($rates[$key]);
//             }
//         }
//     }

//     return $rates;
// }
<?php
/*
 * Custom Send Email 
 */
function my_custom_thank_you_email($order_id)
{
    $order = wc_get_order($order_id);
    if (!$order) return;

    // load email.html model
    $template = file_get_contents(get_stylesheet_directory() . '/email.html');

    // Set product order items list
    $order_items = $order->get_items();
    $items_list = '';
    /**
     * @var WC_Order_Item_Product $item
     */
    foreach ($order_items as $item_id => $item) {
        $product_name = $item->get_name();
        $quantity = $item->get_quantity();
        $price_per_unit = $item->get_total() / $quantity;

        $items_list .= '<tr class="email-order-item">';
        $items_list .= '  <td class="column-product">' . $product_name . '</td>';
        $items_list .= '  <td class="column-quantity">' . $quantity . '</td>';
        $items_list .= '  <td class="column-price">';
        $items_list .= '     <span class="woocommerce-Price-amount amount">' . wc_price($price_per_unit) . '</span>';
        $items_list .= '  </td>';
        $items_list .= '</tr>';
    }

    // get related product  list
    $related_product_info = array();
    /**
     * @var WC_Order_Item_Product $item
     */
    foreach ($order_items as $item_id => $item) {
        $product = $item->get_product();
        $related_products = wc_get_related_products($product->get_id());
        foreach ($related_products as $related_product_id) {
            $related_product = wc_get_product($related_product_id);
            $related_product_info[] = array(
                'title' => $related_product->get_name(),
                'image' => $related_product->get_image(), // 获取产品图片
                'link' => $related_product->get_permalink(), // 获取产品链接
            );
        }
    }

    // Replace placeholders in templates
    $replacements = array(
        '{{order_id}}' => $order_id,
        '{{order_items}}' => $items_list,
        '{{payment_method_title}}' => $order->get_payment_method_title(),
        '{{payment_method}}' => $order->get_payment_method(),
        '{{date_paid}}' => $order->get_date_paid(),
        '{{shipping_total}}' => wc_price($order->get_shipping_total()),
        '{{shipping_method}}' => $order->get_shipping_method(),
        '{{total_price}}' => wc_price($order->get_total()),
        '{{sub_total_price}}' => wc_price($order->get_subtotal()),
        '{{billing_name}}' => $order->get_billing_first_name(),
        '{{billing_full_name}}' => $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(),
        '{{billing_address}}' => $order->get_billing_address_1() . ' ' . $order->get_billing_address_2(),
        '{{billing_post}}' => $order->get_billing_postcode(),
        '{{billing_city}}' => $order->get_billing_city(),
        '{{related_product_list}}' => '', // Add a placeholder for related products
    );

    // Convert related products info to HTML
    $related_products_html = '';
    $related_product_count = 0;
    foreach ($related_product_info as $product) {
        if ($related_product_count > 3) {
            break;
        }
        $related_products_html .= '<div class="related-product">';
        $related_products_html .= '  <a href="' . $product['link'] . '">';
        $related_products_html .=       $product['image']; // $product['image']包含了整个<img>标签所需内容
        $related_products_html .= '  </a>';
        $related_products_html .= '  <h3>' . $product['title'] . '</h3>';
        $related_products_html .= '</div>';
        $related_product_count++;
    }
    // error_log("Send email !!!!!!!! html : " . $related_products_html);

    // array_merge: 合并一个或多个数组
    // strtr()：是一个PHP内置函数，用于字符串替换
    // 第一个参数是要进行替换的原字符串（即来自email.html 的 $template）。
    // 第二个参数是一个数组，指明了要替换的占位符及其对应的替换值（即 数组$replacements）
    // 将 $template 中的 占位符用 $replacements 中相应的值替换
    $template = strtr($template, array_merge($replacements, array('{{related_products}}' => $related_products_html)));
    
    // Send email
    $customer_email = $order->get_billing_email();
    $headers = array('Content-Type: text/html; charset=UTF-8');
    // 邮件发送时所有的信息必须全部打包好，不支持外部的css等设定
    wp_mail($customer_email, 'Your Order Confirmation', $template, $headers);
}
add_action('woocommerce_order_status_completed', 'my_custom_thank_you_email');

/*
 * Inactiv Woocommerce order completed Email 
 */
function disable_woocommerce_completed_order_email($enabled, $order)
{
    // 你可以添加更多逻辑来决定何时禁用邮件
    // 例如，基于订单详情、客户信息等条件
    return false; // 返回false禁用邮件
}
add_filter('woocommerce_email_enabled_customer_completed_order', 'disable_woocommerce_completed_order_email', 10, 2);



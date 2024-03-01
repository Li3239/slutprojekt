<?php
/*
** 1. Add shortcodes.php in init.php
** 2. Add defined shortcode in some page by writing 【[/]shortcode】 ：【[mytheme_box]】
** 3. Use shortcodes for swish，klana etc.
*/
function mytheme_shortcode_draw_box($attr)
{
    //在page中引用shortcode【[mytheme_box]】时，第一项为缺省值，如果parameter【$attr)】未指定时使用这个数组指定的内容
    // 如果parameter【$attr)】指定时，使用方法：【[mytheme_box color="lime" size="5"]】，使用用户指定的内容
    // 只有一个color参数时，在dashboard的页面编辑器中选中【shortcode】然后填入【[mytheme_box green]】既可以显示绿色的box
    $attr = shortcode_atts(
        array(
            "color" => "green",
            "size" => 1
        ),
        $attr,
        "mytheme_box"
    );
    return '<div style="width:100px; height:100px; background:' . $attr["color"] . '"></div>';
}
// 第一个参数定义了shortcode的名称【[mytheme_box]】
add_shortcode("mytheme_box", "mytheme_shortcode_draw_box");



// 中间使用逗号➕空格区分  ： 必须与explode(', ', $atts['images']);一致！！！
// [mytheme_shortcode_projects_block images="http://.../gallery1.png, http://.../gallery2.png"]
// 页面编辑器中调用：[mytheme_shortcode_projects_block images="image1.jpg, image2.jpg, image3.jpg"]
// [mytheme_shortcode_projects_block title="AAA" overlay_title="Sample Project" images="http://projectlorum.test/wp-content/uploads/2024/01/gallery1.png, http://projectlorum.test/wp-content/uploads/2024/01/gallery2.png, http://projectlorum.test/wp-content/uploads/2024/01/gallery3.png, http://projectlorum.test/wp-content/uploads/2024/01/gallery4.png, http://projectlorum.test/wp-content/uploads/2024/01/image-18.png"]
// function customer_projects_block($atts)
function customer_shop_hero_block()
{
    //Start caching output
    ob_start();
?>
    <div class="shop-hero">
        <span class="shop-hero-title"><?= get_option("store_shop_hero_title"); ?></span>
        <span class="shop-hero-sub-title"><?= get_option("store_shop_hero_sub_title"); ?></span>
        <span class="shop-hero-info"><?= get_option("store_shop_hero_info"); ?></span>
    </div>
<?php
    // Return cached content and clear cache
    return ob_get_clean();
}
add_shortcode('shortcode_shop_hero', 'customer_shop_hero_block');

//---------------------------
// Email template shortcode
//---------------------------
function customer_email_template()
{
    ob_start();
?>
    <div class="email-content">
        <div class="email-header-image">
        </div>
        <div class="email-header-title">
            <p>Thank you for your order</p>
        </div>
        <div class="email-order-inner">
            <span class="customer-name">Hi Li,</span>
            <span class="order-summary-info">Just to let you know — we've received your order #81, and it is now being processed:</span>
            <span class="order-payment-info">Pay with cash upon delivery.</span>
            <h2 class="order-title">[Order #81] (February 28, 2024)</h2>
        </div>

        <div class="email-order-detail">
            <table>
                <!-- title -->
                <thead>
                    <tr>
                        <th class="column-product">Product</th>
                        <th class="column-quantity">Quantity</th>
                        <th class="column-price">Price</th>
                    </tr>
                </thead>
                <!-- order item detail (Multipule)-->
                <tbody>
                    <tr class="email-order-item">
                        <td class="column-product">Checked Duvet Cover Set </td>
                        <td class="column-quantity">2 </td>
                        <td class="column-price">
                            <span class="woocommerce-Price-amount amount">79.98&nbsp;<span class="woocommerce-Price-currencySymbol">kr</span></span>
                        </td>
                    </tr>
                </tbody>
                <!-- subtotal / shipping / Payment method -->
                <tfoot>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Subtotal:</th>
                        <td class="column-samary-content" scope="row" colspan="2">
                            <span class="woocommerce-Price-amount amount">
                                184.98&nbsp;
                                <span class="woocommerce-Price-currencySymbol">kr</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Shipping:</th>
                        <td class="column-samary-content">
                            <span class="woocommerce-Price-amount amount">
                                250.00&nbsp;
                                <span class="woocommerce-Price-currencySymbol">kr</span>
                            </span>
                            &nbsp;
                            <small class="shipped_via">via Db Schenker Express</small>
                        </td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Payment method:</th>
                        <td class="column-samary-content">Cash on delivery</td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Total:</th>
                        <td class="column-samary-content">
                            <span class="woocommerce-Price-amount amount">
                                434.98&nbsp;
                                <span class="woocommerce-Price-currencySymbol">kr</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Note:</th>
                        <td class="column-samary-content">Here is some note from customer!!!!!!!!!</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="email-shipping-billing">
            <div class="email-billing">
                <h2>Billing address</h2>
                <div class="address">
                    <p class="billing-name">Li Li</p>
                    <p class="billing-address">Svargertorpsvagen 1</p>
                    <p class="billing-post">21500 Malmo</p>
                    <p class="billing-email">palmlearnli@gmail.com</p>
                </div>
            </div>
            <div class="email-billing">
                <h2>Shipping address</h2>
                <div class="address">
                    <p class="shipping-name">Li Li</p>
                    <p class="shipping-address">Svargertorpsvagen 1</p>
                    <p class="shipping-post">21500 Malmo</p>
                </div>
            </div>
            <p style="margin: 0 0 16px;">Thanks for using slutprojekt.test!</p>
        </div>
    </div>
<?php
    // Return cached content and clear cache
    return ob_get_clean();
}


function home_top_1() {
    ?>

    <div class="home-section1">
    <div class="home-top">
        <img src="<?= get_template_directory_uri() . "/resources/assets/images/delievery.svg"; ?>"
            class="header-icon" />
        <img src="<?= get_template_directory_uri() . "/resources/images/delievery.svg"; ?>" class="header-icon" />
        <h2>FREE SHIPPING</h2>
    </div>

    <div class="home-top">
        <img src="<?= get_template_directory_uri() . "/resources/assets/images/moneyback.svg"; ?>"
            class="header-icon" />
        <img src="<?= get_template_directory_uri() . "/resources/images/moneyback.svg"; ?>" class="header-icon" />
        <h2>100% MONEY BACK</h2>
    </div>

    <div class="home-top">
        <img src="<?= get_template_directory_uri() . "/resources/assets/images/support.svg"; ?>"
            class="header-icon" />
        <img src="<?= get_template_directory_uri() . "/resources/images/support.svg"; ?>" class="header-icon" />
        <h2>SUPPORT 24/7</h2>
    </div>
</div>
<?php
}
add_shortcode("shortcode_home_top_1", "home_top_1");

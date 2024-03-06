<?php
//custom hook for star rating
function my_theme_stars_rating() {
    global $product;
    $rating = $product->get_average_rating();
    $width = ($rating / 5) * 100;

    echo "<div class='my-custom-rating'><div class='fill' style='width:" . $width . "%'></div></div>";
}
add_action('woocommerce_single_product_summary', 'my_theme_stars_rating', 5);


function add_custom_button_to_specific_product() {
    global $product;

    // Check if it's the home page and if the current product is the desired product
    if ( is_home() && is_product() && $product && $product->get_id() == 824 ) {
        ?>
        <div class="product-details">
            <p><?php echo $product->get_description(); ?></p>
            <button class="custom-button">Your Button Text</button>
        </div>
        <?php
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'add_custom_button_to_specific_product' );

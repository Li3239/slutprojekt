
//custom hook for star rating
function my_theme_stars_rating() {
    global $product;
    $rating = $product->get_average_rating();
    $width = ($rating / 5) * 100;

    echo "<div class='my-custom-rating'><div class='fill' style='width:" . $width . "%'></div></div>";
}
add_action('woocommerce_single_product_summary', 'my_theme_stars_rating', 5);
<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );
    ?>

    <div class="summary entry-summary">
		
        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         */
        do_action( 'woocommerce_single_product_summary' );
        ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
    
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<!-- Include JavaScript to handle price update based on size variation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
    // Listen for changes in the size variation dropdown
    $('select[name="attribute_size"]').change(function() {
        var size = $(this).val();
        
        // Perform price calculation based on the selected size
        var price = calculatePrice(size);
        
        // Update the displayed price
        $('.woocommerce-variation-price .price').html(price);
    });
    
    // Function to calculate the price based on the selected size
    function calculatePrice(size) {
        // Perform price calculation logic based on the selected size
        // Replace this with your actual price calculation logic
        var price = 0;
        if (size === '140') {
            price = 300; // Set price for size 140
        } else if (size === '160') {
            price = 350; // Set price for size 160
        } // Add more conditions as needed for other sizes
        
        // Format the price as needed
        return price + ' kr';
    }
});
</script>

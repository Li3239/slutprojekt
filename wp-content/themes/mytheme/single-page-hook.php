<?php

/**
 * Justify Summary showing for single product page
 * 
 * Using Hook: woocommerce_single_product_summary.
 * which is set in content-single-product.php
 * 
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */


// Remove reviews
// Remove product rating
// Remove reviews
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Remove product meta (including category)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );



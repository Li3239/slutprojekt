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
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_rating' , 10 );

// Remove product meta (including category)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'init', 'remove_product_quantity_and_additional_info', 99 );

function remove_product_quantity_and_additional_info() {
    // Remove quantity input field
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_quantity_input', 4 );
    
    // Remove additional information tab
    // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
}

remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);


add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_excerpt', 20 );



// add_action( 'woocommerce_single_product_summary', 'custom_display_product_variations', 5 );

// function custom_display_product_variations() {
//     global $product;

//     // echo "test";

//     // Check if the product is variable
//     if ( $product->is_type( 'variable' ) ) {
//         // Output the variations form
//         echo '<div class="woocommerce-variation-form">';
//         do_action( 'woocommerce_before_variations_form' );
//         do_action( 'woocommerce_before_add_to_cart_button' );
        
//         // Display variation stock status
//         echo '<div class="variation-stock-status">';
//         echo '<p>' . esc_html__( 'Stock Status:', 'your-textdomain' ) . ' ' . $product->get_stock_status() . '</p>';
//         echo '</div>';
        
//         // Display size attribute
//         if ( $product->get_attribute( 'size' ) ) {
//             echo '<div class="variation-size">';
//             echo '<p>' . esc_html__( 'Size:', 'your-textdomain' ) . ' ' . wc_attribute_label( 'size' ) . ': ' . $product->get_attribute( 'size' ) . '</p>';
//             echo '</div>';
//         }

//         // Display color attribute
//         if ( $product->get_attribute( 'color' ) ) {
//             echo '<div class="variation-color">';
//             echo '<p>' . esc_html__( 'Color:', 'your-textdomain' ) . ' ' . wc_attribute_label( 'color' ) . ': ' . $product->get_attribute( 'color' ) . '</p>';
//             echo '</div>';
//         }
        
//         // Display the rest of the single product summary
//         do_action( 'woocommerce_single_product_summary' );
//         do_action( 'woocommerce_after_add_to_cart_button' );
//         do_action( 'woocommerce_after_variations_form' );
//         echo '</div>';
//     }
// }


//add_action( 'woocommerce_after_single_product', 'custom_display_product_variations_with_shortcode', 15 );

// function custom_display_product_variations_with_shortcode() {
//     echo do_shortcode('[display_product_variations]');
// }


if ( ! defined( 'ABSPATH' ) ) {exit; // Exit if accessed directly
}

/* Add variation details to the WooCommerce single product summary.*/
 
add_action( 'woocommerce_single_product_summary', 'add_variation_details_to_single_product_summary', 30 );
function add_variation_details_to_single_product_summary() {
    global $product;

    if ( $product->is_type( 'variable' ) ) {    echo '<div class="product-variations">';// Display available variations
foreach ( $product->get_available_variations() as $variation ) {        $variation_product = wc_get_product( $variation['variation_id'] );  echo '<div class="variation">';
            echo '<p><strong>' . $variation_product->get_name() . '</strong></p>'; // Display variation name        echo '<p>Stock Status: ' . $variation_product->get_stock_status() . '</p>'; // Display variation stock status
// Display variation color, size, and image if available        if ( $variation_product->get_attribute( 'color' ) ) {   echo '<p>Color: ' . $variation_product->get_attribute( 'color' ) . '</p>';      }
if ( $variation_product->get_attribute( 'size' ) ) {        echo '<p>Size: ' . $variation_product->get_attribute( 'size' ) . '</p>';
            }if ( $variation_product->get_image_id() ) {    echo wp_get_attachment_image( $variation_product->get_image_id(), 'shop_thumbnail' );
            }echo '</div>'; }   echo '</div>';
    }
}



add_action( 'woocommerce_single_product_summary', 'custom_display_product_variations', 5 );

function custom_display_product_variations() {

    global $product;

    echo"test";
    // Check if the product is variable
    if ( $product->is_type( 'variable' ) ) {
        // Output the variations form
        echo '<div class="woocommerce-variation-form">';
        do_action( 'woocommerce_before_variations_form' );
        do_action( 'woocommerce_before_add_to_cart_button' );
        
        // Display product image
        echo '<div class="product-image">';
        echo '<p>' . $product->get_image() . '</p>';
        echo '</div>';
        
        // Display variation stock status
        echo '<div class="variation-stock-status">';
        echo '<p>' . esc_html__( 'Stock Status:', 'your-textdomain' ) . ' ' . $product->get_stock_status() . '</p>';
        echo '</div>';
        
       
        // Display the rest of the single product summary
        do_action( 'woocommerce_after_variations_form' );
        do_action( 'woocommerce_after_add_to_cart_button' );
        echo '</div>';
    }
}

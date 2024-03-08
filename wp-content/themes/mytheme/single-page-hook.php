<?php
/**
 * Justify Summary showing for single product page
 * 
 * Using Hook: woocommerce_single_product_summary.
 * which is set in content-single-product.php
 * 
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */

// if ( ! defined( 'ABSPATH' ) ) {
//     exit; // Exit if accessed directly
// }


// // Remove product rating
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_rating', 10 );

// // Remove product meta (including category)
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// // Remove product excerpt
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// // Add product excerpt before add to cart button
// add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_excerpt', 5 );

// add_action( 'woocommerce_efter_single_product_summary', 'woocommerce_template_single_excerpt', 5 );
// // Add custom display product variations
// add_action( 'woocommerce_single_product_summary', 'custom_display_product_variations', 15 );



// function custom_display_product_variations() {
//     global $product;

//     // Check if the product is variable
//     if ( $product->is_type( 'variable' ) ) {
//         // Output the variations form
//         echo '<div class="woocommerce-variation-form">';
//         do_action( 'woocommerce_before_variations_form' );
//         do_action( 'woocommerce_before_add_to_cart_button' );
        
//         // Display product title
//         echo '<h2>' . get_the_title() . '</h2>';
        
//         // Display product price
//         echo '<div class="product-price">';
//         echo '<p>' . $product->get_price_html() . '</p>';
//         echo '</div>';
        
//         // Display product color
//         echo '<div class="product-color">';
//         echo '<p>' . esc_html__( 'Color:', 'your-textdomain' ) . ' ' . $product->get_attribute( 'color' ) . '</p>';
//         echo '</div>';
        
//         // Display product image
//         echo '<div class="product-image">';
//         echo '<p>' . $product->get_image() . '</p>';
//         echo '</div>';
        
//         // Display stock status
//         echo '<div class="stock-status">';
//         echo '<p>' . esc_html__( 'Stock Status:', 'your-textdomain' ) . ' ' . $product->get_stock_status() . '</p>';
//         echo '</div>';
        
//         // Display the rest of the single product summary
//         do_action( 'woocommerce_after_add_to_cart_button' );
//         echo '</div>';
//     }
// }

// // Add the product size select dropdown before the "Add to Cart" button
// add_action( 'woocommerce_before_add_to_cart_button', 'display_product_size_select', 5 );

// function display_product_size_select() {
//     global $product;

//     // Check if the product has the 'size' attribute
    // if ( $product->get_attribute( 'size' ) ) {
    //     ?>
    //     <div class="product-size">
           
    //         <select name="product_size" id="product_size">
    //             <option value=""><?php esc_html_e( 'Select Size', 'your-textdomain' ); ?></option>
    //             <?php
    //             // Get the sizes from the 'size' attribute
    //             $product_sizes = $product->get_attribute( 'size' );

    //             // Split the sizes string into an array
    //             $sizes_array = explode( '|', $product_sizes );

    //             // Loop through each size and add as an option
    //             foreach ( $sizes_array as $size ) {
    //                 echo '<option value="' . esc_attr( $size ) . '">' . esc_html( $size ) . '</option>';
    //             }
    //             ?>
    //         </select>
    //     </div>
    //     <?php
    // }

//     // Enqueue JavaScript only on single product pages
//     if ( is_product() ) {
//         // Get the current product
//         global $product;
//         if ( $product && $product->is_type( 'variable' ) ) {
//             // Enqueue custom JavaScript file
//             wp_enqueue_script( 'customize-product-price', get_stylesheet_directory_uri() . '/customize-product-price.js', array( 'jquery' ), '1.0', true );

//             // Localize script with product ID and price data
//             wp_localize_script( 'customize-product-price', 'productData', array(
//                 'productId' => $product->get_id(),
//                 'defaultPrice' => $product->get_price(),
//                 'pricesBySize' => json_decode( $product->get_attribute( 'prices_by_size' ), true ),
//             ) );
//         }
//     }
// }

// function merge_summary_and_additional_information() {
//     global $product;

//     // Output the title and price
//     echo '<div class="summary entry-summary">';
//     echo '<h1 class="product_title entry-title">' . $product->get_name() . '</h1>';
//     echo '<p class="price">' . $product->get_price_html() . '</p>';

//     // Output the color
//     echo '<p> Light khaki green/white checks</p>';

//     // Output the image
//     echo '<div class="product-image">' . $product->get_image('woocommerce_thumbnail') . '</div>';

//     // Output the stock status
//     echo '<div class="stock-status">';
//     if ($product->is_in_stock()) {
//         echo '<p> ' . __('In stock', 'woocommerce') . '</p>';
//     } else {
//         echo '<p> ' . __('Out of stock', 'woocommerce') . '</p>';
//     }
//     echo '</div>';

//     // Output the size
//     echo '<div class="product-size">';
   
//     echo '<select name="product_size" id="product_size">';
//     echo '<option value="">Select Size</option>';
//     echo '<option value="small">Small</option>';
//     echo '<option value="medium">Medium</option>';
//     echo '<option value="large">Large</option>';
//     echo '</select>';
//     echo '</div>';

//     // Output the add to cart button
//     echo '<form class="cart" action="' . esc_url($product->add_to_cart_url()) . '" method="post" enctype="multipart/form-data">';
//     echo '<div class="quantity">';
//     woocommerce_quantity_input(array(
//         'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
//         'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
//         'input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : $product->get_min_purchase_quantity(),
//     ));
//     echo '</div>';
//     echo '<button type="submit" name="add-to-cart" value="' . esc_attr($product->get_id()) . '" class="single_add_to_cart_button button alt">' . __('Add to cart', 'woocommerce') . '</button>';
//     echo '</form>';

//     echo '</div>'; // Closing summary entry-summary div
// }

// add_action( 'woocommerce_single_product_summary', 'merge_summary_and_additional_information', 5 );

// function remove_duplicate_summary_entry_summary() {
//     remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
//     remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
//     remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
//     remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
// }

// add_action('init', 'remove_duplicate_summary_entry_summary');


// // Remove default description placement
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// // Add description after gallery images
// add_action( 'woocommerce_after_single_product_summary', 'custom_product_description_placement', 20 );

// function custom_product_description_placement() {
//     global $product;

//     // Check if product has short description
//     if ( ! $product || ! $product->get_short_description() ) {
//         return;
//     }
    
//     // Display short description
//     echo '<div class="woocommerce-product-details__short-description">' . $product->get_short_description() . '</div>';
// }



// function mytheme_custom_cta_sale($atts)
// {
//     $atts = shortcode_atts(
//         array(
//             'url'     => '',
//             'title'   => '',
//             'price' => '',
//             'sale_price' => '',
//             'description'   => '',
//             'button'  => '',
//             'link'    => '#', //the default link is set to '#'
//         ),
//         $atts,
//         'cta_photo'
//     );

//     //getting the image URL
//     $image_url = esc_url($atts['url']);

//     //HTML content
//     $output = '
//         <div class="custom-cta-sale-div">
//             <img src="' . esc_attr($image_url) . '" alt="photo" class="custom-cta-sale-photo">
//             <div class="custom-cta-content">
//                 <div class="content">
//                     <p class="title-text">' . esc_html($atts['title']) . '</p>
//                     <p class="price">kr' . esc_html($atts['price']) . ' <span class="sale-price">kr' . esc_html($atts['sale_price']) . '</span></p>
//                     <p class="description-text">' . esc_html($atts['description']) . '</p>
//                     <button class="view-all-btn" onclick="window.location.href=\'' . esc_url($atts['link']) . '\';">' . esc_html($atts['button']) . '</button>
//                     </div>           
//                 </div>
//         </div>
//     ';

//     return $output;
// }
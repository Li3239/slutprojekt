<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once(get_template_directory() . "/init.php");
//test
/**
 * support Woocommerce function
 */
function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

//this function will create a location in the wordpress dashbord
function theme_register_menus() {
    register_nav_menus( array(
        'header-menu' => __( 'Header Menu', 'theme-text-domain' ),
        'home-menu' => __( 'Home Menu', 'theme-text-domain' ),
        'store-menu' => __( 'Store Menu', 'theme-text-domain' ),
        'accessories-menu' => __( 'Accessories Menu', 'theme-text-domain' ),
        'aboutUs-menu' => __( 'AboutUs Menu', 'theme-text-domain' ),
        'news-menu' => __( 'News Menu', 'theme-text-domain' ),
        'contactUs-menu' => __( 'ContactUs Menu', 'theme-text-domain' )


    ) );
}
add_action( 'after_setup_theme', 'theme_register_menus' );





// Define a custom shortcode to display products with specific attributes
function display_product_shortcode( $atts ) {
    // Shortcode attributes
    $atts = shortcode_atts( array(
        'id'          => '',            // Default product ID
        'title'       => true,          // Whether to display the title (default: true)
        'price'       => true,          // Whether to display the price (default: true)
        'description' => true,          // Whether to display the description (default: false)
        'image'       => true,          // Whether to display the image (default: true)
    ), $atts, 'product' );

    // Initialize output variable
    $output = '';

    // Product query arguments
    $args = array(
        'p'              => $atts['id'], // Product ID
        'post_type'      => 'product',   // WooCommerce product post type
        'posts_per_page' => 1,           // Display only one product
    );

    // Product query
    $products = new WP_Query( $args );

    // Check if products were found
    if ( $products->have_posts() ) {
        // Start the output buffer
        ob_start();

        // Loop through products
        while ( $products->have_posts() ) {
            $products->the_post();

            // Display the title if attribute is set to true
            if ( $atts['title'] ) {
                the_title( '<h2>', '</h2>' );
            }

            // Display the image if attribute is set to true
            if ( $atts['image'] ) {
                echo '<div class="product-image">';
                the_post_thumbnail(); // Display the product thumbnail
                echo '</div>';
            }

            // Display the price if attribute is set to true
            if ( $atts['price'] ) {
                wc_get_template_part( 'content', 'single-product' );
            }

            // Display the description if attribute is set to true
            if ( $atts['description'] ) {
                the_content();
            }
        }

        // Get and clean the output buffer
        $output = ob_get_clean();

        // Reset post data
        wp_reset_postdata();
    } else {
        // No products found
        $output = '<p>No product found</p>';
    }

    // Return the output
    return $output;
}

add_shortcode( 'product', 'display_product_shortcode' );

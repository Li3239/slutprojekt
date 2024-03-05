<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once(get_template_directory() . "/init.php");

/**
 * Add WooCommerce support
 */
function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

/**
 * Register menus
 */
function theme_register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'theme-text-domain'),
            'home-menu' => __('Home Menu', 'theme-text-domain'),
            'store-menu' => __('Store Menu', 'theme-text-domain'),
            'accessories-menu' => __('Accessories Menu', 'theme-text-domain'),
            'aboutUs-menu' => __('AboutUs Menu', 'theme-text-domain'),
            'news-menu' => __('News Menu', 'theme-text-domain'),
            'contactUs-menu' => __('ContactUs Menu', 'theme-text-domain')
        )
    );
}
add_action('after_setup_theme', 'theme_register_menus');

/**
 * Custom shortcode to display products with specific attributes
 */
function display_product_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'id' => '',
            'title' => true,
            'price' => true,
            'description' => true,
            'image' => true,
        ),
        $atts,
        'product'
    );

    $output = '';

    $args = array(
        'p' => $atts['id'],
        'post_type' => 'product',
        'posts_per_page' => 1,
    );

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        ob_start();

        while ($products->have_posts()) {
            $products->the_post();

            if ($atts['title']) {
                the_title('<h2>', '</h2>');
            }

            if ($atts['image']) {
                echo '<div class="product-image">';
                the_post_thumbnail();
                echo '</div>';
            }

            if ($atts['price']) {
                wc_get_template_part('content', 'single-product');
            }

            if ($atts['description']) {
                the_content();
            }
        }

        $output = ob_get_clean();

        wp_reset_postdata();
    } else {
        $output = '<p>No product found</p>';
    }

    return $output;
}
add_shortcode('product', 'display_product_shortcode');

/**
 * Display products by IDs
 */
function display_products_by_ids()
{
    $product_ids = array(231, 232, 233);

    ob_start();

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post__in' => $product_ids,
    );

    $products_query = new WP_Query($args);

    if ($products_query->have_posts()) {
        echo '<div class="product-columns">';
        while ($products_query->have_posts()) {
            $products_query->the_post();
            wc_get_template_part('content', 'product');
        }
        echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('display_products', 'display_products_by_ids');

/**
 * Display products with ratings and images
 */
function display_rating_products_with_images() {
    $product_ids = array(231, 232, 233);

    ob_start();

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post__in'       => $product_ids,
    );

    $products_query = new WP_Query($args);

    if ($products_query->have_posts()) {
        echo '<div class="product-columns">';
        while ($products_query->have_posts()) {
            $products_query->the_post();
            echo '<div class="product">';
            echo '<div class="product-thumbnail">';
            woocommerce_template_loop_product_thumbnail();
            echo '</div>';
            echo '<div class="product-details">';
            echo '<h2 class="product-title">' . get_the_title() . '</h2>';
            echo '<div class="rating">';
            woocommerce_template_loop_rating();
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('all_product_stars_with_images', 'display_rating_products_with_images');

/**
 * Add shortcode
 */
add_shortcode( 'display_product_variations', 'custom_display_product_variations_shortcode' );

/**
 * Shortcode callback function
 */
function custom_display_product_variations_shortcode() {
    ob_start(); // Start output buffering
    custom_display_product_variations(); // Call your existing function
    return ob_get_clean(); // Return the buffered content
}





// Add shortcode for the email subscription form
function email_subscription_form_shortcode() {
    // Output HTML for the form
    $output = '<div class="right-content">';
    $output .= '<form action="#" method="post">';
    $output .= '<input type="email" name="email" placeholder="Enter your e-mail address" required>';
    $output .= '<button type="submit"><img src="' . get_template_directory_uri() . '/resources/images/email.png" alt="Subscribe"></button>';
    $output .= '</form>';
    $output .= '</div>';

    return $output;
}
add_shortcode('email_subscription_form', 'email_subscription_form_shortcode');



// Function to display three products with specific IDs
function display_products_shortcode() {
    // Array of product IDs to display
    $product_ids = array(231, 232, 233);

    // Start output buffer
    ob_start();

    // Query the products
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post__in' => $product_ids,
    );

    $products_query = new WP_Query($args);

    if ($products_query->have_posts()) {
        // Start outputting the products
        echo '<div class="product-columns">';
        while ($products_query->have_posts()) {
            $products_query->the_post();
            // Display each product
            wc_get_template_part('content', 'product');
        }
        echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }

    // Reset post data
    wp_reset_postdata();

    // End output buffer and return the content
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('display_products', 'display_products_shortcode');

<?php
function display_top_rated_products_shortcode($atts) {
  ob_start();

  // Temporarily disable WooCommerce styles
  add_filter('woocommerce_enqueue_styles', '__return_false');

  $atts = shortcode_atts(array(
    'limit' => 6,
  ), $atts);

  $args = array(
    'post_type' => 'product',
    'posts_per_page' => $atts['limit'],
    'orderby' => 'meta_value_num',
    'meta_key' => '_wc_average_rating',
    'order' => 'DESC',
  );

  $query = new WP_Query($args);

  
  $custom_template = get_template_directory() . '/top_rated_products_custom.php';

  // Check if the custom template exists
  if (file_exists($custom_template)) {
    include($custom_template);
  } else {
    // Fallback to default behavior if template not found
    echo '<p>Custom template not found.</p>';
  }

  // Unhook and re-enable styles
  remove_filter('template_include', 'empty_template_for_shortcode');
  remove_filter('woocommerce_enqueue_styles', '__return_false');

  $output = ob_get_clean();

  return $output;
}
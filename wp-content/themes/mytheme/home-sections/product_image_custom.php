<?php

function mytheme_custom_product_photo($atts) {
    $atts = shortcode_atts(
        array(
            'url'     => '',
            'title'   => '',
            'description'   => '',
            'button'  => '',
            'link'    => '#', //the default link is set to '#'
        ),
        $atts,
        'cta_photo'
    );

    //getting the image URL
    $image_url = esc_url($atts['url']);

    //HTML content
    $output = '
        <div class="custom-product-photo-div">
            <img src="' . esc_attr($image_url) . '" alt="photo" class="custom-cta-photo">
            <div class="custom-cta-content">
                <p class="title-text">' . esc_html($atts['title']) . '</p>
                <p class="description-text">' . esc_html($atts['description']) . '</p>
                <button class="view-all-btn" onclick="window.location.href=\'' . esc_url($atts['link']) . '\';">' . esc_html($atts['button']) . '</button>
            </div>
        </div>
    ';

    return $output;
}
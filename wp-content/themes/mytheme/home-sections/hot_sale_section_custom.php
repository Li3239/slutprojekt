<?php

function hot_sale_sortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'url'     => '',
            'title'   => '',
            'price' => '',
            'sale_price' => '',
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
        <div class="custom-cta-sale-div">
            <img src="' . esc_attr($image_url) . '" alt="photo" class="hot_sale_-photo">
            <div class="custom-hot_sale">
                <div class="content">
                    <p class="title-text">' . esc_html($atts['title']) . '</p>
                    <p class="price">kr' . esc_html($atts['price']) . ' <span class="sale-price">kr' . esc_html($atts['sale_price']) . '</span></p>
                    <p class="description-text">' . esc_html($atts['description']) . '</p>
                    <button class="view-all-btn" onclick="window.location.href=\'' . esc_url($atts['link']) . '\';">' . esc_html($atts['button']) . '</button>
                    </div>           
                </div>
        </div>
    ';

    return $output;
}
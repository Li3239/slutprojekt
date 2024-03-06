<?php

//Shortcode-box till "bedsheet sets" i home
function moody_studio_shortcode_draw_box($attr)
{
    $attr = shortcode_atts(
        array(
        ),
        $attr,
        "box"
    );
    
    
       return '<div class="box">
       <h2>BEDSHEET SETS</h2>
       <h3>300 kr</h3>
       <h4>700 kr</h4>
       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
       </div>';

}
add_shortcode("box", "moody_studio_shortcode_draw_box");
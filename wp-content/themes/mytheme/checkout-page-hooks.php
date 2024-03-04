<?php
//-------------------------------
// Ship to a different address
//-------------------------------
add_filter('woocommerce_ship_to_different_address_checked', '__return_false');
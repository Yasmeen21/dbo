<?php
/*
Plugin Name: Out Of Stock
Description: Insert boilerplate texts using shortcodes
Version: 1.0
Author: Danny Freire
Author URI: http://freire-design.com
License: GPLv2
*/

add_shortcode( 'outofstock', 'outofstock_fn' );
add_shortcode( 'unavailable', 'unavailable_fn' );

function outofstock_fn( $attributes ) {
	
    return '<span class="oos">Out-of-stock, allow 4-6 weeks for delivery.</span>';
}

function unavailable_fn( $attributes ) {
	
    return '<div class="unavailable">Sorry, this item is unavailable. <img src="http://d1s11jhccim4uj.cloudfront.net/wp-content/uploads/2013/01/buy_now_paypal_disabled.png" /></div>';
}
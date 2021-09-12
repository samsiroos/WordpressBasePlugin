<?php
/**
 * @package  WordpressBasePlugin
 */

function test_shortcode ($atts){
    $attributes = shortcode_atts(
        array(
            'item' => '',
        ), 
        $atts,'test');
  $output = '';
  $output .= $atts['item'];
  
  return $output;
}

add_shortcode( 'test_shortcode', 'test' );

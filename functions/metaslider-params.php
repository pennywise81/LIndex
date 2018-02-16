<?php

/*
Sets the height to auto on Flexsliders

https://www.metaslider.com/documentation/metaslider_type_slider_parameters/
*/
function metaslider_flex_params($options, $slider_id, $settings) {
  $options['smoothHeight'] = true;

  return $options;
}
add_filter('metaslider_flex_slider_parameters', 'metaslider_flex_params', 10, 3);

function metaslider_change_image_url($local_url, $attachment_id) {
  $img = wp_get_attachment_image_src($attachment_id, 'header');
  $img_url = $img[0];

  return $img_url;
}
add_filter('metaslider_attachment_url', 'metaslider_change_image_url', 10, 2);
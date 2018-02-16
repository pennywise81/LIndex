<?php

add_filter('intermediate_image_sizes', function($sizes) {
  return array_filter($sizes, function($val) {
    return 'medium_large' !== $val;
  });
});

add_image_size('custom-xl', 1280, 960);
add_image_size('custom-xxl', 1600, 1200);
add_image_size('header', 1600, 686, true);
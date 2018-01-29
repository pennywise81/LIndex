<?php

add_filter('intermediate_image_sizes', function($sizes) {
  return array_filter($sizes, function($val) {
    return 'medium_large' !== $val;
  });
});
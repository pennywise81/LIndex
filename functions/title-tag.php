<?php

/*
This feature enables plugins and themes to manage the document title tag. This
should be used in place of wp_title() function.

https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
*/
add_theme_support('title-tag');

if (!function_exists('_wp_render_title_tag')) {
  function theme_slug_render_title() {
    ?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
  }

  add_action('wp_head', 'theme_slug_render_title');
}
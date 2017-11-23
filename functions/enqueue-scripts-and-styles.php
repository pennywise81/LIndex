<?php

/*
Enqueues all scripts and stylesheets
*/
function lindex_enqueue_scripts() {
  wp_enqueue_style('base', get_stylesheet_uri(), array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'lindex_enqueue_scripts');
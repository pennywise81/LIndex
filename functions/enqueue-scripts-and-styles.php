<?php

/*
Enqueues all scripts and stylesheets
*/
function lindex_enqueue_scripts() {
  // basic stylesheet
  wp_enqueue_style('base', get_stylesheet_uri(), array(), '1.0.0', 'all');

  // "Hamburgers" css; https://github.com/jonsuh/hamburgers
  wp_enqueue_style('hamburgers', get_template_directory_uri() . '/css/hamburgers.min.css', array('base'), '1.0.0', 'all');

  //  custom jquery
  wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.2.1', false);
  wp_enqueue_script('jquery');

  // menu
  wp_enqueue_script('menu', get_template_directory_uri() . '/js/menu.js', array('jquery'), '1.0.0', false);
}
add_action('wp_enqueue_scripts', 'lindex_enqueue_scripts');
<?php

/*
Enqueues all scripts and stylesheets
*/
function lindex_enqueue_scripts_and_styles() {

  /*
  Fluid typography definitions
  */
  wp_enqueue_style(
    'lindex-fluid-typography',
    get_template_directory_uri() . '/css/fluid-typography.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  Reset
  */
  wp_enqueue_style(
    'lindex-reset',
    get_template_directory_uri() . '/css/reset.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  Helping classes
  */
  wp_enqueue_style(
    'lindex-helping-classes',
    get_template_directory_uri() . '/css/helping-classes.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  Basic Layout
  */
  wp_enqueue_style(
    'lindex-basic-layout',
    get_template_directory_uri() . '/css/basic-layout.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  Grid definitons
  */
  wp_enqueue_style(
    'lindex-grid',
    get_template_directory_uri() . '/css/grid.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  Menu
  */
  wp_enqueue_style(
    'lindex-menu',
    get_template_directory_uri() . '/css/menu.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  "Hamburgers"

  https://github.com/jonsuh/hamburgers
  */
  wp_enqueue_style(
    'hamburgers',
    get_template_directory_uri() . '/css/hamburgers.min.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  Color definitions
  */
  wp_enqueue_style(
    'lindex-colors',
    get_template_directory_uri() . '/css/colors.css',
    array('hamburgers'),
    '1.0.0',
    'all'
  );

  /*
  Fonts
  */
  wp_enqueue_style(
    'webfonts',
    get_template_directory_uri() . '/css/fonts.css',
    array(),
    '1.0.0',
    'all'
  );

  /*
  All the other (custom) styles
  */
  wp_enqueue_style(
    'style',
    get_stylesheet_uri(),
    array(),
    '1.0.0',
    'all'
  );

  //  custom jquery
  wp_deregister_script('jquery');
  wp_register_script(
    'jquery',
    get_template_directory_uri() . '/js/jquery.min.js',
    array(),
    '3.2.1',
    false
  );
  wp_enqueue_script('jquery');

  // menu
  wp_enqueue_script(
    'menu',
    get_template_directory_uri() . '/js/menu.js',
    array('jquery'),
    '1.0.0',
    false
  );
}
add_action('wp_enqueue_scripts', 'lindex_enqueue_scripts_and_styles');
<?php

/*
Adds sidebar support
*/
function widgets_init() {
  register_sidebar(array(
  'name' => __('Globale Seitenleiste'),
    'id' => 'sidebar-global',
    'description' => __('Sidebar'),
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));
}

add_action('widgets_init', 'widgets_init');
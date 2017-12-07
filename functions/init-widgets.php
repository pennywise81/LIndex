<?php

/*
Adds sidebar support
*/
function widgets_init() {
  // Global Sidebar
  register_sidebar(
    array(
    'name' => __('Globale Seitenleiste'),
      'id' => 'sidebar-global',
      'description' => 'Sichtbar auf jeder Seite',
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    )
  );

  $pages = array();

  // add Homepage to pages
  $pages[] = array(
    'id' => 'homepage',
    'title' => __('Startseite')
  );

  // @TODO: more to come (search, archive, 404, ...)

  // determine all pages
  $tmp = get_pages(array(
    'post_type' => 'page',
    'post_status' => 'publish'
  ));
  foreach ($tmp as $page) {
    $pages[] = array(
      'id' => $page->ID,
      'title' => '"' . $page->post_title . '"'
    );
  }

  // register a sidebar for each page
  foreach ($pages as $page) {
    register_sidebar(
      array(
      'name' => __('Seitenleiste für ' . $page['title']),
        'id' => 'sidebar-page-' . $page['id'],
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
      )
    );
  }
}

add_action('widgets_init', 'widgets_init');
<?php

/**
Registers the custom post type for "Hersteller"

https://codex.wordpress.org/Function_Reference/register_post_type
*/

function init_posttype_hersteller() {
  $labels = array(
    'name' => 'Hersteller',
    'singular_name' => 'Hersteller',
    'menu_name' => 'Hersteller',
    'name_admin_bar' => 'Hersteller',
    'add_new' => 'Neu erstellen',
    'add_new_item' => 'Neuen Hersteller hinzufügen',
    'new_item' => 'Neuer Hersteller',
    'edit_item' => 'Hersteller bearbeiten',
    'view_item' => 'Hersteller ansehen',
    'all_items' => 'Alle Hersteller',
    'search_items' => 'Hersteller suchen',
    'not_found' => 'Kein Hersteller gefunden',
    'not_found_in_trash' => 'Kein Hersteller im Papierkorb gefunden'
 );

  $args = array(
    'labels' => $labels,
    'description' => 'Alle Fahrzeughersteller',
    'public' => false,
    'exclude_from_search' => true,
    'show_ui' => true,
    'menu_icon' => 'dashicons-admin-generic',
    'menu_position' => 5,
    'supports' => array('title', 'thumbnail')
 );

  register_post_type('manufacturer', $args);
}

add_action('init', 'init_posttype_hersteller');

/*
Backend-Table erweitern: Spalte(n) hinzufügen/entfernen
*/
function hersteller_custom_columns($columns) {
  // Datum entfernen
  unset($columns['date']);

  return $columns;
}
add_filter('manage_manufacturer_posts_columns', 'hersteller_custom_columns');
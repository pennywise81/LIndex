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
    'all_items' => 'Hersteller',
    'search_items' => 'Hersteller suchen',
    'not_found' => 'Kein Hersteller gefunden',
    'not_found_in_trash' => 'Kein Hersteller im Papierkorb gefunden',

    // "Featured Image" oder "Beitragsbild" umbenennen
    'featured_image' => 'Hersteller-Logo',
    'set_featured_image' => 'Logo festlegen',
    'remove_featured_image' => 'Logo löschen',
    'use_featured_image' => 'Logo verwenden',
 );

  $args = array(
    'labels' => $labels,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=vehicle',
    'menu_icon' => 'dashicons-admin-generic',
    'supports' => array('title', 'thumbnail'),

    /*
    Erlaubt das Anzeigen im Frontend
    */
    'publicly_queryable' => true,

    /*
    Erlaubt das Hinzufügen einzelner Hersteller zum (Frontend-) Menü
    */
    'show_in_nav_menus' => true,

    /*
    Erlaubt das Hinzufügen einer 'Archiv'-Seite zum (Frontend-) Menü
    */
    'has_archive' => true,
 );

  register_post_type('manufacturer', $args);
}

add_action('init', 'init_posttype_hersteller');

/*
Backend-Table erweitern: Spalte(n) hinzufügen/entfernen
*/
function hersteller_custom_columns($columns) {
  // Titel zwischenspeichern und entfernen
  $title = $columns['title'];
  unset($columns['title']);

  // Datum entfernen
  unset($columns['date']);

  // Logo
  $columns['logo'] = 'Logo';

  // Titel als 'Name'
  $columns['title'] = 'Name';

  return $columns;
}
add_filter('manage_manufacturer_posts_columns', 'hersteller_custom_columns');

/*
Backend-Table erweitern: Spalte(n) befüllen
*/
function hersteller_custom_columns_content($column_name, $post_ID) {
  if ($column_name == 'logo') {
    $logo = get_the_post_thumbnail($post_ID, array(50, 50));
    echo $logo;
  }
}
add_action('manage_manufacturer_posts_custom_column', 'hersteller_custom_columns_content', 10, 2);

/*
Spaltenbreite Logo setzen
*/
function hersteller_custom_columns_width() {
  if ((isset($_GET['post_type']) && $_GET['post_type'] == 'manufacturer') || (isset($post_type) && $post_type == 'manufacturer')) {
    echo '<style type="text/css">';
    echo '.column-logo { text-align: center; width:80px !important; overflow:hidden }';
    echo '</style>';
  }
}
add_action('admin_head', 'hersteller_custom_columns_width');
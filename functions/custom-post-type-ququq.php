<?php

/**
Registers the custom post type for "QUQUQ"

https://codex.wordpress.org/Function_Reference/register_post_type
*/

function init_posttype_ququq() {
  $labels = array(
    'name' => 'QUQUQ',
    'singular_name' => 'QUQUQ',
    'menu_name' => 'QUQUQ Boxen',
    'name_admin_bar' => 'QUQUQ Boxen',
    'add_new' => 'Neu erstellen',
    'add_new_item' => 'Neue QUQUQ Box hinzufügen',
    'new_item' => 'Neue QUQUQ Box',
    'edit_item' => 'QUQUQ Box bearbeiten',
    'view_item' => 'QUQUQ Box ansehen',
    'all_items' => 'Alle QUQUQ Boxen',
    'search_items' => 'QUQUQ Box suchen',
    'not_found' => 'Keine QUQUQ Box gefunden',
    'not_found_in_trash' => 'Keine QUQUQ Box im Papierkorb gefunden',

    // "Featured Image" oder "Beitragsbild" umbenennen
    'featured_image' => 'Produktbild',
    'set_featured_image' => 'Produktbild festlegen',
    'remove_featured_image' => 'Produktbild löschen',
    'use_featured_image' => 'Produktbild verwenden',
 );

  $args = array(
    'labels' => $labels,
    'show_ui' => true,
    'menu_icon' => 'dashicons-admin-generic',
    'menu_position' => 20,
    'supports' => array('title', 'thumbnail'),

    /*
    Erlaubt das Anzeigen im Frontend
    */
    'publicly_queryable' => true,

    /*
    Erlaubt das Hinzufügen einzelner QUQUQ zum (Frontend-) Menü
    */
    'show_in_nav_menus' => true,

    /*
    Erlaubt das Hinzufügen einer 'Archiv'-Seite zum (Frontend-) Menü
    */
    'has_archive' => true,
 );

  register_post_type('ququq', $args);
}

add_action('init', 'init_posttype_ququq');
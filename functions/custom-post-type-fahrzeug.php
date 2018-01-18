<?php

/**
Fügt den Custom Post Type "Fahrzeug" hinzu

https://codex.wordpress.org/Function_Reference/register_post_type
*/

function init_posttype_fahrzeug() {
  $labels = array(
    'name' => 'Fahrzeuge',
    'singular_name' => 'Fahrzeug',
    'menu_name' => 'Fahrzeuge',
    'name_admin_bar' => 'Fahrzeuge',
    'add_new' => 'Neu erstellen',
    'add_new_item' => 'Neues Fahrzeug hinzufügen',
    'new_item' => 'Neues Fahrzeug',
    'edit_item' => 'Fahrzeug bearbeiten',
    'view_item' => 'Fahrzeug ansehen',
    'all_items' => 'Fahrzeuge',
    'search_items' => 'Fahrzeug suchen',
    'not_found' => 'Kein Fahrzeug gefunden',
    'not_found_in_trash' => 'Kein Fahrzeug im Papierkorb gefunden'
 );

  $args = array(
    'labels' => $labels,
    'show_ui' => true,
    'menu_icon' => 'dashicons-admin-network',
    'menu_position' => 21,
    'register_meta_box_cb' => 'fahrzeug_metabox_hersteller',
    'supports' => array('title')
 );

  register_post_type('vehicle', $args);
}
add_action('init', 'init_posttype_fahrzeug');

/*
Metabox für Herstellerauswahl hinzufügen
*/
function fahrzeug_metabox_hersteller($post) {
  add_meta_box(
    'fahrzeug_hersteller',
    'Hersteller',
    'fahrzeug_metabox_hersteller_cb',
    'vehicle',
    'normal',
    'core'
  );
}
add_action('add_meta_boxes_place', 'fahrzeug_metabox_hersteller');

/*
Callback-Funktion für die Darstellung der Herstellerauswahl
*/
function fahrzeug_metabox_hersteller_cb($post) {
  $parents = get_posts(
    array(
      'post_type' => 'manufacturer',
      'orderby' => 'title',
      'order' => 'ASC',
      'numberposts' => -1
    )
  );

  if (!empty($parents)) {
    echo '<select name="parent_id" class="widefat">';
    echo '<option value="">Hersteller auswählen</option>';

    foreach ($parents as $parent) {
      printf('<option value="%s"%s>%s</option>', esc_attr($parent->ID), selected($parent->ID, $post->post_parent, false), esc_html($parent->post_title));
    }

    echo "</select>";
  }
}

/*
https://www.smashingmagazine.com/2013/12/modifying-admin-post-lists-in-wordpress/
*/

/*
Backend-Table erweitern: Spalte(n) hinzufügen/entfernen
*/
function fahrzeug_custom_columns($columns) {
  // Titel zwischenspeichern und entfernen
  $title = $columns['title'];
  unset($columns['title']);

  // Hersteller hinzufügen
  $columns['manufacturer_name'] = 'Hersteller';

  // Titel als 'Modell' wieder hinzufügen (nach 'Hersteller')
  $columns['title'] = 'Modell';

  // Datum entfernen
  unset($columns['date']);

  return $columns;
}
add_filter('manage_vehicle_posts_columns', 'fahrzeug_custom_columns');

/*
Backend-Table erweitern: Spalte(n) befüllen
*/
function fahrzeug_custom_columns_content($column_name, $post_ID) {
  if ($column_name == 'manufacturer_name') {
    $parent_ID = wp_get_post_parent_id($post_ID);

    if ($parent_ID) {
      $parent = get_post($parent_ID);
      echo $parent->post_title;
    }
    else {
      echo "<i>Kein Hersteller angegeben</i>";
    }
  }
}
add_action('manage_vehicle_posts_custom_column', 'fahrzeug_custom_columns_content', 10, 2);

/*
Spaltenbreite Hersteller setzen
*/
function vehicle_custom_columns_width() {
  if ((isset($_GET['post_type']) && $_GET['post_type'] == 'vehicle') || (isset($post_type) && $post_type == 'vehicle')) {
    echo '<style type="text/css">';
    echo '.column-manufacturer_name { width:100px !important; overflow:hidden }';
    echo '</style>';
  }
}
add_action('admin_head', 'vehicle_custom_columns_width');

// Sortierung in der Listview nach "Hersteller" ermöglichen
function vehicle_manage_sortable_columns($columns) {
   $columns['manufacturer_name'] = 'manufacturer_name';
   return $columns;
}
add_filter('manage_edit-vehicle_sortable_columns', 'vehicle_manage_sortable_columns');

// Query für Sortieren überarbeiten
function vehicle_posts_clauses($pieces, $query) {
  global $wpdb;

  if ($query->is_main_query() && ($orderby = $query->get('orderby'))) {
    $order = strtoupper($query->get('order'));

    if (! in_array($order, array('ASC', 'DESC'))) $order = 'ASC';

    switch($orderby) {
      case 'manufacturer_name':
        $pieces['join'] .= " LEFT JOIN $wpdb->posts pp ON pp.ID = {$wpdb->posts}.post_parent";
        $pieces['orderby'] = "pp.post_title $order, {$wpdb->posts}.post_title $order, " . $pieces['orderby'];
      break;
    }
  }

  return $pieces;
}
add_filter('posts_clauses', 'vehicle_posts_clauses', 1, 2);

// Standardsortierung setzen
function vehicle_default_order($query) {
  if ($query->get('post_type') == 'vehicle') {
    if ($query->get('orderby') == '') {
      $query->set('orderby', 'manufacturer_name');
    }

    if ($query->get('order') == '') {
      $query->set('order', 'ASC');
    }
  }
}
add_action('pre_get_posts', 'vehicle_default_order', 99);
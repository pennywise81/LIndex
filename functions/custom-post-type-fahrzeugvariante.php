<?php

/**
Fügt den Custom Post Type "Fahrzeugvariante" hinzu

https://codex.wordpress.org/Function_Reference/register_post_type
*/

function init_posttype_fahrzeugvariante() {
  $labels = array(
    'name' => 'Fahrzeugvarianten',
    'singular_name' => 'Fahrzeugvariante',
    'menu_name' => 'Fahrzeugvarianten',
    'name_admin_bar' => 'Fahrzeugvarianten',
    'add_new' => 'Neu erstellen',
    'add_new_item' => 'Neue Fahrzeugvariante hinzufügen',
    'new_item' => 'Neue Fahrzeugvariante',
    'edit_item' => 'Fahrzeugvariante bearbeiten',
    'view_item' => 'Fahrzeugvariante ansehen',
    'all_items' => 'Fahrzeugvarianten',
    'search_items' => 'Fahrzeugvariante suchen',
    'not_found' => 'Keine Fahrzeugvariante gefunden',
    'not_found_in_trash' => 'Keine Fahrzeugvariante im Papierkorb gefunden'
 );

  $args = array(
    'labels' => $labels,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=vehicle',
    'menu_icon' => 'dashicons-admin-network',
    'register_meta_box_cb' => 'variante_metabox_fahrzeug',
    'supports' => false
 );

  register_post_type('vehiclevariant', $args);
}
add_action('init', 'init_posttype_fahrzeugvariante');

/*
Metabox für Fahrzeugauswahl hinzufügen
*/
function variante_metabox_fahrzeug($post) {
  add_meta_box(
    'variante_fahrzeug',
    'Fahrzeug',
    'variante_metabox_fahrzeug_cb',
    'vehiclevariant',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes_place', 'variante_metabox_fahrzeug');

/*
CSS Klasse für die Fahrzeugauswahl-Metabox hinzufügen
*/
// function add_metabox_classes($classes) {
//   array_push($classes,'acf_postbox no_box');
//   return $classes;
// }
// add_filter('postbox_classes_vehiclevariant_variante_fahrzeug','add_metabox_classes');

/*
Callback-Funktion für die Darstellung der Fahrzeugauswahl
*/
function variante_metabox_fahrzeug_cb($post) {
  $parents = get_posts(
    array(
      'post_type' => 'vehicle',
      'orderby' => 'post_parent, title',
      'order' => 'ASC',
      'numberposts' => -1
    )
  );

  if (!empty($parents)) {

    // Fahrzeugvarianten ermitteln
    for ($i = 0; $i < count($parents); $i++) {
      // Fahrzeuge ohne Hersteller "ausfiltern"
      if ($parents[$i]->post_parent == '') continue;

      // Herstellername holen
      $parent_post = get_post($parents[$i]->post_parent);
      $hersteller = $parent_post->post_title;

      $parents[$i]->complete_modell = $hersteller . ' ' . $parents[$i]->post_title;
    }

    // Fahrzeuge nach Namen sortieren
    function sortByName($a, $b)
    {
        $a = $a->complete_modell;
        $b = $b->complete_modell;

        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
    }
    usort($parents, 'sortByName');

    // Dropdown darstellen
    echo '<select name="parent_id" class="widefat">';
    echo '<option value="">Fahrzeug auswählen</option>';
    foreach ($parents as $parent) {
      printf(
        '<option value="%s"%s>%s</option>',
        esc_attr($parent->ID),
        selected($parent->ID, $post->post_parent, false),
        esc_html($parent->complete_modell)
      );

      // echo "<pre>";
      // print_r($parent->ID .' ' . $post->post_parent .' ' . $parent->complete_modell);
      // echo "</pre>";
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
function variante_custom_columns($columns) {
  // Titel entfernen
  unset($columns['title']);

  // Fahrzeug hinzufügen
  $columns['vehicle'] = 'Fahrzeug';

  // Baujahr
  $columns['baujahr'] = 'Baujahr';

  // Rücksitzbank
  $columns['rucksitzbank'] = 'Rücksitzbank';

  // Radstand
  $columns['radstand'] = 'Radstand';

  // 3. Sitzreihe
  $columns['3_sitzreihe'] = '3. Sitzreihe';

  // 2. Sitzreihe
  $columns['2_sitzreihe'] = '2. Sitzreihe';

  // QUQUQ Version
  $columns['ququq_version'] = 'QUQUQ Version';

  // Titel als ''
  $columns['title'] = '';

  // Datum entfernen
  unset($columns['date']);

  return $columns;
}
add_filter('manage_vehiclevariant_posts_columns', 'variante_custom_columns');

/*
Backend-Table erweitern: Spalte(n) befüllen
*/
function variante_custom_columns_content($column_name, $post_ID) {
  if ($column_name == 'vehicle') {
    $parent_ID = wp_get_post_parent_id($post_ID);

    if ($parent_ID) {
      $parent = get_post($parent_ID);

      // Herstellername
      $hersteller = get_post($parent->post_parent);
      echo $hersteller->post_title . ' ';

      // Fahrzeugname
      echo $parent->post_title;
    }
    else {
      echo "<i style='color:red'>Kein Fahrzeug angegeben</i>";
    }
  }
  elseif ($column_name == 'baujahr') {
    echo get_field('baujahr', $post_ID);
  }
  elseif ($column_name == 'rucksitzbank') {
    echo get_field('rucksitzbank', $post_ID);
  }
  elseif ($column_name == 'radstand') {
    echo get_field('radstand', $post_ID);
  }
  elseif ($column_name == '2_sitzreihe') {
    echo get_field('2_sitzreihe', $post_ID);
  }
  elseif ($column_name == '3_sitzreihe') {
    echo get_field('3_sitzreihe', $post_ID);
  }
  elseif ($column_name == 'ququq_version') {
    echo get_field('ququq_version', $post_ID)->post_title;
  }
}
add_action('manage_vehiclevariant_posts_custom_column', 'variante_custom_columns_content', 10, 2);

/*
Style-Anpassungen für Fahrzeugvarianten-Übersicht
*/
function vehiclevariant_change_admin_styles() {
  if ((isset($_GET['post_type']) && $_GET['post_type'] == 'vehiclevariant') || (isset($post_type) && $post_type == 'vehiclevariant')) {
    echo '<style type="text/css">';

    // Breite der Funktionen setzen
    echo '.column-title { width:300px !important; overflow:hidden }';

    // Funktionen immer einblenden
    echo '.row-actions { position: static !important; }';

    // '(kein Titel)' ausblenden
    echo 'td.column-title strong { display: none !important; }';

    echo '</style>';
  }
}
add_action('admin_head', 'vehiclevariant_change_admin_styles');

// Sortierung in der Listview nach "Fahrzeug" ermöglichen
function vehiclevariant_manage_sortable_columns($columns) {
   $columns['vehicle'] = 'vehicle';
   return $columns;
}
add_filter('manage_edit-vehiclevariant_sortable_columns', 'vehiclevariant_manage_sortable_columns');

// Query für Sortieren überarbeiten
function vehiclevariant_posts_clauses($pieces, $query) {
  global $wpdb;

  if ($query->is_main_query() && ($orderby = $query->get('orderby'))) {
    $order = strtoupper($query->get('order'));

    if (! in_array($order, array('ASC', 'DESC'))) $order = 'ASC';

    switch($orderby) {
      case 'vehicle':
        $pieces['join'] .= " LEFT JOIN $wpdb->posts pp ON pp.ID = {$wpdb->posts}.post_parent";
        $pieces['join'] .= " LEFT JOIN $wpdb->posts pp2 ON pp2.ID = pp.post_parent";
        $pieces['orderby'] = "pp2.post_title $order, pp.post_title $order, " . $pieces['orderby'];
      break;
    }
  }

  return $pieces;
}
add_filter('posts_clauses', 'vehiclevariant_posts_clauses', 1, 2);

// Standardsortierung setzen
function vehiclevariant_default_order($query) {
  if ($query->get('post_type') == 'vehiclevariant') {
    if ($query->get('orderby') == '') {
      $query->set('orderby', 'vehicle');
    }

    if ($query->get('order') == '') {
      $query->set('order', 'ASC');
    }
  }
}
add_action('pre_get_posts', 'vehiclevariant_default_order', 99);
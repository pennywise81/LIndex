<?php

/**
Fügt den Custom Post Type "QUQUQ Variante" hinzu

https://codex.wordpress.org/Function_Reference/register_post_type
*/

function init_posttype_ququqvariant() {
  $labels = array(
    'name' => 'Box Versionen',
    'singular_name' => 'Box Version',
    'menu_name' => 'Box Versionen',
    'name_admin_bar' => 'Box Versionen',
    'add_new' => 'Neu erstellen',
    'add_new_item' => 'Neue Box Version hinzufügen',
    'new_item' => 'Neue Box Version',
    'edit_item' => 'Box Version bearbeiten',
    'view_item' => 'Box Version ansehen',
    'all_items' => 'Box Versionen',
    'search_items' => 'Box Version suchen',
    'not_found' => 'Keine Box Version gefunden',
    'not_found_in_trash' => 'Keine Box Version im Papierkorb gefunden'
 );

  $args = array(
    'labels' => $labels,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=ququq',
    'menu_icon' => 'dashicons-admin-network',
    'register_meta_box_cb' => 'variante_metabox_ququq',
    'supports' => array('title')
 );

  register_post_type('ququqvariant', $args);
}
add_action('init', 'init_posttype_ququqvariant');

/*
Metabox für QUQUQ Auswahl hinzufügen
*/
function variante_metabox_ququq($post) {
  add_meta_box(
    'variante_ququq',
    'QUQUQ Auswahl',
    'variante_metabox_ququq_cb',
    'ququqvariant',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes_place', 'variante_metabox_ququq');

/*
Callback-Funktion für die Darstellung der QUQUQ Auswahl
*/
function variante_metabox_ququq_cb($post) {
  $parents = get_posts(
    array(
      'post_type' => 'ququq',
      'orderby' => 'title',
      'order' => 'ASC',
      'numberposts' => -1
    )
  );

  if (!empty($parents)) {
    echo '<select name="parent_id" class="widefat">';
    echo '<option value="">QUQUQ auswählen</option>';

    foreach ($parents as $parent) {
      // Herstellername holen
      $parent_post = get_post($parent->post_parent);
      $hersteller = $parent_post->post_title;

      printf(
        '<option value="%s"%s>%s</option>',
        esc_attr($parent->ID),
        selected($parent->ID, $post->post_parent, false),
        esc_html($parent->post_title)
      );
    }

    echo "</select>";
  }
}
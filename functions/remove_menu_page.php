<?php

/**
Entfernt Admin Menü Einträge

https://codex.wordpress.org/Function_Reference/remove_menu_page
*/

function remove_menus() {
  /*
  Standard Menüs
  */
  // Dashboard
  remove_menu_page('index.php');

  // Jetpack*
  remove_menu_page('jetpack');

  // Posts
  // remove_menu_page('edit.php');

  // Media
  remove_menu_page('upload.php');

  // Pages
  // remove_menu_page('edit.php?post_type=page');

  // Comments
  remove_menu_page('edit-comments.php');

  // Appearance
  // remove_menu_page('themes.php');

  // Plugins
  remove_menu_page('plugins.php');

  // Users
  remove_menu_page('users.php');

  // Tools
  remove_menu_page('tools.php');

  // Settings
  remove_menu_page('options-general.php');

  /*
  Plugin-Menüs, CPTs
  */
  // Advanced Custom Fields
  remove_menu_page('edit.php?post_type=acf');

  // 'Neu Erstellen' in Fahrzeuge
  remove_submenu_page('edit.php?post_type=vehicle', 'post-new.php?post_type=vehicle');

  // 'Neu Erstellen' in QUQUQ
  remove_submenu_page('edit.php?post_type=ququq', 'post-new.php?post_type=ququq');
}
add_action('admin_init', 'remove_menus');

/*
Hiermit kann man Menü-Einträge debuggen
*/
function debug_admin_menu() {
  echo '<pre>' . print_r($GLOBALS['menu'], TRUE) . '</pre>';
}
// add_action('admin_init', 'debug_admin_menu');
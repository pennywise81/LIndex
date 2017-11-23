<?php

/*
Adds menus/menu-locations to the page
*/
function lindex_register_menus() {
  register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'lindex_register_menus');
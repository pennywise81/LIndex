<?php

/*
https://developer.wordpress.org/reference/classes/walker_nav_menu/
https://core.trac.wordpress.org/browser/tags/4.9/src/wp-includes/class-walker-nav-menu.php#L17
*/

class Ququq_Navigation_Walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    if ($item->object == 'ququq' && $depth == 0) {
      //
    }
    elseif ($item->object == 'ququq' && $depth != 0) {
      //
    }

    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';

    $output .= '<li' . $id . $class_names .'>';

    $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function end_el(&$output, $item, $depth = 0, $args = array()) {
    $output .= "</li>{$n}";
  }
}
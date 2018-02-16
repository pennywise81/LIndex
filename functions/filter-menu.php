<?php

function filter_menu($nav, $args) {
  // DOM-Objekt aus Nav-Markup erstellen
  $dom = new DOMDocument();
  $dom->loadHTML('<?xml encoding="utf-8" ?>' . $nav, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

  // Den spezifischen Node raussuchen ("QUQUQ")
  $parent = false;
  $all_items = $dom->getElementsByTagName('li');

  foreach ($all_items as $i) {
    $classes = explode(' ', $i->getAttribute('class'));
    if (in_array('boxmenu', $classes)) {
      $parent = $i;
      break;
    }
  }

  if ($parent) {
    // Neue CSS Klasse an den Node schreiben
    $cssClasses = $parent->getAttribute('class');
    $cssClasses = explode(' ', $cssClasses);
    $cssClasses[] = 'page__menu__item--has-fullsize-submenu';

    // Klasse "current-menu-parent" hinzufügen, wenn aktueller Menüpunkt
    if (in_array(get_post_type(), array('fahrzeug_hersteller', 'fahrzeug_modell', 'ququq_box'))) {
      $cssClasses[] = 'current-menu-parent';
    }
    $parent->setAttribute('class', implode(' ', $cssClasses));

    // Submenu raussuchen und löschen
    $child = $parent->getElementsByTagName('ul')->item(0);
    if ($child) {
      $parent->removeChild($child);
    }

    // Neues Submenu-Markup erstellen
    $additionalMenuMarkup  = '';
    $additionalMenuMarkup .= '<div class="page__menu__submenu--fullsize">';

    $additionalMenuMarkup .= '<div class="gridable--row">';
    $additionalMenuMarkup .= '<div class="gridable--col col-10">';

    /*
    $additionalMenuMarkup .= '<div class="manufacturers gridable--row">';

    // Alle Hersteller raussuchen
    $hersteller = get_posts(array(
      'post_type' => 'fahrzeug_hersteller',
      'post_status' => 'publish',
      'orderby' => 'title',
      'order' => 'ASC',
      'posts_per_page' => -1
    ));

    foreach ($hersteller as $h) {
      $logo = get_field('logo', $h->ID);

      $additionalMenuMarkup .= '<a href="' . get_post_permalink($h->ID) .
        '" class="manufacturer__icon-link gridable--col col-1-of-7 col-1-of-5-small"><img src="' . $logo . '"></a>';
    }

    $additionalMenuMarkup .= '</div>';
    */

    $additionalMenuMarkup .= '<div class="ququq-boxes gridable--row">';

    // Alle Boxen raussuchen
    $boxen = get_posts(array(
      'post_type' => 'ququq_box',
      'post_status' => 'publish',
      'orderby' => 'title',
      'order' => 'ASC',
      'posts_per_page' => -1
    ));

    foreach ($boxen as $b) {
      $thumb = get_the_post_thumbnail_url($b->ID, 'medium');

      $additionalMenuMarkup .= '<a href="' . get_post_permalink($b->ID) .
        '" class="ququq-box__icon-link gridable--col col-4"><img src="' . $thumb . '"><span>' .
        $b->post_title . '</span></a>';
    }

    $additionalMenuMarkup .= '</div>';
    $additionalMenuMarkup .= '</div>';
    $additionalMenuMarkup .= '</div>';

    // neues Submenu-Markup in DOM-Objekt umwandeln
    $additionalMenuDom = new DOMDocument();

    // set error level
    $internalErrors = libxml_use_internal_errors(true);
    $additionalMenuDom->loadHTML($additionalMenuMarkup, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    // Restore error level
    libxml_use_internal_errors($internalErrors);

    // Neues Submenu dem alten Markup hinzufügen ...
    $additionalMenuDomNode = $dom->importNode($additionalMenuDom->documentElement, true);

    // ... und an die richtige Stelle verschieben
    $parent->appendChild($additionalMenuDomNode);

    // Neues Markup in String umwandeln
    $newDom = $dom->saveHTML();

    // Neues Markup zurückliefern
    return $newDom;
  } else {
    return $nav;
  }
}
add_filter('wp_nav_menu_items','filter_menu', 10, 2);

/*
add_filter( 'nav_menu_link_attributes', 'menu_items', 10, 3 );
function menu_items( $atts, $item, $args )
{
  echo "<pre>";
  print_r($item);
  echo "</pre>";
  return $atts;
}
*/
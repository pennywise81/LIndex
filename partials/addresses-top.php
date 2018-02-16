<?php

// Hiermit holen wir uns alle möglichen Werte des Feldes (doof :/)
// https://support.advancedcustomfields.com/forums/topic/get-a-field-object-outside-of-the-post-context/
$laender_raw = get_field_object('field_5a67079b1ecfe');
$alle_laender = $laender_raw['choices'];
$dealer_type = 'h';
$current_language = pll_current_language();

if (is_page(array('vermietung', 'rental'))) {
  $dealer_type = 'v';
}

if ($current_language == 'en') {
  $alle_laender = array('gb' => $alle_laender['gb']) + $alle_laender;
}

/*
DEBUG
*/
if (get_field('debug', 'option')) {
  echo "<pre>";
  echo '  <span style="color:#ccc">$dealer_type: </span>'; print_r($dealer_type); echo "<br>";
  echo '  <span style="color:#ccc">$current_language: </span>'; print_r($current_language); echo "<br>";
  echo '  <span style="color:#ccc">$alle_laender: </span>'; print_r($alle_laender); echo "<br>";
  echo "  <br>";
  echo "</pre>";
}

echo '<div class="gridable--row">';
foreach ($alle_laender as $laendercode => $land) {
  $rows = get_posts(array(
    'post_type' => 'adresse',
    'posts_per_page' => -1,
    'meta_query' => array(
      array (
        'relation' => 'AND',
        'typ_clause' => array(
          'key' => 'typ',
          'value' => $dealer_type,
          'compare' => 'LIKE',
        ),
        'land_clause' => array(
          'key' => 'land',
          'value' => $laendercode,
        ),
      ),
      'ort_clause' => array(
        'key' => 'ort',
      ),
    ),
    'orderby' => array(
      'ort_clause' => 'ASC',
    ),
  ));

  if (count($rows) > 0) {
    echo '<div class="gridable--col col-3">';
    echo '  <a href="#country-' . $laendercode . '">' . pll__($land) . '</a>';
    echo '</div>';
  } else {
    continue;
  }
}
echo '</div>';

foreach ($alle_laender as $laendercode => $land) {
  $rows = get_posts(array(
    'post_type' => 'adresse',
    'posts_per_page' => -1,
    'meta_query' => array(
      array (
        'relation' => 'AND',
        'typ_clause' => array(
          'key' => 'typ',
          'value' => $dealer_type,
          'compare' => 'LIKE',
        ),
        'land_clause' => array(
          'key' => 'land',
          'value' => $laendercode,
        ),
      ),
      'ort_clause' => array(
        'key' => 'ort',
      ),
    ),
    'orderby' => array(
      'ort_clause' => 'ASC',
    ),
  ));

  if (count($rows) > 0) {
    echo '<h3 id="country-' . $laendercode . '">' . pll__($land) . '</h3>';
  } else {
    continue;
  }

  echo '<div class="gridable--row">';
  foreach ($rows as $r) {
    set_query_var('r', $r);
    get_template_part('partials/adresse');
  }
  echo '</div>';
}
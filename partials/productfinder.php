<?php

if (get_post_type() == 'fahrzeug_hersteller') {
  $fahrzeug_id = 0;
  $hersteller_id = get_the_ID();
} elseif (get_post_type() == 'fahrzeug_modell') {
  $fahrzeug_id = get_the_ID();
  $hersteller_id = get_field('hersteller', get_the_ID());
}

$alle_hersteller = Productfinder::getAllHersteller();
$fahrzeuge_to_hersteller_id = Productfinder::getFahrzeugeZuHerstellerId($hersteller_id);
$headerbild = get_field('headerbild', 'option');

// Selectbox für Hersteller zusammenbauen
$values = array();
foreach ($alle_hersteller as $h) {
  $values[] = array(
    'value' => $h->ID,
    'option' => $h->post_title,
    'additional_attributes' => array(
      'data-url' => get_post_permalink($h->ID),
    ),
  );
}
$select_hersteller = Productfinder::getSelect('hersteller', $values, $hersteller_id);

// Selectbox für Modelle zusammenbauen
$values = array();
foreach ($fahrzeuge_to_hersteller_id as $f) {
  $values[] = array(
    'value' => $f->ID,
    'option' => $f->post_title,
    'additional_attributes' => array(
      'data-url' => get_post_permalink($f->ID),
    ),
  );
}
$select_fahrzeuge = Productfinder::getSelect('fahrzeug', $values, $fahrzeug_id);

// Headerbild darstellen
if (!empty($headerbild)) {
  echo '</section>';
  echo '</main>';

  echo '<div class="breakout">';
  echo '  <img src="' . $headerbild . '">';
  echo '</div>';

  echo '<main class="page__main container container--maxwidth container--padded">';
  echo '<section class="page__content">';
}

?>

<div class="productfinder__searchform">
  <?php echo $select_hersteller; ?>
  <br>
  <?php echo $select_fahrzeuge; ?>
  <br>

  <?php

  if ($fahrzeug_id != 0) {
    $selects = array();

    while (have_rows('varianten')) {
      the_row();

      $auspraegungen = get_sub_field('auspraegungen');

      foreach ($auspraegungen as $a) {
        if (is_array($selects[$a['bezeichnung']])) {
          if (!in_array($a['wert'], $selects[$a['bezeichnung']])) {
            $selects[$a['bezeichnung']][] = $a['wert'];
          }
        } else {
          $selects[$a['bezeichnung']] = array('keine Auswahl', $a['wert']);
        }
      }

      /*
      echo "<pre>";
      print_r(get_sub_field('auspraegungen'));
      echo "</pre>";

      echo "<pre>";
      print_r(get_sub_field('ququq_version'));
      echo "</pre>";

      echo "<pre>";
      print_r(get_sub_field('galerie'));
      echo "</pre>";
      */
    }

    if (count($selects) > 0) {
      reset($selects);
      $first_key = key($selects);

      ?>

        <select class="variant-filters">
        <?php

        foreach ($selects[$first_key] as $o) {
          echo '<option value="' . $o . '">' . $first_key . ': ' . $o . '</option>';
        }

        ?>
        </select>

      <?php
    }
  }

  ?>

</div>
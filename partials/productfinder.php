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
$available_choices = array();
$possible_choices = array();
$sequence = array('bank', 'reihe_drei', 'reihe_zwei');
$url = get_post_permalink();

foreach ($sequence as $s) {
  ${$s} = (isset($_REQUEST[$s])) ? $_REQUEST[$s] : null;
}

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

  // alle Auswahlmöglichkeiten ermitteln
  if (have_rows('varianten')) {
    while (have_rows('varianten')) {
      the_row();

      foreach ($sequence as $s) {
        $fieldData = get_sub_field_object($s);
        $value = get_sub_field($s);

        if (array_key_exists($s, $possible_choices)) {
          if (!in_array($value, $possible_choices[$s]['choices'])) {
            $possible_choices[$s]['choices'][] = $value;
          }
        } else {
          $possible_choices[$s] = array(
            'choices' => array($value),
            'label' => $fieldData['label'],
            'choiceLabels' => $fieldData['choices'],
          );
        }
      }

    }
  }

  // noch mögliche Auswahlmöglichkeiten ermitteln
  if (have_rows('varianten')) {
    while (have_rows('varianten')) {
      the_row();

      foreach ($sequence as $s) {
        if (${$s} != null) {
          if (get_sub_field($s) != ${$s}) {
            continue;
          }
        } else {
          $value = get_sub_field($s);

          if (array_key_exists($s, $available_choices)) {
            if (!in_array($value, $available_choices[$s])) {
              $available_choices[$s][] = $value;
            }
          } else {
            $available_choices[$s] = array($value);
          }
        }
      }

    }
  }

  if (!empty($possible_choices['reihe_drei']) && count($possible_choices['reihe_drei']['choices']) >= 1) {
    $values = array();

    foreach ($possible_choices['reihe_drei']['choices'] as $c) {
      $values[] = array(
        'value' => $c,
        'option' => $possible_choices['reihe_drei']['choiceLabels'][$c],
        'additional_attributes' => array(
          'data-url' => $url . '?reihe_drei=' . $c,
        ),
      );
    }

    echo Productfinder::getSelect('reihe_drei', $values, $reihe_drei) . '<br>';
  }

  if ($reihe_drei != null || count($possible_choices['reihe_drei']['choices']) <= 1) {
    if (!empty($possible_choices['reihe_zwei']) && count($possible_choices['reihe_zwei']['choices']) >= 1) {
      $values = array();

      foreach ($available_choices['reihe_zwei'] as $c) {
        $values[] = array(
          'value' => $c,
          'option' => $possible_choices['reihe_zwei']['choiceLabels'][$c],
          'additional_attributes' => array(
            'data-url' => $url . '?reihe_zwei=' . $c,
          ),
        );
      }

      echo Productfinder::getSelect('reihe_zwei', $values, $reihe_zwei) . '<br>';
    }
  }

  echo "<pre>";
  print_r($possible_choices);
  print_r($available_choices);
  echo "</pre>";

  /*
  for ($i = 0; $i < count($sequence); $i++) {
    $s = $sequence[$i];

    if (count($possible_choices[$s]['choices']) <= 1) {
      continue;
    }

    // if (${$s} == null) {
      $values = array();

      foreach ($possible_choices[$s]['choices'] as $c) {
        // if (!in_array($c, $available_choices)) {
        //   continue;
        // }

        // $url_t = $url . '?' . implode('&', $url_params);
        $url_t = $url . '?' . $s . '=' . $c;

        $values[] = array(
          'value' => $c,
          'option' => $possible_choices[$s]['label'] . ' = ' . $possible_choices[$s]['choiceLabels'][$c],
          'additional_attributes' => array(
            'data-url' => $url_t,
          ),
        );
      }

      echo Productfinder::getSelect($s, $values, ${$s}) . '<br>';
    // } else {}

  }
  */

  ?>
</div>

<?php

?>
<?php

// Ajax preparation
// Ajax preparation END

$hersteller_id = get_the_ID();
$fahrzeug_id = !empty($_REQUEST['fahrzeug_id']) ? $_REQUEST['fahrzeug_id'] : 0;

$hersteller = get_posts(
  array(
    'post_type' => 'manufacturer',
    'orderby' => 'title',
    'post_status' => 'publish',
    'order' => 'ASC',
    'numberposts' => -1
  )
);

$fahrzeuge_to_hersteller = get_posts(
  array(
    'post_type' => 'vehicle',
    'orderby' => 'title',
    'post_status' => 'publish',
    'post_parent' => $hersteller_id,
    'order' => 'ASC',
    'numberposts' => -1
  )
);

echo "<pre>";
print_r($hersteller_id . ', ' . $fahrzeug_id);
echo "</pre>";

?>

<div class="searchform">
  <select name="hersteller" class="select-hersteller">
    <?php

    foreach ($hersteller as $h) {
      echo '<option value="' . $h->ID . '"';
      echo ($hersteller_id == $h->ID ? ' selected' : '');
      echo ' data-url="' . get_permalink($h->ID) . '"';
      echo '>' . $h->post_title . '</option>';
    }

    ?>
  </select>
  <br>
  <select name="fahrzeug" class="select-fahrzeug">
    <option value="">Bitte auswählen</option>
    <?php

    foreach ($fahrzeuge_to_hersteller as $f) {
      echo '<option data-url="' . get_permalink($hersteller_id) .
        '?fahrzeug_id=' . $f->ID . '"';
      echo ($fahrzeug_id == $f->ID ? ' selected' : '');
      echo '>' . $f->post_title . '</option>';
    }

    ?>
  </select>
  <br>
  <?php

  if ($fahrzeug_id != 0) {
    $varianten = get_posts(
      array(
        'post_type' => 'vehiclevariant',
        'orderby' => 'title',
        'post_status' => 'publish',
        'post_parent' => $fahrzeug_id,
        'order' => 'ASC',
        'numberposts' => -1
      )
    );

    if (count($varianten) == 1) {
      // wir sind schon da ...
      $ququq_version = get_field('ququq_version', $varianten[0]->ID);
      $ququq = get_post($ququq_version->post_parent);
    }
    else {
      $choices = array(
        'radstand',
        '2_sitzreihe',
        '3_sitzreihe',
        // 'ququq_version'
      );

      $varianten_filtered = array();
      foreach ($varianten as $v) {
        echo "<pre>";
        print_r('Variante-ID: ' . $v->ID);
        echo "</pre>";
        foreach ($choices as $c) {
          $field = get_field_object($c, $v->ID);
          echo "<pre>";
          print_r($field['label'] . ': ' . $field['value']);
          echo "</pre>";
        }
        echo "<br>";
      }

      /*
      $values = array();
      foreach ($varianten as $v) {
        $tmp = get_field_objects($v->ID);

        foreach ($tmp as $t) {
          if (!in_array($t['name'], $choices)) continue;

          if (array_key_exists($t['name'], $values)) {
            if (!in_array($t['value'], $values[$t['name']])) {
              $values[$t['name']][] = $t['value'];
            }
          }
          else {
            $values[$t['name']] = array($t['value']);
          }
        }
      }
      echo "<pre>";
      print_r($values);
      echo "</pre>";
      */

    }
  }


  ?>
</div>
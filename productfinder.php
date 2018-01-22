<?php

// Ajax preparation
// Ajax preparation END

$hersteller_id = get_the_ID();
$fahrzeug_id = !empty($_REQUEST['fahrzeug_id']) ? $_REQUEST['fahrzeug_id'] : 0;
$radstand = !empty($_REQUEST['radstand']) ? $_REQUEST['radstand'] : '';
$sitzreihe3 = !empty($_REQUEST['3_sitzreihe']) ? $_REQUEST['3_sitzreihe'] : '';
$sitzreihe2 = !empty($_REQUEST['2_sitzreihe']) ? $_REQUEST['2_sitzreihe'] : '';

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
      echo '<option value="' . $f->ID . '"';
      echo ' data-url="' . get_permalink($hersteller_id) .
        '?fahrzeug_id=' . $f->ID . '"';
      echo ($fahrzeug_id == $f->ID ? ' selected' : '');
      echo '>' . $f->post_title . '</option>';
    }

    ?>
  </select>
  <br>
  <?php

  /*
  if ($fahrzeug_id != 0) {

    $tmp = get_posts(
      array(
        'post_type' => 'vehiclevariant',
        'orderby' => 'title',
        'post_status' => 'publish',
        'post_parent' => $fahrzeug_id,
        'order' => 'ASC',
        'numberposts' => -1
      )
    );
    $varianten = array();

    $fields = array(
      'radstand' => array(),
      '3_sitzreihe' => array(),
      '2_sitzreihe' => array()
    );

    foreach ($tmp as $t) {
      $varianten[$t->ID] = array('id' => $t->ID);

      foreach ($fields as $f => $values) {
        $field = get_field_object($f, $t->ID);

        if ($field['value'] != '') {
          $varianten[$t->ID][$field['name']] = $field['value'];
        }
      }
    }

    echo "<pre>";
    print_r($varianten);
    echo "</pre>";

  }
  */


  ?>
</div>
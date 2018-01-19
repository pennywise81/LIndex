<?php

$hersteller_selected = get_the_ID();

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
    'post_parent' => $hersteller_selected,
    'order' => 'ASC',
    'numberposts' => -1
  )
);

/*
echo "<pre>";
print_r($hersteller);
echo "</pre>";

echo "<pre>";
print_r($hersteller_selected);
echo "</pre>";

echo "<pre>";
print_r($fahrzeuge_to_hersteller);
echo "</pre>";
*/

?>

<div class="searchform">
  <select name="hersteller">
    <?php

    foreach ($hersteller as $h) {
      echo '<option value="' . $h->ID . '"';
      echo ($hersteller_selected == $h->ID ? ' selected' : '');
      echo '>' . $h->post_title . '</option>';
    }

    ?>
  </select>
  <select name="fahrzeug">
    <option value="">Bitte auswählen</option>
    <?php

    foreach ($fahrzeuge_to_hersteller as $f) {
      echo '<option value="' . $f->ID . '"';
      // echo ($hersteller_selected == $h->ID ? ' selected' : '');
      echo '>' . $f->post_title . '</option>';
    }

    ?>
  </select>
</div>
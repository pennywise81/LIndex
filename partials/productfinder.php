<?php

$hersteller_id = get_the_ID();
$alle_hersteller = Productfinder::getAllHersteller();
$fahrzeuge_to_hersteller_id = Productfinder::getFahrzeugeZuHerstellerId($hersteller_id);

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
$select_fahrzeuge = Productfinder::getSelect('fahrzeuge', $values);

?>

<div class="searchform">
  <?php echo $select_hersteller; ?>
  <br>
  <?php echo $select_fahrzeuge; ?>
  <br>
</div>

<?php

?>
<?php

wp_enqueue_script(
  'productfinder',
  get_template_directory_uri() . '/js/productfinder.js',
  array('jquery'),
  '1.0.0',
  false
);

wp_localize_script('productfinder', 'productfinder', array('url' => admin_url('admin-ajax.php')));

/*
Holt alle Fahrzeuge zu bestimmten Hersteller
*/
add_action("wp_ajax_changedManufacturer", "changedManufacturer");
add_action("wp_ajax_nopriv_changedManufacturer", "changedManufacturer");
function changedManufacturer() {
  $hersteller_id = $_REQUEST["herstellerId"];

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

  echo json_encode($fahrzeuge_to_hersteller);

  die();
}

/*
tja ... ?
*/
add_action("wp_ajax_changedVehicle", "changedVehicle");
add_action("wp_ajax_nopriv_changedVehicle", "changedVehicle");
function changedVehicle() {
  $fahrzeug_id = $_REQUEST["fahrzeugId"];

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

  if (count($tmp) == 1) {
    // Bei nur einem Ergebnis wird sofort die Q-ID zurückgegeben
    echo json_encode(array(array('id' => $tmp[0]->ID)));
  } else {
    $fields = array(
      'radstand',
      '3_sitzreihe',
      '2_sitzreihe',
    );
  }

  die();
}

/*
{
  'status': 'end' | 'not_end',
  'items': []
}
*/
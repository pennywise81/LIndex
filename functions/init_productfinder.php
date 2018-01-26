<?php

wp_enqueue_script(
  'productfinder',
  get_template_directory_uri() . '/js/productfinder.js',
  array('jquery'),
  '1.0.0',
  false
);
wp_localize_script('productfinder', 'productfinder', array('url' => admin_url('admin-ajax.php')));

add_action("wp_ajax_changedManufacturer", array('Productfinder', 'ajaxHerstellerGewechselt'));
add_action("wp_ajax_nopriv_changedManufacturer", array('Productfinder', 'ajaxHerstellerGewechselt'));

add_action("wp_ajax_changedVehicle", array('Productfinder', 'ajaxFahrzeugGewechselt'));
add_action("wp_ajax_nopriv_changedVehicle", array('Productfinder', 'ajaxFahrzeugGewechselt'));
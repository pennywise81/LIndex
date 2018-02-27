<?php

function enqueue_productfinder() {
  wp_enqueue_script(
    'productfinder',
    get_template_directory_uri() . '/js/productfinder.js',
    array('jquery'),
    '1.0.0',
    false
  );

  wp_localize_script('productfinder', 'productfinder', array('url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_productfinder');

add_action("wp_ajax_herstellerGewechselt", array('Productfinder', 'ajaxSelectHersteller'));
add_action("wp_ajax_nopriv_herstellerGewechselt", array('Productfinder', 'ajaxSelectHersteller'));

add_action("wp_ajax_fahrzeugGewechselt", array('Productfinder', 'ajaxSelectFahrzeug'));
add_action("wp_ajax_nopriv_fahrzeugGewechselt", array('Productfinder', 'ajaxSelectFahrzeug'));

add_action("wp_ajax_variant_changed", array('Productfinder', 'ajax_variant_changed'));
add_action("wp_ajax_nopriv_variant_changed", array('Productfinder', 'ajax_variant_changed'));
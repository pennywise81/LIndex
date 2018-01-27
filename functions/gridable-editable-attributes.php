<?php

add_filter('gridable_row_options', function ($options) {
  // $options['bg_color'] = array(
  //   'type' => 'color',
  //   'label' => 'Row Background Color',
  //   'default' => 'transparent'
  // );

  // $options['stretch'] = array(
  //   'type' => 'checkbox',
  //   'label' => 'Is stretched?',
  //   'default' => 0
  // );

  // $options['title'] = array(
  //   'label' => 'Maybe a row title',
  // );

  return $options;
});


add_filter('gridable_column_options', function ($options) {
  // $options['bg_color'] = array(
  //   'type' => 'color',
  //   'label' => 'Column Background Color',
  //   'default' => 'transparent'
  // );

  // $options['custom_checked_attribute'] = array(
  //   'type' => 'checkbox',
  //   'label' => 'On or off?',
  //   'default' => 0
  // );

  // $options['selector'] = array(
  //   'label' => 'A Select attribute',
  //   'type' => 'select',
  //   'options' => array(
  //     'option1' => 'First Option',
  //     'option2' => 'Second',
  //     'option3' => 'Enough'
  //   ),
  //   'default' => 'option1'
  // );

  return $options;
});
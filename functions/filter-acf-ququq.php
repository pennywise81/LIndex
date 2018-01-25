<?php

function my_acf_load_field($field) {
  $field['choices'] = array(
    '' => 'keine Auswahl'
  );

  $rows = get_posts(array(
    'post_type' => 'ququq_box',
    'posts_per_page' => -1,
  ));

  foreach ($rows as $r) {
    $versionen = get_field('versionen', $r->ID);

    if (is_array($versionen)) {
      foreach ($versionen as $v) {
        $field['choices'][$v['name']] = $v['name'];
      }
    }
    else {
      $field['choices'][$r->ID] = $r->post_title;
    }
  }

  return $field;
}
add_filter('acf/load_field/name=ququq_version', 'my_acf_load_field');
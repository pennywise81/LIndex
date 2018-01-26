<?php

class Productfinder {
  public static function ajaxHerstellerGewechselt() {
    $hersteller_id = $_REQUEST["herstellerId"];
    $fahrzeuge_to_hersteller = self::getFahrzeugeZuHerstellerId($hersteller_id);

    echo json_encode($fahrzeuge_to_hersteller);

    die();
  }

  public static function ajaxFahrzeugGewechselt() {
    $fahrzeug_id = $_REQUEST["fahrzeugId"];

    echo json_encode('irgendwas passiert hier');

    die();
  }

  public static function getAllHersteller() {
    return get_posts(
      array(
        'post_type' => 'fahrzeug_hersteller',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
      )
    );
  }

  public static function getFahrzeugeZuHerstellerId($hersteller_id) {
    return get_posts(
      array(
        'post_type' => 'fahrzeug_modell',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_key' => 'hersteller',
        'meta_value' => $hersteller_id,
        'meta_compare' => '=',
      )
    );
  }

  /**
  * $values = array(array(value, option, additional_attributes = array()))
  **/
  public static function getSelect($name = 'name', $values = array(), $value_selected = 0) {
    $return = '';

    $return .= '<select name="' . $name . '" class="select-' . $name . '">';

    foreach ($values as $v) {
      $return .= '';
      $return .= '<option value="' . $v['value'] . '" ';
      foreach ($v['additional_attributes'] as $attr => $attr_value) {
        $return .= $attr . '="' . $attr_value . '" ';
      }
      $return .= ($v['value'] == $value_selected) ? 'selected' : '';
      $return .= '>';
      $return .= $v['option'];
      $return .= '</option>';
    }

    $return .= '</select>';

    return $return;
  }
}
<?php

class Productfinder {
  public static $sequence = array(
    'bank',
    'reihe_drei',
    'reihe_zwei',
  );

  public static function ajaxSelectHersteller() {
    $hersteller_id = $_REQUEST["h_id"];
    $fahrzeuge_to_hersteller = self::getFahrzeugeZuHerstellerId($hersteller_id);

    echo json_encode($fahrzeuge_to_hersteller);
    die();
  }

  public static function ajaxSelectFahrzeug() {
    $fahrzeug_id = $_REQUEST["f_id"];
    $varianten = get_field('varianten', $fahrzeug_id);
    $output = '';

    if (count($varianten) == 0) {
      $output = 'Keine Box gefunden';
    } elseif (count($varianten) == 1) {
      $output = self::getBoxData($varianten[0]['ququq_version']);
    } else {
      $choices = array();

      foreach ($varianten as $v) {
        foreach (self::$sequence as $s) {
          if (is_array($choices[$s])) {
            if (!in_array($v[$s], $choices[$s])) {
              $choices[$s][] = $v[$s];
            }
          } else {
            $choices[$s] = array($v[$s]);
          }
        }
      }

      foreach ($choices as $c => $options) {
        if (count($options) <= 1) {
          continue;
        } else {
          $field_data = the_sub_field($c, $fahrzeug_id);
          $output = $field_data;
        }
      }
    }

    echo json_encode($output);
    die();
  }

  public static function ajax_variant_changed() {
    echo json_encode('hans');

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

  public static function getBoxData($box_id) {
    return "Detaildaten";
  }

  /**
  * $values = array(array(value, option, additional_attributes = array()))
  **/
  public static function getSelect($name = 'name', $values = array(), $value_selected = 0) {
    $return = '';

    $return .= '<select name="' . $name . '" class="select-' . $name . '">';
    $return .= '<option value="">Bitte auswählen</option>';

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
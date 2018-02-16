<?php

$post_id = get_the_ID();
$headerbild = get_field('headerbild', $post_id);
$slider = get_field('slider', $post_id);

if (!empty($slider) || !empty($headerbild)) {
  echo '</section>';
  echo '</main>';

  echo '<div class="breakout">';

  if (!empty($slider)) {
    echo do_shortcode('[metaslider id="' . $slider . '"]');
  }
  elseif (!empty($headerbild)) {
    echo '  <img src="' . $headerbild['sizes']['header'] . '">';
  }

  echo '</div>';

  echo '<main class="page__main container container--maxwidth container--padded">';
  echo '<section class="page__content">';
}

?>
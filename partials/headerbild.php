<?php

$headerbild = get_field('headerbild', get_the_ID());

if (!empty($headerbild)) {
  echo '</section>';
  echo '</main>';

  echo '<div class="breakout">';
  echo '  <img src="' . $headerbild . '">';
  echo '</div>';

  echo '<main class="page__main container container--maxwidth container--padded">';
  echo '<section class="page__content">';
}

?>
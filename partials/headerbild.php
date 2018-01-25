<?php

$headerbild = get_field('headerbild', get_the_ID());

if (!empty($headerbild)) {
  echo '<div class="breakout">';
  echo '  <img src="' . $headerbild . '">';
  echo '</div>';
}

?>
<!-- loop.php -->
<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();

    $item_id = get_the_ID();
    $content_width = get_field('content_width');
    $show_title = get_field('show_title');
    $show_image = get_field('beitragsbild_anzeigen')  && has_post_thumbnail();
    $thumbnail_position = get_field('position_beitragsbild');
    $title_position = get_field('title_position');
    $post_thumbnail = get_the_post_thumbnail_url();

    /*
    DEBUG
    */
    if (get_field('debug', 'option')) {
      echo "<pre>";
      echo '  <span style="color:#ccc">$item_id: </span>'; print_r($item_id); echo "<br>";
      echo '  <span style="color:#ccc">$content_width: </span>'; print_r($content_width); echo "<br>";
      echo '  <span style="color:#ccc">$show_title: </span>'; print_r($show_title); echo "<br>";
      echo '  <span style="color:#ccc">$show_image: </span>'; print_r($show_image); echo "<br>";
      echo '  <span style="color:#ccc">$thumbnail_position: </span>'; print_r($thumbnail_position); echo "<br>";
      echo '  <span style="color:#ccc">$title_position: </span>'; print_r($title_position); echo "<br>";
      echo '  <span style="color:#ccc">$post_thumbnail: </span>'; print_r($post_thumbnail); echo "<br>";
      echo "  <br>";
      echo "</pre>";
    }

    if ($content_width == 'two_thirds') {
      echo '<div class="gridable--row">';
      echo '<div class="gridable--col col-8">';
    }

    get_template_part('partials/loop', 'top');

    if ($show_title && ($title_position == 'top' || $title_position == '')) {
      echo '<h1>' . get_the_title() . '</h1>';
    }

    if ($show_image) {
      if ($thumbnail_position == 'top') {
        echo "<img src=\"$post_thumbnail\">";
      } else {
        echo '<div class="gridable--row">';

        if ($thumbnail_position == 'left') {
          echo '<div class="gridable--col col-8">';
          echo "<img src=\"$post_thumbnail\">";
          echo '</div>'; // ".gridable--col.col-8" schließen
          echo '<div class="gridable--col col-4">';
        } else {
          echo '<div class="gridable--col col-4">';
        }
      }
    }

    if ($show_title && $title_position == 'bottom') {
      echo '<h1>' . get_the_title() . '</h1>';
    }
    the_content();

    if ($show_image) {
      if ($thumbnail_position == 'left') {
        echo "</div>"; // ".gridable--col.col-4" schließen
      } elseif ($thumbnail_position == 'right') {
        echo "</div>"; // ".gridable--col.col-4" schließen
        echo '<div class="gridable--col col-8">';
        echo "<img src=\"$post_thumbnail\">";
        echo '</div>'; // ".gridable--col.col-8" schließen
      }
    }

    echo '</div>'; // '<div>' aus loop-top.php schließen

    if ($content_width == 'two_thirds') {
      echo '</div>'; // ".gridable--row" schließen
      echo '</div>'; // ".gridable--col.col-8" schließen
    }
  }
}

?>
<!-- /loop.php -->
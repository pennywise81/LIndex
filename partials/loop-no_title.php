<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();

    get_template_part('partials/loop', 'top');

    ?>
      <?php the_content(); ?>
    </div>

    <?php
  }
}

?>
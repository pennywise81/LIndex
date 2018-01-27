<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();

    get_template_part('partials/loop', 'top');

    ?>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <?php

      $current_language = pll_current_language();

      if ($current_language == 'en') {
        the_content('Read on');
      }
      // elseif here for more languages
      // [ ... ]

      // Fallback and German
      else {
        the_content('Weiterlesen');
      }

      ?>

    </div>

    <?php
  }
}

?>
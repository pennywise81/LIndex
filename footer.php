<!-- footer.php -->
  </main>
  <footer class="page__footer container container--maxwidth">
    <div class="page__footer__recent-posts grid__row">
      <?php

      $current_language = pll_current_language();
      $current_language_categories = array();

      // "Messe" (4), "News" (5), "[EN] Messe" (36), "[EN] News" (40)
      if ($current_language == 'de') {
        $current_language_categories = array(4, 5);
      } elseif ($current_language == 'en') {
        $current_language_categories = array(36, 40);
      }

      $recent_posts = get_posts(
        array(
          'post_type' => 'post',
          'numberposts' => 3,
          'lang' => $current_language,
          'category__in' => $current_language_categories,
        )
      );

      foreach ($recent_posts as $p) {
        $link = get_permalink($p->ID);

        echo '<a href="' . $link . '" ';
        echo 'class="page__footer__recent-posts--post grid__box--one-third" ';

        if (has_post_thumbnail($p->ID)) {
          $img = get_the_post_thumbnail_url($p->ID);
          echo 'style="background-image:url(' . $img . ')" ';
        }

        echo '>';

        /*
        echo "<pre>";
        print_r(get_the_category($p->ID));
        echo "</pre>";
        */

        echo $p->post_title;

        echo '</a>';
      }

      ?>
    </div>
    <div class="inner">
      <?php

      if (is_active_sidebar('widgets-footer')) {
        dynamic_sidebar('widgets-footer');
      }

      if (get_theme_mod('lindex_copyright') !== false) {
        echo '<div class="page__footer__copyright">' . get_theme_mod('lindex_copyright') . '</div>';
      }

    ?>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
<!-- /footer.php -->
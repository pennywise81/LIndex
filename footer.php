<!-- footer.php -->
  </main>
  <footer class="page__footer container container--maxwidth">
    <div class="page__footer__recent-posts grid__row">
      <?php

      $current_language = pll_current_language();

      $recent_posts = get_posts(
        array(
          'post_type' => 'post',
          'lang' => $current_language,
          'numberposts' => 3
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
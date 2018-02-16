<!-- footer.php -->
  </main>
  <footer class="page__footer container container--maxwidth">
    <div class="page__footer__recent-posts">
      <div class="gridable gridable--row">
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
          $cat = get_the_category($p->ID);

          if (isset($cat[0])) {
            if ($cat[0]->slug == 'news') {
              $link = '/news/#post-' . $p->ID;
            } elseif ($cat[0]->slug == 'messe') {
              $link = '/news/messen/#post-' . $p->ID;
            } elseif ($cat[0]->slug == 'news-en') {
              $link = '/news-english/#post-' . $p->ID;
            } elseif ($cat[0]->slug == 'fair') {
              $link = '/news-english/fairs/#post-' . $p->ID;
            }
          }

          echo '<div class="page__footer__recent-posts--post gridable--col col-4">';
          echo '<a href="' . $link . '" ';

          if (has_post_thumbnail($p->ID)) {
            $img = get_the_post_thumbnail_url($p->ID);
            echo 'style="background-image:url(' . $img . ')" ';
          }

          echo '>';

          echo $p->post_title;

          echo '</a>';
          echo '</div>';
        }

        ?>
      </div>
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
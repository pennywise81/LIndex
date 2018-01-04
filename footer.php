<!-- footer.php -->
  </main>
  <footer class="page__footer">
    <?php

    if (is_active_sidebar('widgets-footer')) {
      dynamic_sidebar('widgets-footer');
    }

    if (get_theme_mod('lindex_copyright') !== false) {
      echo '<div class="page__footer__copyright">' . get_theme_mod('lindex_copyright') . '</div>';
    }

    ?>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
<!-- /footer.php -->
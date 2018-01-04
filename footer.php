<!-- footer.php -->
  </main>
  <footer class="page__footer container container--maxwidth">
    <div class="inner">
      <?php

      if (is_active_sidebar('widgets-footer')) {
        dynamic_sidebar('widgets-footer');
      }

      ?>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
<!-- /footer.php -->
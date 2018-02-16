<!-- index.php -->
<?php get_header(); ?>

<section class="page__content">
  <?php get_template_part('partials/headerbild'); ?>
  <?php get_template_part('partials/loop'); ?>

  <?php

  // Für Händler/Vermietung
  if (is_page(array('haendler', 'vermietung', 'dealer', 'rental'))) {
    get_template_part('partials/addresses', 'top');
  }

  ?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /index.php -->
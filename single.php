<!-- index.php -->
<?php get_header(); ?>

<section class="page__content">
  <?php get_template_part('partials/loop', 'single'); ?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /index.php -->
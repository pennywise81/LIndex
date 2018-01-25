<!-- category-videos.php -->
<?php get_header(); ?>

<section class="page__content">
  <h1><?php single_cat_title(); ?></h1>
  <?php get_template_part('partials/loop', 'post_excerpt'); ?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /category-videos.php -->
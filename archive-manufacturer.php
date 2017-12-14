<!-- archive-manufacturer.php -->
<?php get_header(); ?>

<section class="content">
  <h1>Alle Hersteller</h1>
<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();
    ?>

    <h3><?php the_title(); ?></h3>

    <?php the_content(); ?>

    <?php
  }
}

?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /archive-manufacturer.php -->
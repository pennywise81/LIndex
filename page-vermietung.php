<!-- index.php -->
<?php get_header(); ?>

<section class="page__content">
  <?php get_template_part('partials/loop', 'no_title'); ?>

  <?php

// Hiermit holen wir uns alle möglichen Werte des Feldes 'Land' (doof, aber geht erstmal nicht anders :/)
// https://support.advancedcustomfields.com/forums/topic/get-a-field-object-outside-of-the-post-context/
$laender = get_field_object('field_5a67079b1ecfe');

foreach ($laender['choices'] as $laendercode => $land) {
  $rows = get_posts(array(
    'post_type' => 'adresse',
    'posts_per_page' => -1,
    'meta_query' => array(
      array (
        'relation' => 'AND',
        'typ_clause' => array(
          'key' => 'typ',
          'value' => 'v',
          'compare' => 'LIKE',
        ),
        'land_clause' => array(
          'key' => 'land',
          'value' => $laendercode,
        ),
      ),
      'ort_clause' => array(
        'key' => 'ort',
      ),
    ),
    'orderby' => array(
      'ort_clause' => 'ASC',
    ),
  ));

  if (count($rows) > 0) {
    echo "<h3>$land</h3>";
  } else {
    continue;
  }

  foreach ($rows as $r) {
    set_query_var('r', $r);
    get_template_part('partials/adresse');
  }
}

?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /index.php -->
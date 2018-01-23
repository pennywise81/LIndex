<!-- index.php -->
<?php get_header(); ?>

<section class="page__content">
<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();
    ?>

    <?php the_content(); ?>

    <?php
  }
}

// Hiermit holen wir uns alle möglichen Werte des Feldes (doof :/)
// https://support.advancedcustomfields.com/forums/topic/get-a-field-object-outside-of-the-post-context/
$laender = get_field_object('field_5a67079b1ecfe');

foreach ($laender['choices'] as $laendercode => $land) {
  $haendler_de = get_posts(array(
    'post_type' => 'adressen',
    'posts_per_page' => -1,
    'meta_query' => array(
      'land_clause' => array(
        'key' => 'land',
        'value' => $laendercode,
        'compare' => '=',
      ),
      'ort_clause' => array(
        'key' => 'ort',
      ),
    ),
    'orderby' => array(
      'ort_clause' => 'ASC',
    ),
  ));

  echo "<h3>$land</h3>";

  foreach ($haendler_de as $h) {
    $name = $h->post_title;
    $name2 = get_field('ansprechpartner', $h->ID);
    $strasse = get_field('strasse', $h->ID);
    $plz = get_field('plz', $h->ID);
    $ort = get_field('ort', $h->ID);
    $telefon = get_field('telefon', $h->ID);
    $mobil = get_field('mobil', $h->ID);
    $fax = get_field('fax', $h->ID);
    $email = get_field('email_adresse', $h->ID);
    $hinweistext = get_field('hinweistext', $h->ID);
    $website = get_field('website', $h->ID);

    ?>

    <h4><?php echo $name; ?></h4>
    <?php echo !empty($name2) ? $name2 . '<br>' : ''; ?>

    <?php echo $strasse; ?><br>
    <?php echo $plz; ?> <?php echo $ort; ?><br>

    <?php echo !empty($telefon) ? $telefon . '<br>' : ''; ?>
    <?php echo !empty($mobil) ? $mobil . '<br>' : ''; ?>
    <?php echo !empty($fax) ? $fax . '<br>' : ''; ?>

    <?php if (!empty($email)) { ?>
      <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a><br>
    <?php } ?>
    <?php if (!empty($website)) { ?>
      <a href="http://<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a><br>
    <?php } ?>

    <?php echo !empty($hinweistext) ? '<br>' . $hinweistext . '<br>' : ''; ?>
    <br>

    <?php
  }
}

?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /index.php -->
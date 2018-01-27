<!-- single-ququq-boxen.php -->
<?php

$id = get_the_ID();
$title = get_the_title();
$artikelbild = get_field('artikelbild', $id);
$preis = get_field('preis', $id);
$details = get_field('details', $id);
$vorteile = get_field('vorteile', $id);
$lieferumfang = get_field('lieferumfang', $id);
$technische_daten = get_field('technische_daten', $id);
$versionen = get_field('versionen', $id);
$versionen_namen = array();

if (is_array($versionen)) {
  foreach ($versionen as $v) {
    $versionen_namen[] = $v['name'];
  }
}

$alle_versionen = count($versionen_namen) > 0 ? '(' . implode('/', $versionen_namen) . ') ' : '';

?>
<?php get_header(); ?>

<section class="page__content ququq">
  <?php get_template_part('partials/headerbild'); ?>
  <div class="gridable gridable--row">
    <div class="gridable--col col-8 ququq__content">
      <?php get_template_part('partials/loop', 'no_title'); ?><br>

      <?php if (!empty($artikelbild)) { ?>
        <img src="<?php echo $artikelbild; ?>" class="ququq__artikelbild">
      <?php } ?>

      <?php if (!empty($preis)) { ?>
        <div class="ququq__preis">
          <h3>
            QUQUQ <?php echo $title; ?> ab <?php echo $preis; ?> €<br>
            <small><?php echo $alle_versionen; ?>inkl. MwSt. zzgl. Versand</small>
          </h3>
        </div>
      <?php } ?>

      <!-- Button Fahrzeugauswahl -->

      <?php if (!empty($details)) { ?>
        <div class="ququq__details"><?php echo $details; ?></div>
      <?php } ?>
    </div>
    <div class="gridable--col col-4">
      <?php if (!empty($vorteile)) { ?>
        <div class="ququq__vorteile box-colored box-colored--yellow">
          <h3>Die Vorteile auf einen Blick</h3>
          <?php echo $vorteile; ?>
        </div>
      <?php } ?>

      <div class="ququq__lieferumfang box-colored box-colored--brown">
        <h3>Die KombiBox passt in</h3>
      </div>

      <?php if (!empty($lieferumfang)) { ?>
        <div class="ququq__lieferumfang box-colored box-colored--brown-bordered">
          <?php echo $lieferumfang; ?>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php if (!empty($technische_daten)) { ?>
    <div class="ququq__technische_daten box-colored box-colored--yellow-bordered">
      <?php echo $technische_daten; ?>
    </div>
  <?php } ?>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<!-- /single-ququq-boxen.php -->
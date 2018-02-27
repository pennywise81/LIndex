<!-- single-ququq-boxen.php -->
<?php

$id = get_the_ID();
$title = get_the_title();
$artikelbild = get_field('artikelbild', $id);
$preis = get_field('preis', $id);
$preiszusatzbezeichnung = get_field('preiszusatzbezeichnung', $id);
$details = get_field('details', $id);
$vorteile = get_field('vorteile', $id);
$passende_fahrzeuge = get_field('passende_fahrzeuge', $id);
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
            QUQUQ <?php echo $title; ?> <?php pll_e("ab"); ?> <?php echo $preis; ?> €<br>
            <small>
              <?php if (!empty($preiszusatzbezeichnung)) { ?>
                <?php echo $preiszusatzbezeichnung; ?>
              <?php } ?>
              <?php pll_e("inkl. MwSt. zzgl. Versand"); ?>
            </small>
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
          <h3><?php pll_e("Die Vorteile auf einen Blick"); ?></h3>
          <?php echo $vorteile; ?>
        </div>
      <?php } ?>

      <?php if (!empty($passende_fahrzeuge)) { ?>
        <div class="ququq__passende-fahrzeuge box-colored box-colored--brown">
          <h3><?php echo str_replace("Box", $title, pll__("Die Box passt in")); ?></h3>
          <?php echo $passende_fahrzeuge; ?>

          <!--
          <a href="#" class="button button--bordered"><?php pll_e("Zur Fahrzeugauswahl"); ?></a>
          <br>
          <strong><?php pll_e("Dein Wagen steht nicht auf der Liste?"); ?></strong><br>
          <br>
          <?php pll_e("Hier findest Du alle Maße mit denen Du prüfen kannst, ob Dein Fahrzeug ggf. kompatibel ist:"); ?>
          <a href="#"><?php echo str_replace("Box", $title, pll__("Voraussetzungen Box")); ?></a>
          -->
        </div>
      <?php } ?>

      <?php if (!empty($lieferumfang)) { ?>
        <div class="ququq__lieferumfang box-colored box-colored--brown-bordered">
          <h3><?php pll_e("Lieferumfang"); ?></h3>
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
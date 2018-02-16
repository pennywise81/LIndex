<?php

$name = $r->post_title;
$name2 = get_field('ansprechpartner', $r->ID);
$strasse = get_field('strasse', $r->ID);
$plz = get_field('plz', $r->ID);
$ort = get_field('ort', $r->ID);
$telefon = get_field('telefon', $r->ID);
$mobil = get_field('mobil', $r->ID);
$fax = get_field('fax', $r->ID);
$email = get_field('email_adresse', $r->ID);
$hinweistext = get_field('hinweistext', $r->ID);
$website = get_field('website', $r->ID);
$types = get_field('typ', $r->ID);

?>
<div class="gridable--col col-4">
  <h4><?php echo $name; ?></h4>
  <?php echo !empty($name2) ? $name2 . '<br>' : ''; ?>
  <?php if (in_array('r', $types)) { ?>
    <i>Referenzkunde</i><br>
  <?php } ?>

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
</div>
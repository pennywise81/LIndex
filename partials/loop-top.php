<!-- loop-top.php -->
<?php

$posttype = get_post_type();
$css_classes = array('loop-item--' . $posttype);

if ($posttype == 'post') {
  $cats = get_the_category();

  if (count($cats) > 0) {
    $css_classes[] = 'loop-item--post--' . $cats[0]->slug;
  }
}

?>

<div class="<?php echo implode(' ', $css_classes); ?>" id="post-<?php the_ID(); ?>">
<!-- /loop-top.php -->
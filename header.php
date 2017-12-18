<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <?php wp_head(); ?>
</head>
<body <?php body_class('page'); ?>>
  <header class="page__header clearfix">
    <div class="container container--maxwidth">
      <a href="<?php echo get_home_url(); ?>" title="<?php bloginfo('name'); ?>">
        <h2>
          <?php bloginfo('name'); ?>
        </h2>
        <p><?php bloginfo('description'); ?></p>
      </a>
      <div class="page__menu">
<?php

if (has_nav_menu('header-menu')) {
  // show menu 'Header Menu' if it was added in the designer
  wp_nav_menu(
    array(
      'theme_location' => 'header-menu',
      'container_class' => 'page__menu__wrapper page__menu__wrapper--closed'
    )
  );
}
else {
  // list a menu with all pages including 'home'
  wp_page_menu(
    array(
      'show_home' => 'Home',
      'menu_class' => 'page__menu__wrapper page__menu__wrapper--closed'
    )
  );
}

?>
      </div>
    </div>
  </header>

  <main class="page__main container container--maxwidth">

<!-- /header.php -->
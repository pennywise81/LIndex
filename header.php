<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <h2><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h2>
    <p><?php bloginfo('description'); ?></p>
  </header>
<?php

if (has_nav_menu('header-menu')) {
  // show menu 'Header Menu' if it was added in the designer
  wp_nav_menu(
    array(
      'theme_location' => 'header-menu',
      'container_class' => 'menu-wrapper'
    )
  );
}
else {
  // list a menu with all pages including 'home'
  wp_page_menu(
    array(
      'show_home' => 'Home',
      'menu_class' => 'menu-wrapper'
    )
  );
}

?>
  <div class="container">

<!-- /header.php -->
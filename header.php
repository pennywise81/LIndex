<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php wp_head(); ?>
</head>
<body>

<?php

if (has_nav_menu('header-menu')) {
  // show menu 'Header Menu' if it was added in the designer
  wp_nav_menu(
    array(
      'theme_location' => 'header-menu'
    )
  );
}
else {
  // list a menu with all pages including 'home'
  wp_page_menu(
    array(
      'show_home' => 'Home'
    )
  );
}

?>

<!-- /header.php -->
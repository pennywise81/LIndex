<!-- sidebar.php -->
<?php

if (get_theme_mod('display_sidebar') && is_active_sidebar('sidebar-global')) {

?>
<aside class="sidebar">
<?php

}

?>

<?php

if (get_theme_mod('display_sidebar') && is_active_sidebar('sidebar-global')) {
  dynamic_sidebar('sidebar-global');
}

?>

<?php

if (get_theme_mod('display_sidebar') && is_active_sidebar('sidebar-global')) {

?>
</aside>
<?php

}

?>
<!-- /sidebar.php -->
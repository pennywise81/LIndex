<!-- sidebar.php -->
<?php
// if Sidebar option is false, we can leave because we wont show a sidebar
if (get_theme_mod('display_sidebar') == false) {
  return;
}

// vars
global $post;
$showSidebar = false;
$sidebarClass = get_theme_mod('sidebar_side');

// determine the post id
$id = $post->ID;

// check if there's a sidebar for the current page
if (
  is_active_sidebar('sidebar-global') ||
  is_active_sidebar('sidebar-page-' . $id) ||
  (is_front_page() && is_active_sidebar('sidebar-page-homepage'))
) {
  $showSidebar = true;
}

// if we don't have a sidebar, we can leave
if ($showSidebar == false) {
  return;
}

?>

<aside class="page__sidebar <?php echo $sidebarClass; ?>">

<?php

// display the sidebar for the start page (when we are here)
if (is_front_page() && is_active_sidebar('sidebar-page-homepage')) {
  dynamic_sidebar('sidebar-page-homepage');
}

// display the sidebar for this very page
if (is_active_sidebar('sidebar-page-' . $id)) {
  dynamic_sidebar('sidebar-page-' . $id);
}

// display the global sidebar
if (is_active_sidebar('sidebar-global')) {
  dynamic_sidebar('sidebar-global');
}

?>

</aside>

<!-- /sidebar.php -->

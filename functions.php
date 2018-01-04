<?php

require_once 'functions/title-tag.php';
require_once 'functions/remove-head-clutter.php';
require_once 'functions/disable-admin-bar.php';
require_once 'functions/register-menus.php';
require_once 'functions/enqueue-scripts-and-styles.php';
require_once 'functions/init-widgets.php';
require_once 'functions/sidebar-customization.php';
require_once 'functions/website-customization.php';
require_once 'functions/remove-filter-wpautop.php';
require_once 'functions/theme-support-post-thumbnails.php';
require_once 'functions/theme-features.php';
require_once 'functions/remove_menu_page.php';

// Custom Types
require_once 'functions/custom-post-type-hersteller.php';
require_once 'functions/custom-post-type-fahrzeug.php';
require_once 'functions/custom-post-type-fahrzeugvariante.php';
require_once 'functions/custom-post-type-ququq.php';

require_once 'functions/Ququq_Navigation_Walker.class.php';
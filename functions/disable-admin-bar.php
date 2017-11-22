<?php

/*
Disables the WordPress Admin Bar in the frontend

https://premium.wpmudev.org/blog/remove-the-wordpress-admin-toolbar/
*/
add_filter('show_admin_bar', '__return_false');
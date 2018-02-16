<!-- default.php -->
<?php

$lcp_display_output = '';
global $post;

ob_start();

get_template_part('partials/loop');

$lcp_display_output .= ob_get_clean();

$this->lcp_output = $lcp_display_output;

?>
<!-- /default.php -->
<?php

$lcp_display_output = '';
global $post;

ob_start();

get_template_part('partials/loop', 'no_title');

$lcp_display_output .= ob_get_clean();

$this->lcp_output = $lcp_display_output;
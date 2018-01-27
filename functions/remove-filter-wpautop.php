<?php

/*
Removes the auto-added paragraphs
*/

// remove autop from all content and excerpts
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter ('acf_the_content', 'wpautop');

// remove the autop from widget content
// remove_filter('widget_text_content', 'wpautop');
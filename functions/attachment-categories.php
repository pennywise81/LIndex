<?php

function add_categories_to_attachments() {
  register_taxonomy_for_object_type('category', 'attachment');
}
add_action('init', 'add_categories_to_attachments');

function add_tags_to_attachments() {
  register_taxonomy_for_object_type('post_tag', 'attachment');
}
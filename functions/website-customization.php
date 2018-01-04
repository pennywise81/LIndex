<?php

/*
Adds settings to "Website-Information" in the Customizer

https://codex.wordpress.org/Function_Reference/add_settings_field
*/
class WebsiteCustomizer {
  function register($wp_customize) {
    // add a setting
    $wp_customize->add_setting('lindex_copyright',
      array(
        'default' => '',
      )
    );

    // add a control for the setting
    $wp_customize->add_control(
      'lindex_copyright',
      array(
        'type' => 'textarea',
        'label' => __('Copyright'),
        'section' => 'title_tagline',
      )
    );
  }

  function header_output() {
    // The live CSS is added here
  }

  function live_preview() {
    // The live preview is enqueued here
  }

}

add_action('customize_register', array('WebsiteCustomizer', 'register'));
add_action('wp_head', array('WebsiteCustomizer', 'header_output'));
add_action('customize_preview_init', array('WebsiteCustomizer', 'live_preview'));
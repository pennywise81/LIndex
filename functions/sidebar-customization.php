<?php

/*
Enables customization for the sidebar

https://premium.wpmudev.org/blog/wordpress-theme-customization-api/
*/

class SidebarCustomizer {
  function register($wp_customize) {
    // remove the widget customization for now
    // @TODO: enable widget customization
    // https://stackoverflow.com/questions/34003932/wordpress-theme-customizer-add-area-for-users-to-move-around-and-organize-widg
    $wp_customize->remove_panel('widgets');

    // add the section for the Sidebar Customizer
    $wp_customize->add_section(
      'sidebar_options',
      array(
        'title' => __('Sidebar-Einstellungen'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'description' => __('Hier kann die Darstellung der Sidebar geändert werden'),
      )
    );

    // add a setting for displaying the sidebar at all
    $wp_customize->add_setting('display_sidebar',
      array(
        'default' => true,
        'transport' => 'postMessage'
      )
    );

    // add a control for displaying the sidebar
    $wp_customize->add_control(
      'display_sidebar',
      array(
        'type' => 'radio',
        'label' => __('Sidebar anzeigen'),
        'section' => 'sidebar_options',
        'choices' => array(
            true => __('Ja'),
            false => __('Nein')
        )
      )
    );

    // add a setting for displaying the sidebar left or right
    $wp_customize->add_setting('sidebar_side',
      array(
        'default' => 'right',
        'transport' => 'postMessage'
      )
    );

    // add a control for sidebar side
    $wp_customize->add_control(
      'sidebar_side',
      array(
        'type' => 'select',
        'label' => __('Ausrichtung'),
        'section' => 'sidebar_options',
        'choices' => array(
            'left' => __('Links'),
            'right' => __('Rechts')
        )
      )
    );

  }

  function header_output() {
    // The live CSS is added here
  }

  function live_preview() {
    // The live preview is enqueued here

    wp_enqueue_script(
      'theme-customizer-sidebar',
      get_template_directory_uri() . '/js/theme-customizer-sidebar.js',
      array('jquery', 'customize-preview'),
      '',
      true
    );
  }

}

add_action('customize_register', array('SidebarCustomizer', 'register'));
add_action('wp_head', array('SidebarCustomizer', 'header_output'));
add_action('customize_preview_init', array('SidebarCustomizer', 'live_preview'));
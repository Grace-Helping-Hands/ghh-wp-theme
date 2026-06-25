<?php
// Enqueue styles and scripts
function ghh_enqueue_assets() {
    // Load Sofia Sans from Google Fonts (fallbacks provided in CSS variables)
    wp_enqueue_style( 'ghh-fonts', 'https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@300;400;600;700&display=swap', array(), null );
    // Theme CSS variables (must load before other theme styles)
    wp_enqueue_style( 'ghh-variables', get_template_directory_uri() . '/assets/css/base/variables.css', array( 'ghh-fonts' ), '1.0' );
    wp_enqueue_style( 'ghh-backgrounds', get_template_directory_uri() . '/assets/css/components/backgrounds.css', array( 'ghh-variables' ), '1.0' );
    wp_enqueue_style( 'ghh-buttons', get_template_directory_uri() . '/assets/css/components/buttons.css', array( 'ghh-variables' ), '1.0' );
    wp_enqueue_style( 'ghh-spacings', get_template_directory_uri() . '/assets/css/components/spacing.css', array( 'ghh-variables' ), '1.0' );
    wp_enqueue_style( 'ghh-helpers', get_template_directory_uri() . '/assets/css/utilities/helpers.css', array( 'ghh-variables' ), '1.0' );
    wp_enqueue_style( 'ghh-style', get_stylesheet_uri(), array( 'ghh-fonts', 'ghh-variables' ), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'ghh-containers', get_template_directory_uri() . '/assets/css/layout/containers.css', array( 'ghh-style' ), '1.0' );
    wp_enqueue_style( 'ghh-header', get_template_directory_uri() . '/assets/css/layout/header.css', array( 'ghh-containers' ), '1.0' );
    wp_enqueue_style( 'ghh-main', get_template_directory_uri() . '/assets/css/custom.css', array( 'ghh-header' ), '1.0' );
    wp_enqueue_style( 'ghh-hero', get_template_directory_uri() . '/assets/css/layout/hero.css', array( 'ghh-main' ), '1.0' );
    
    wp_enqueue_script( 'ghh-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0', true );
    // Navigation behavior (mobile toggle + desktop submenu)
    wp_enqueue_script( 'ghh-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'ghh_enqueue_assets' );

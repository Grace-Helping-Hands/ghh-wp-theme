<?php
// Enqueue styles and scripts
function ghh_enqueue_assets() {
    // Load Sofia Sans from Google Fonts (fallbacks provided in CSS variables)
    wp_enqueue_style( 'ghh-fonts', 'https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@300;400;600;700&display=swap', array(), null );

    // Helper: return asset URI with timestamp query parameter (?t=timestamp)
    $asset_uri = function( $relative_path ) {
        $file_path = get_template_directory() . $relative_path;
        $uri = get_template_directory_uri() . $relative_path;
        $ver = file_exists( $file_path ) ? filemtime( $file_path ) : time();
        return $uri . '?t=' . $ver;
    };

    // Reset (global box-sizing etc.)
    wp_enqueue_style( 'ghh-reset', $asset_uri( '/assets/css/base/reset.css' ), array(), false );
    // Theme CSS variables (must load before other theme styles)
    wp_enqueue_style( 'ghh-variables', $asset_uri( '/assets/css/base/variables.css' ), array( 'ghh-fonts', 'ghh-reset' ), false );
    wp_enqueue_style( 'ghh-backgrounds', $asset_uri( '/assets/css/components/backgrounds.css' ), array( 'ghh-variables' ), false );
    wp_enqueue_style( 'ghh-buttons', $asset_uri( '/assets/css/components/buttons.css' ), array( 'ghh-variables' ), false );
    wp_enqueue_style( 'ghh-spacings', $asset_uri( '/assets/css/components/spacing.css' ), array( 'ghh-variables' ), false );
    wp_enqueue_style( 'ghh-helpers', $asset_uri( '/assets/css/utilities/helpers.css' ), array( 'ghh-variables' ), false );
    // Main style (style.css) — use stylesheet directory for child theme support
    $style_ver = file_exists( get_stylesheet_directory() . '/style.css' ) ? filemtime( get_stylesheet_directory() . '/style.css' ) : $theme_version;
    $style_uri = get_stylesheet_uri() . '?t=' . $style_ver;
    wp_enqueue_style( 'ghh-style', $style_uri, array( 'ghh-fonts', 'ghh-variables' ), false );
    wp_enqueue_style( 'ghh-containers', $asset_uri( '/assets/css/layout/containers.css' ), array( 'ghh-style' ), false );
    wp_enqueue_style( 'ghh-header', $asset_uri( '/assets/css/layout/header.css' ), array( 'ghh-containers' ), false );
    wp_enqueue_style( 'ghh-main', $asset_uri( '/assets/css/custom.css' ), array( 'ghh-header' ), false );
    wp_enqueue_style( 'ghh-hero', $asset_uri( '/assets/css/layout/hero.css' ), array( 'ghh-main' ), false );
    
    wp_enqueue_script( 'ghh-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0', true );
    // Navigation behavior (mobile toggle + desktop submenu)
    wp_enqueue_script( 'ghh-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'ghh_enqueue_assets' );

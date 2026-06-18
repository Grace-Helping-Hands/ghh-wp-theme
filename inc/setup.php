<?php
// Setup theme supports, menus, image sizes
function ghh_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array( 'menu-1' => __( 'Primary', 'ghh' ) ) );
}
add_action( 'after_setup_theme', 'ghh_setup' );

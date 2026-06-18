<?php
// Register widgets / sidebars
function ghh_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar', 'ghh' ),
        'id'   => 'sidebar-1',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Front Page', 'ghh' ),
        'id'   => 'front-page',
        'description' => __( 'Widgets in this area will appear on the front page.', 'ghh' ),
    ) );

    register_sidebar( array(
        'name' => __( 'Footer', 'ghh' ),
        'id'   => 'footer-1',
    ) );
}
add_action( 'widgets_init', 'ghh_widgets_init' );

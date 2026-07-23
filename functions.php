<?php
// Theme bootstrap: load core includes
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/newsletters.php';


add_action('init', function () {
    add_post_type_support('page', 'excerpt');
});

function register_my_custom_menus() {
    register_nav_menus(
        array(
            'extra-footer-menu'    => __( 'Extra Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_custom_menus' );

add_theme_support('custom-logo');

// Additional includes (optional)
// require_once get_template_directory() . '/inc/customizer.php';
// require_once get_template_directory() . '/inc/widgets.php';

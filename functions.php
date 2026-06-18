<?php
// Theme bootstrap: load core includes
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/helpers.php';

add_action('init', function () {
    add_post_type_support('page', 'excerpt');
});

// Additional includes (optional)
// require_once get_template_directory() . '/inc/customizer.php';
// require_once get_template_directory() . '/inc/widgets.php';

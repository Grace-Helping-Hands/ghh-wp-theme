<?php
/**
 * Widget areas.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register widget areas used by sidebar.php and template-parts/footer/widgets.php.
 */
function ghh_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Sidebar', 'ghh' ),
			'id'   => 'sidebar-1',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Footer', 'ghh' ),
			'id'   => 'footer-1',
		)
	);
}
add_action( 'widgets_init', 'ghh_widgets_init' );

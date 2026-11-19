<?php
/**
 * Theme bootstrap.
 *
 * Every feature lives in its own file under inc/. Keep this file to
 * require_once calls only.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

$ghh_includes = array(
	'inc/setup.php',      // Theme supports, menus, text domain, editor styles.
	'inc/helpers.php',    // Small template helpers (reading time, assets).
	'inc/customizer.php', // Appearance -> Customize -> Theme Options (+ ghh_get_option()).
	'inc/enqueue.php',    // Front-end styles and scripts.
	'inc/widgets.php',    // Widget areas (sidebar, footer).
	'inc/blocks.php',     // Block pattern category (patterns live in /patterns).
	'inc/newsletters.php', // Newsletter content type + listing helpers.
);

foreach ( $ghh_includes as $ghh_file ) {
	require_once get_template_directory() . '/' . $ghh_file;
}
unset( $ghh_includes, $ghh_file );

<?php
/**
 * Block editor additions.
 *
 * Block patterns are auto-registered by WordPress from the /patterns folder
 * (one PHP file per pattern, metadata in the file header). This file only
 * registers the category they appear under in the inserter.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the "Grace Helping Hands" pattern category.
 */
function ghh_register_pattern_category() {
	register_block_pattern_category(
		'ghh',
		array( 'label' => __( 'Grace Helping Hands', 'ghh' ) )
	);
}
add_action( 'init', 'ghh_register_pattern_category' );

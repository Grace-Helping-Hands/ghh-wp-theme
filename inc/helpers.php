<?php
/**
 * Template helper functions.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cache-busting version for a theme asset: the file's last-modified time.
 *
 * @param string $relative_path Path from the theme root, e.g. 'assets/css/custom.css'.
 * @return string|false Version string, or false to fall back to the WP version.
 */
function ghh_asset_version( $relative_path ) {
	$file = get_template_directory() . '/' . ltrim( $relative_path, '/' );

	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

/**
 * Get a reading time estimate for a post.
 *
 * @param int $post_id Post ID.
 * @return string Read time label.
 */
function ghh_get_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? intval( $post_id ) : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );

	if ( ! $content ) {
		return __( '1 min read', 'ghh' );
	}

	$word_count = str_word_count( wp_strip_all_tags( strip_shortcodes( $content ) ) );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );

	/* translators: %s: estimated reading minutes */
	return sprintf( _n( '%s min read', '%s mins read', $minutes, 'ghh' ), $minutes );
}

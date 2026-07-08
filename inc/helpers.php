<?php
// Helper functions (placeholder)

if ( ! function_exists( 'ghh_get_reading_time' ) ) {
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
		$minutes = max( 1, (int) ceil( $word_count / 200 ) );

		/* translators: %s: estimated reading minutes */
		return sprintf( _n( '%s min read', '%s mins read', $minutes, 'ghh' ), $minutes );
	}
}

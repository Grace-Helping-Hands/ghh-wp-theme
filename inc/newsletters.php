<?php
/**
 * Newsletter content type.
 *
 * Newsletters are admin-only items that feed the listing on the page using
 * the "Newsletter" template (templates/page-newsletter.php). They have no
 * public URL of their own. Editor guide: docs/newsletter-handbook.md
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the newsletter post type.
 */
function ghh_register_newsletter_post_type() {
	$labels = array(
		'name'               => __( 'Newsletters', 'ghh' ),
		'singular_name'      => __( 'Newsletter', 'ghh' ),
		'menu_name'          => __( 'Newsletters', 'ghh' ),
		'name_admin_bar'     => __( 'Newsletter', 'ghh' ),
		'add_new'            => __( 'Add New', 'ghh' ),
		'add_new_item'       => __( 'Add New Newsletter', 'ghh' ),
		'new_item'           => __( 'New Newsletter', 'ghh' ),
		'edit_item'          => __( 'Edit Newsletter', 'ghh' ),
		'view_item'          => __( 'View Newsletter', 'ghh' ),
		'all_items'          => __( 'All Newsletters', 'ghh' ),
		'search_items'       => __( 'Search Newsletters', 'ghh' ),
		'not_found'          => __( 'No newsletters found.', 'ghh' ),
		'not_found_in_trash' => __( 'No newsletters found in Trash.', 'ghh' ),
	);

	register_post_type(
		'newsletter',
		array(
			'labels'          => $labels,
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => true,
			'menu_position'   => 20,
			'menu_icon'       => 'dashicons-email-alt2',
			'has_archive'     => false,
			'rewrite'         => false,
			'query_var'       => false,
			// Featured image + excerpt are optional overrides for the listing card.
			'supports'        => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'ghh_register_newsletter_post_type' );

/**
 * Register the "Newsletter Link" meta field.
 */
function ghh_register_newsletter_meta() {
	register_post_meta(
		'newsletter',
		'_ghh_newsletter_url',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'esc_url_raw',
			// Only users who can edit this specific newsletter may change its link.
			'auth_callback'     => function ( $allowed, $meta_key, $object_id ) {
				return current_user_can( 'edit_post', $object_id );
			},
		)
	);
}
add_action( 'init', 'ghh_register_newsletter_meta' );

/**
 * Add the "Newsletter Link" meta box.
 */
function ghh_add_newsletter_link_metabox() {
	add_meta_box(
		'ghh-newsletter-link',
		__( 'Newsletter Link', 'ghh' ),
		'ghh_render_newsletter_link_metabox',
		'newsletter',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ghh_add_newsletter_link_metabox' );

/**
 * Render the "Newsletter Link" meta box.
 *
 * @param WP_Post $post Current newsletter.
 */
function ghh_render_newsletter_link_metabox( $post ) {
	$value = get_post_meta( $post->ID, '_ghh_newsletter_url', true );

	wp_nonce_field( 'ghh_save_newsletter_link', 'ghh_newsletter_link_nonce' );
	?>
	<p>
		<label for="ghh-newsletter-url">
			<?php esc_html_e( 'Paste the PDF, image, or external newsletter URL used by the Read Newsletter button.', 'ghh' ); ?>
		</label>
	</p>
	<input
		type="url"
		id="ghh-newsletter-url"
		name="ghh_newsletter_url"
		value="<?php echo esc_attr( $value ); ?>"
		class="widefat"
		placeholder="https://example.com/newsletter.pdf"
	>
	<?php
}

/**
 * Save the "Newsletter Link" meta box.
 *
 * @param int $post_id Newsletter ID.
 */
function ghh_save_newsletter_link_metabox( $post_id ) {
	if ( ! isset( $_POST['ghh_newsletter_link_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ghh_newsletter_link_nonce'] ) ), 'ghh_save_newsletter_link' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['ghh_newsletter_url'] ) ) {
		$url = esc_url_raw( wp_unslash( $_POST['ghh_newsletter_url'] ) );

		if ( $url ) {
			update_post_meta( $post_id, '_ghh_newsletter_url', $url );
		} else {
			delete_post_meta( $post_id, '_ghh_newsletter_url' );
		}
	}
}
add_action( 'save_post_newsletter', 'ghh_save_newsletter_link_metabox' );

/**
 * Query published newsletters, newest first.
 *
 * @return WP_Query
 */
function ghh_get_newsletters_query() {
	return new WP_Query(
		array(
			'post_type'      => 'newsletter',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'no_found_rows'  => true,
		)
	);
}

/**
 * Card image: the featured image if set, otherwise the first image in the body.
 *
 * @param int $post_id Newsletter ID.
 * @return string Image HTML ('' when none). Pass through wp_kses_post() on output.
 */
function ghh_newsletter_get_card_image_html( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, 'medium_large' );
	}

	$content = get_post_field( 'post_content', $post_id );

	if ( preg_match( '/<img[^>]+>/i', $content, $match ) ) {
		// Drop fixed dimensions so the card's CSS controls the size.
		return preg_replace( '/\s(width|height)="[^"]*"/i', '', $match[0] );
	}

	return '';
}

/**
 * Card summary: the excerpt if set, otherwise the body text (images removed).
 *
 * @param int $post_id Newsletter ID.
 * @return string Plain text.
 */
function ghh_newsletter_get_card_summary( $post_id ) {
	$excerpt = get_post_field( 'post_excerpt', $post_id );

	if ( '' !== trim( (string) $excerpt ) ) {
		return wp_trim_words( wp_strip_all_tags( $excerpt, true ), 24 );
	}

	$content = get_post_field( 'post_content', $post_id );
	$content = preg_replace( '/<figure\b[^>]*>.*?<\/figure>/is', '', $content );
	$content = strip_shortcodes( $content );

	return wp_trim_words( wp_strip_all_tags( $content, true ), 24 );
}

/**
 * "Read Newsletter" destination URL.
 *
 * @param int $post_id Newsletter ID.
 * @return string
 */
function ghh_newsletter_get_destination_url( $post_id ) {
	return esc_url_raw( get_post_meta( $post_id, '_ghh_newsletter_url', true ) );
}

/**
 * Link target: new tab for external sites and direct files (PDF/images).
 *
 * @param string $url Destination URL.
 * @return string '_blank' or ''.
 */
function ghh_newsletter_link_target( $url ) {
	$site_host = wp_parse_url( home_url(), PHP_URL_HOST );
	$url_host  = wp_parse_url( $url, PHP_URL_HOST );
	$path      = wp_parse_url( $url, PHP_URL_PATH );

	if ( $url_host && $url_host !== $site_host ) {
		return '_blank';
	}

	if ( $path && preg_match( '/\.(pdf|png|jpe?g|webp|gif)$/i', $path ) ) {
		return '_blank';
	}

	return '';
}

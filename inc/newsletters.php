<?php
/**
 * Newsletter content type.
 *
 * Newsletters are regular editor-managed content: title, body, and publish
 * date drive the newsletter index automatically.
 */

function ghh_register_newsletter_post_type() {
    $labels = array(
        'name'                  => __( 'Newsletters', 'ghh' ),
        'singular_name'         => __( 'Newsletter', 'ghh' ),
        'menu_name'             => __( 'Newsletters', 'ghh' ),
        'name_admin_bar'        => __( 'Newsletter', 'ghh' ),
        'add_new'               => __( 'Add New', 'ghh' ),
        'add_new_item'          => __( 'Add New Newsletter', 'ghh' ),
        'new_item'              => __( 'New Newsletter', 'ghh' ),
        'edit_item'             => __( 'Edit Newsletter', 'ghh' ),
        'view_item'             => __( 'View Newsletter', 'ghh' ),
        'all_items'             => __( 'All Newsletters', 'ghh' ),
        'search_items'          => __( 'Search Newsletters', 'ghh' ),
        'not_found'             => __( 'No newsletters found.', 'ghh' ),
        'not_found_in_trash'    => __( 'No newsletters found in Trash.', 'ghh' ),
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
            'supports'        => array( 'title', 'editor', 'revisions', 'author' ),
            'capability_type' => 'post',
        )
    );
}
add_action( 'init', 'ghh_register_newsletter_post_type' );

function ghh_register_newsletter_meta() {
    register_post_meta(
        'newsletter',
        '_ghh_newsletter_url',
        array(
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'esc_url_raw',
            'auth_callback'     => function() {
                return current_user_can( 'edit_posts' );
            },
        )
    );
}
add_action( 'init', 'ghh_register_newsletter_meta' );

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

function ghh_newsletter_archive_url() {
    $page = get_page_by_path( 'newsletter' );

    return $page ? get_permalink( $page ) : home_url( '/newsletter/' );
}

function ghh_newsletter_get_card_image_html( $post_id ) {
    $content = get_post_field( 'post_content', $post_id );

    if ( preg_match( '/<img[^>]+>/i', $content, $match ) ) {
        $image = $match[0];
        $image = preg_replace( '/\s(width|height)="[^"]*"/i', '', $image );

        return $image;
    }

    return '';
}

function ghh_newsletter_get_destination_url( $post_id ) {
    return esc_url_raw( get_post_meta( $post_id, '_ghh_newsletter_url', true ) );
}

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

function ghh_newsletter_get_card_summary( $post_id ) {
    $content = get_post_field( 'post_content', $post_id );
    $content = preg_replace( '/<figure\b[^>]*>.*?<\/figure>/is', '', $content );
    $content = strip_shortcodes( $content );
    $summary = wp_strip_all_tags( $content, true );

    return wp_trim_words( $summary, 24 );
}

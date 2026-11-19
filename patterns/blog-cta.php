<?php
/**
 * Title: Donate link (end of post)
 * Slug: ghh/blog-cta
 * Categories: ghh, call-to-action
 * Keywords: cta, donate, give, link, end
 * Description: A centered green Donate button with a heart, for the end of a blog post. Change the button link to any page or form.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"metadata":{"name":"Donate CTA"},"className":"ghh-cta-mini"} -->
<div class="wp-block-group ghh-cta-mini"><!-- wp:buttons {"className":"ghh-cta-mini__buttons"} -->
<div class="wp-block-buttons ghh-cta-mini__buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/donate/' ) ); ?>"><?php esc_html_e( 'Donate', 'ghh' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

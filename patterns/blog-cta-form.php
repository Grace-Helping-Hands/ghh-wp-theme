<?php
/**
 * Title: Donate form pop-up (end of post)
 * Slug: ghh/blog-cta-form
 * Categories: ghh, call-to-action
 * Keywords: cta, donate, givebutter, form, popup
 * Description: New blog posts start with this; delete it by hand if a post doesn't need it. Same as "Donate link", but the button opens the Givebutter donation form in a pop-up. To show a different form, change the button's link to #givebutter- followed by the campaign ID.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"metadata":{"name":"Donate CTA (form)"},"className":"ghh-cta-mini"} -->
<div class="wp-block-group ghh-cta-mini"><!-- wp:buttons {"className":"ghh-cta-mini__buttons"} -->
<div class="wp-block-buttons ghh-cta-mini__buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#givebutter-5XT0XG"><?php esc_html_e( 'Donate', 'ghh' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

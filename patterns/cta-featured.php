<?php
/**
 * Title: Featured call to action
 * Slug: ghh/cta-featured
 * Categories: ghh, call-to-action
 * Keywords: cta, donate, volunteer, banner, featured, drive
 * Description: A bold plum band with a gold label, heading, short text and two buttons. Edit any text by clicking it. The Donate button opens the Givebutter form: to show a different form, change its link to #givebutter- followed by the campaign ID.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"metadata":{"name":"Featured CTA"},"className":"ghh-cta-feature"} -->
<div class="wp-block-group ghh-cta-feature"><!-- wp:paragraph {"className":"ghh-cta-feature__label"} -->
<p class="ghh-cta-feature__label"><?php esc_html_e( 'Winter kit drive', 'ghh' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"ghh-cta-feature__title"} -->
<h2 class="wp-block-heading ghh-cta-feature__title"><?php esc_html_e( 'Help us restore dignity, one kit at a time', 'ghh' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ghh-cta-feature__text"} -->
<p class="ghh-cta-feature__text"><?php esc_html_e( 'Every hygiene kit is assembled by volunteers and funded by people like you.', 'ghh' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"ghh-cta-feature__buttons"} -->
<div class="wp-block-buttons ghh-cta-feature__buttons"><!-- wp:button {"className":"ghh-cta-feature__primary"} -->
<div class="wp-block-button ghh-cta-feature__primary"><a class="wp-block-button__link wp-element-button" href="#givebutter-5XT0XG"><?php esc_html_e( 'Donate', 'ghh' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline ghh-cta-feature__secondary"} -->
<div class="wp-block-button is-style-outline ghh-cta-feature__secondary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/become-a-volunteer/' ) ); ?>"><?php esc_html_e( 'Volunteer', 'ghh' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

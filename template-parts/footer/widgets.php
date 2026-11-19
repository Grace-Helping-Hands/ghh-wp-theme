<?php
/**
 * Footer widget area (Appearance -> Widgets -> Footer).
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="footer-widgets">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<?php dynamic_sidebar( 'footer-1' ); ?>
	<?php endif; ?>
</div>

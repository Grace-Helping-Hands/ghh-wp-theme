<?php
/**
 * Sidebar widget area (Appearance -> Widgets -> Sidebar).
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<aside id="site-sidebar">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>
</aside>

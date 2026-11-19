<?php
/**
 * Footer copyright line.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="site-info">
	<hr>
	<?php
	echo esc_html(
		sprintf(
			/* translators: 1: current year, 2: site name */
			__( '© %1$s %2$s. All Rights Reserved.', 'ghh' ),
			wp_date( 'Y' ),
			get_bloginfo( 'name' )
		)
	);
	?>
</div>

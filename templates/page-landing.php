<?php
/**
 * Template Name: Landing
 *
 * Bare page: only the block content, no title wrapper.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="landing">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
endwhile;
	?>
</main>
<?php
get_footer();

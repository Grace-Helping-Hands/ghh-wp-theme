<?php
/**
 * Template Name: Sidebar Page
 *
 * Page with the Sidebar widget area.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="layout-sidebar">
	<main class="content-area">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content/content', 'page' );
endwhile;
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();

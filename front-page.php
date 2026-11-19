<?php
/**
 * Front page: coded hero, then the Home page's block content.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="site-content" class="front-page">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/front/hero' );
		?>
		<section class="front-page__content">
			<?php the_content(); ?>
		</section>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();

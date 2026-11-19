<?php
/**
 * Template Name: Newsletter
 *
 * Intro comes from the page body; the list below is generated from published
 * Newsletter items (see inc/newsletters.php, docs/newsletter-handbook.md).
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="site-content" class="newsletter-page">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<section class="newsletter-hero">
			<div class="newsletter-container">
				<?php the_title( '<h1 class="newsletter-page__title">', '</h1>' ); ?>
				<div class="newsletter-page__body">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
		<?php
	endwhile;

	$ghh_newsletters = ghh_get_newsletters_query();
	?>

	<section class="newsletter-list-section" aria-label="<?php esc_attr_e( 'Newsletters', 'ghh' ); ?>">
		<div class="newsletter-container">
			<?php if ( $ghh_newsletters->have_posts() ) : ?>
				<div class="newsletter-list">
					<?php
					while ( $ghh_newsletters->have_posts() ) :
						$ghh_newsletters->the_post();
						get_template_part( 'template-parts/newsletter/card' );
					endwhile;
					?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="newsletter-empty"><?php esc_html_e( 'No newsletters have been published yet.', 'ghh' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();

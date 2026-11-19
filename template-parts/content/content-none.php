<?php
/**
 * Shown when a query has no results: 404s, empty searches, empty archives.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="no-results container py-lg">
	<header class="page-header">
		<h1 class="page-title">
			<?php
			if ( is_404() ) {
				esc_html_e( 'Page not found', 'ghh' );
			} elseif ( is_search() ) {
				esc_html_e( 'Nothing found', 'ghh' );
			} else {
				esc_html_e( 'Nothing here yet', 'ghh' );
			}
			?>
		</h1>
	</header>

	<div class="page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, nothing matched your search. Please try different keywords.', 'ghh' ); ?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'The page you are looking for may have moved. Try searching, or head back to the home page.', 'ghh' ); ?></p>
		<?php endif; ?>

		<?php get_search_form(); ?>

		<p class="mt-md">
			<a class="link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the home page', 'ghh' ); ?></a>
		</p>
	</div>
</section>

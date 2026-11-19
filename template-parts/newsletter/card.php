<?php
/**
 * One row in the newsletter listing. Expects to run inside the loop.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

$ghh_url    = ghh_newsletter_get_destination_url( get_the_ID() );
$ghh_target = ghh_newsletter_link_target( $ghh_url );
$ghh_image  = ghh_newsletter_get_card_image_html( get_the_ID() );
$ghh_attrs  = $ghh_target ? ' target="' . esc_attr( $ghh_target ) . '" rel="noopener"' : '';
$ghh_media  = $ghh_image
	? wp_kses_post( $ghh_image )
	: '<span class="newsletter-card__placeholder">' . esc_html__( 'Newsletter', 'ghh' ) . '</span>';
?>
<article <?php post_class( 'newsletter-card' ); ?>>
	<?php if ( $ghh_url ) : ?>
		<a
			class="newsletter-card__media"
			href="<?php echo esc_url( $ghh_url ); ?>"<?php echo $ghh_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>
			aria-label="<?php /* translators: %s: newsletter title */ echo esc_attr( sprintf( __( 'Read %s', 'ghh' ), get_the_title() ) ); ?>"
		><?php echo $ghh_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?></a>
	<?php else : ?>
		<div class="newsletter-card__media"><?php echo $ghh_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?></div>
	<?php endif; ?>

	<div class="newsletter-card__content">
		<time class="newsletter-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
			<?php echo esc_html( strtoupper( get_the_date( 'F Y' ) ) ); ?>
		</time>
		<?php the_title( '<h2 class="newsletter-card__title">', '</h2>' ); ?>
		<div class="newsletter-card__summary">
			<p><?php echo esc_html( ghh_newsletter_get_card_summary( get_the_ID() ) ); ?></p>
		</div>
	</div>

	<?php if ( $ghh_url ) : ?>
		<a
			class="newsletter-card__button"
			href="<?php echo esc_url( $ghh_url ); ?>"<?php echo $ghh_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>
		>
			<span><?php esc_html_e( 'Read Newsletter', 'ghh' ); ?></span>
			<span class="newsletter-card__arrow" aria-hidden="true">&rarr;</span>
		</a>
	<?php endif; ?>
</article>

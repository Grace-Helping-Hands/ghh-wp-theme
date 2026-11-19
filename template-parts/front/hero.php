<?php
/**
 * Front page hero: page title, excerpt, buttons, social links, featured image.
 *
 * Title/excerpt/image come from the Home page; button labels and links from
 * Appearance -> Customize -> Theme Options -> Front Page Hero.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

$ghh_buttons = array(
	'btn-primary'   => array( ghh_get_option( 'hero_primary_label' ), ghh_get_url_option( 'hero_primary_url' ) ),
	'btn-secondary' => array( ghh_get_option( 'hero_secondary_label' ), ghh_get_url_option( 'hero_secondary_url' ) ),
);
?>
<section class="home-hero home-hero--split">
	<div class="hero-row container">
		<div class="hero-inner">
			<h1 class="hero-title"><?php the_title(); ?></h1>
			<div class="hero-excerpt"><?php the_excerpt(); ?></div>
			<div class="hero-cta">
				<?php foreach ( $ghh_buttons as $ghh_class => $ghh_button ) : ?>
					<?php $ghh_href = esc_url( $ghh_button[1] ); ?>
					<?php if ( $ghh_button[0] && $ghh_href ) : ?>
						<a class="btn <?php echo esc_attr( $ghh_class ); ?>" href="<?php echo $ghh_href; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>"><?php echo esc_html( $ghh_button[0] ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<?php get_template_part( 'template-parts/social-links', null, array( 'class' => 'hero-social' ) ); ?>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="hero-image">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
/**
 * Site footer (closes <body> and <html>).
 *
 * Text and links are editable in Appearance -> Customize -> Theme Options -> Footer.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

$ghh_email = ghh_get_option( 'contact_email' );
?>
<footer id="site-footer" class="site-footer">
	<div class="footer-top container">
		<div class="footer-logo">
			<?php the_custom_logo(); ?>
		</div>
		<div class="footer-grid">
			<div class="footer-col footer-col--brand">
				<div class="footer-branding">
					<div class="footer-org">
						<h2 class="footer-org__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
						<h4 class="footer-org__tagline"><em><?php echo esc_html( ghh_get_option( 'footer_tagline' ) ); ?></em></h4>

						<?php if ( ghh_get_option( 'newsletter_url' ) ) : ?>
							<div class="wp-block-button btn btn-brand-1">
								<p class="col-heading"><?php echo esc_html( ghh_get_option( 'newsletter_heading' ) ); ?></p><a class="button footer-cta" href="<?php echo esc_url( ghh_get_url_option( 'newsletter_url' ) ); ?>"><?php echo esc_html( ghh_get_option( 'newsletter_label' ) ); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="footer-col footer-col--nav">
				<p class="col-heading"><?php esc_html_e( 'SITE MAP', 'ghh' ); ?></p>
				<?php
				wp_nav_menu(
					array(
						// Fall back to the Primary menu when no footer menu is assigned.
						'theme_location' => has_nav_menu( 'extra-footer-menu' ) ? 'extra-footer-menu' : 'menu-1',
						'menu_class'     => 'footer-nav-list',
						'container'      => false,
					)
				);
				?>
			</div>

			<div class="footer-col footer-col--contact">
				<p class="col-heading"><?php esc_html_e( 'CONTACT US', 'ghh' ); ?></p>
				<div class="contact-wrapper">
					<?php if ( ghh_get_option( 'transparency_url' ) ) : ?>
						<div class="transparency-award">
							<a href="<?php echo esc_url( ghh_get_url_option( 'transparency_url' ) ); ?>" target="_blank" rel="noopener noreferrer">
								<img src="<?php echo esc_url( ghh_get_url_option( 'transparency_image' ) ); ?>" alt="<?php echo esc_attr( ghh_get_option( 'transparency_alt' ) ); ?>" loading="lazy">
							</a>
						</div>
					<?php endif; ?>
					<div>
						<address class="footer-contact">
							<?php if ( $ghh_email ) : ?>
								<p><a href="<?php echo esc_url( 'mailto:' . $ghh_email ); ?>"><?php echo esc_html( $ghh_email ); ?></a></p>
							<?php endif; ?>
							<?php if ( ghh_get_option( 'ein' ) ) : ?>
								<p>
									<?php
									/* translators: %s: Employer Identification Number */
									echo esc_html( sprintf( __( 'EIN:  %s', 'ghh' ), ghh_get_option( 'ein' ) ) );
									?>
								</p>
							<?php endif; ?>
						</address>
						<?php if ( ghh_get_option( 'cfc_url' ) ) : ?>
							<p>
								<?php
								echo wp_kses_post(
									sprintf(
										/* translators: 1: Combined Federal Campaign link, 2: charity code */
										__( 'Donate to us through the %1$s using our Charity Code&nbsp;#%2$s', 'ghh' ),
										'<a href="' . esc_url( ghh_get_url_option( 'cfc_url' ) ) . '">' . esc_html__( 'Combined Federal Campaign (CFC)', 'ghh' ) . '</a>',
										esc_html( ghh_get_option( 'cfc_code' ) )
									)
								);
								?>
							</p>
						<?php endif; ?>
						<?php if ( ghh_get_option( 'feedback_url' ) ) : ?>
							<p><a href="<?php echo esc_url( ghh_get_url_option( 'feedback_url' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Website Feedback Form', 'ghh' ); ?></a></p>
						<?php endif; ?>
					</div>
				</div>

				<div class="footer-social">
					<?php get_template_part( 'template-parts/social-links', null, array( 'class' => 'social-links' ) ); ?>
				</div>
			</div>
		</div>

		<?php get_template_part( 'template-parts/footer/copyright' ); ?>
	</div>

	<?php get_template_part( 'template-parts/footer/widgets' ); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>

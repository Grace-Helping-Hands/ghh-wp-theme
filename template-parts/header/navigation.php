<?php
/**
 * Main navigation: logo, hamburger toggle (mobile), Primary menu.
 *
 * Toggle behavior lives in assets/js/navigation.js.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

$ghh_logo_src = get_template_directory_uri() . '/assets/images/ghh-logo-no-bg.png';
?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'ghh' ); ?>">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<span class="burger-bun"></span>
		<span class="burger-meat"></span>
		<span class="burger-bun"></span>
		<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'ghh' ); ?></span>
	</button>

	<a class="menu-nav-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img src="<?php echo esc_url( $ghh_logo_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	</a>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-1',
			'menu_id'        => 'primary-menu',
		)
	);
	?>
</nav>

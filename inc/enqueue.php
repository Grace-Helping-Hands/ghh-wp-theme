<?php
/**
 * Front-end styles and scripts.
 *
 * Stylesheets are plain CSS (no build step — WP Pusher deploys the repo as-is).
 * Each file is versioned with its modification time so browsers pick up
 * changes immediately after a deploy.
 *
 * ORDER MATTERS: later files override earlier ones. Global styles first, then
 * layout, then page-specific files, then the footer.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Givebutter account ID used by the donation widgets embedded in page content.
 */
const GHH_GIVEBUTTER_ACCOUNT = 'oOytRyoev7vHl8Rv';

/**
 * Enqueue a theme stylesheet by path, versioned by modification time.
 *
 * @param string   $handle Handle without the "ghh-" prefix.
 * @param string   $path   Path from the theme root.
 * @param string[] $deps   Dependencies (full handles).
 */
function ghh_enqueue_style( $handle, $path, $deps = array() ) {
	wp_enqueue_style( 'ghh-' . $handle, get_template_directory_uri() . '/' . $path, $deps, ghh_asset_version( $path ) );
}

/**
 * Enqueue front-end assets.
 */
function ghh_enqueue_assets() {
	// Sofia Sans is served by WordPress (Appearance -> Editor -> Styles -> Typography -> Fonts), not by the theme.

	// 1. Base: reset, design tokens, typography.
	ghh_enqueue_style( 'reset', 'assets/css/base/reset.css' );
	ghh_enqueue_style( 'variables', 'assets/css/base/variables.css', array( 'ghh-reset' ) );
	ghh_enqueue_style( 'typography', 'assets/css/base/typography.css', array( 'ghh-variables' ) );

	// 2. Components + utilities used by page content (editors apply these classes to blocks).
	ghh_enqueue_style( 'backgrounds', 'assets/css/components/backgrounds.css', array( 'ghh-typography' ) );
	ghh_enqueue_style( 'buttons', 'assets/css/components/buttons.css', array( 'ghh-variables' ) );
	ghh_enqueue_style( 'cta', 'assets/css/components/cta.css', array( 'ghh-buttons' ) );
	ghh_enqueue_style( 'spacings', 'assets/css/components/spacing.css', array( 'ghh-variables' ) );
	ghh_enqueue_style( 'forms', 'assets/css/components/forms.css', array( 'ghh-variables' ) );
	ghh_enqueue_style( 'helpers', 'assets/css/utilities/helpers.css', array( 'ghh-variables' ) );

	// Blog listing cards (home.php, archives, search).
	if ( is_home() || is_archive() || is_search() ) {
		ghh_enqueue_style( 'blog', 'assets/css/layout/blog.css', array( 'ghh-variables' ) );
		ghh_enqueue_style( 'cards', 'assets/css/components/cards.css', array( 'ghh-blog' ) );
	}

	// 3. Theme stylesheet (style.css header + body defaults) and global layout.
	ghh_enqueue_style( 'style', 'style.css', array( 'ghh-variables' ) );
	ghh_enqueue_style( 'containers', 'assets/css/layout/containers.css', array( 'ghh-style' ) );
	ghh_enqueue_style( 'header', 'assets/css/layout/header.css', array( 'ghh-containers' ) );

	// 4. Page-specific styles.
	if ( is_page_template( 'templates/page-newsletter.php' ) ) {
		ghh_enqueue_style( 'newsletter', 'assets/css/components/newsletter.css', array( 'ghh-header' ) );
	}

	if ( is_singular( 'post' ) ) {
		ghh_enqueue_style( 'post', 'assets/css/layout/post.css', array( 'ghh-header' ) );
	}

	if ( is_front_page() ) {
		ghh_enqueue_style( 'hero', 'assets/css/layout/hero.css', array( 'ghh-header' ) );
	}

	// 5. Footer last.
	ghh_enqueue_style( 'footer', 'assets/css/layout/footer.css', array( 'ghh-header' ) );

	// Scripts.
	wp_enqueue_script(
		'ghh-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		ghh_asset_version( 'assets/js/navigation.js' ),
		array( 'in_footer' => true )
	);

	// Givebutter donation widgets (<givebutter-button>, <givebutter-widget> in page content).
	wp_enqueue_script(
		'givebutter',
		'https://widgets.givebutter.com/latest.umd.cjs?acct=' . GHH_GIVEBUTTER_ACCOUNT,
		array(),
		null, // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- third-party "latest" bundle.
		array(
			'in_footer' => false,
			'strategy'  => 'async',
		)
	);

	// Links to #givebutter-CAMPAIGNID open that campaign's form in a pop-up (see the file header).
	wp_enqueue_script(
		'ghh-givebutter',
		get_template_directory_uri() . '/assets/js/givebutter.js',
		array(),
		ghh_asset_version( 'assets/js/givebutter.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_localize_script( 'ghh-givebutter', 'ghhGivebutter', array( 'fallbackUrl' => home_url( '/donate/' ) ) );
}
add_action( 'wp_enqueue_scripts', 'ghh_enqueue_assets' );

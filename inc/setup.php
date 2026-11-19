<?php
/**
 * Theme supports, menus, translations and editor styles.
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and menu locations.
 */
function ghh_setup() {
	load_theme_textdomain( 'ghh', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'responsive-embeds' );

	// Load the front-end design tokens and component styles inside the block
	// editor so editors see the same colors, fonts, buttons and spacing helpers.
	add_theme_support( 'editor-styles' );
	add_editor_style( ghh_editor_style_files() );

	// Brand colors and sizes in the block editor's color/size pickers.
	// Registered here (not theme.json) on purpose: adding a theme.json switches
	// WordPress to block-theme layout rules that re-position existing content.
	add_theme_support( 'editor-color-palette', ghh_editor_color_palette() );
	add_theme_support( 'editor-font-sizes', ghh_editor_font_sizes() );
	// Keep WordPress's default palette and sizes too — existing content uses
	// classes such as has-black-color and has-large-font-size.
	add_theme_support( 'default-color-palette' );
	add_theme_support( 'default-font-sizes' );

	// Location slugs are stored in the database (theme_mods) — don't rename them.
	register_nav_menus(
		array(
			'menu-1'            => __( 'Primary', 'ghh' ),
			'extra-footer-menu' => __( 'Extra Footer Menu', 'ghh' ),
		)
	);
}
add_action( 'after_setup_theme', 'ghh_setup' );

/**
 * Pages use the excerpt as the hero / page intro text (see front/hero.php, home.php).
 */
function ghh_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'ghh_page_excerpts' );

/**
 * New blog posts start with an empty paragraph and the small donate CTA at the end.
 *
 * Editors write above it, change its link, or delete it like any other block.
 * Existing posts are not changed. To stop adding it, remove this function.
 */
function ghh_post_starter_content() {
	$post_type = get_post_type_object( 'post' );
	if ( ! $post_type ) {
		return;
	}

	$post_type->template = array(
		array( 'core/paragraph', array( 'placeholder' => __( 'Start writing your post…', 'ghh' ) ) ),
		array( 'core/pattern', array( 'slug' => 'ghh/blog-cta-form' ) ),
	);
}
add_action( 'init', 'ghh_post_starter_content', 20 );

/**
 * Stylesheets loaded into the block editor (paths relative to the theme root).
 *
 * Only shared, content-facing styles belong here — not header/footer/layout.
 *
 * @return string[]
 */
function ghh_editor_style_files() {
	return array(
		'assets/css/base/variables.css',
		'assets/css/base/typography.css',
		'assets/css/components/backgrounds.css',
		'assets/css/components/buttons.css',
		'assets/css/components/cta.css',
		'assets/css/components/spacing.css',
		'assets/css/utilities/helpers.css',
		'assets/css/layout/containers.css',
		'assets/css/editor.css',
	);
}

/**
 * Brand colors offered in the block editor (values match assets/css/base/variables.css).
 *
 * Slugs are prefixed so they never clash with WordPress's default palette.
 * Don't rename a slug once it's in use: blocks store it as a class (has-ghh-*-color).
 *
 * @return array[]
 */
function ghh_editor_color_palette() {
	$colors = array(
		'ghh-berry'         => array( __( 'Berry', 'ghh' ), '#883A64' ),
		'ghh-berry-dark'    => array( __( 'Berry dark', 'ghh' ), '#702C50' ),
		'ghh-berry-light'   => array( __( 'Berry light', 'ghh' ), '#F8EFF4' ),
		'ghh-green'         => array( __( 'Green', 'ghh' ), '#286E60' ),
		'ghh-green-dark'    => array( __( 'Green dark', 'ghh' ), '#20594D' ),
		'ghh-green-light'   => array( __( 'Green light', 'ghh' ), '#EDF5F2' ),
		'ghh-heading'       => array( __( 'Heading plum', 'ghh' ), '#40152C' ),
		'ghh-body'          => array( __( 'Body text', 'ghh' ), '#30212B' ),
		'ghh-gold'          => array( __( 'Honey gold (accent, dark text only)', 'ghh' ), '#E3B23C' ),
		'ghh-gold-light'    => array( __( 'Gold light', 'ghh' ), '#FBF1D6' ),
		'ghh-apricot'       => array( __( 'Apricot (accent, dark text only)', 'ghh' ), '#F2A65A' ),
		'ghh-apricot-light' => array( __( 'Apricot light', 'ghh' ), '#FDEBD9' ),
		'ghh-cream'         => array( __( 'Cream (section background)', 'ghh' ), '#FBF3E4' ),
		'ghh-primary'       => array( __( 'Brand brown', 'ghh' ), '#461312' ),
		'ghh-eyebrow'       => array( __( 'Section label brown', 'ghh' ), '#724227' ),
	);

	$palette = array();
	foreach ( $colors as $slug => $color ) {
		$palette[] = array(
			'slug'  => $slug,
			'name'  => $color[0],
			'color' => $color[1],
		);
	}

	return $palette;
}

/**
 * Font sizes offered in the block editor — the sizes editors set by hand most often.
 *
 * @return array[]
 */
function ghh_editor_font_sizes() {
	return array(
		array(
			'slug' => 'ghh-label',
			'name' => __( 'Section label (16px)', 'ghh' ),
			'size' => 16,
		),
		array(
			'slug' => 'ghh-body-large',
			'name' => __( 'Body large (18px)', 'ghh' ),
			'size' => 18,
		),
		array(
			'slug' => 'ghh-section-heading',
			'name' => __( 'Section heading (32px)', 'ghh' ),
			'size' => 32,
		),
	);
}

<?php
/**
 * Appearance -> Customize -> Theme Options.
 *
 * Content that appears in the coded parts of the theme (hero buttons, footer,
 * social links) is editable here. Defaults match the values that used to be
 * hardcoded, so nothing changes until an editor saves a new value.
 *
 * Read values in templates with ghh_get_option( 'key' ).
 *
 * @package ghh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Option definitions: key => [ label, default, type, section ].
 *
 * Types: 'text' (plain text), 'url' (any absolute or site-relative URL), 'email'.
 *
 * @return array<string, array{label: string, default: string, type: string, section: string}>
 */
function ghh_option_definitions() {
	return array(
		// Front page hero.
		'hero_primary_label'   => array( __( 'Primary button label', 'ghh' ), 'Donate Today', 'text', 'hero' ),
		'hero_primary_url'     => array( __( 'Primary button link', 'ghh' ), '/donate', 'url', 'hero' ),
		'hero_secondary_label' => array( __( 'Secondary button label', 'ghh' ), 'Learn More', 'text', 'hero' ),
		'hero_secondary_url'   => array( __( 'Secondary button link', 'ghh' ), '#about-us', 'url', 'hero' ),

		// Footer.
		'footer_tagline'       => array( __( 'Tagline', 'ghh' ), 'Restoring dignity, one hygiene kit at a time', 'text', 'footer' ),
		'newsletter_heading'   => array( __( 'Newsletter heading', 'ghh' ), 'JOIN OUR NEWSLETTER', 'text', 'footer' ),
		'newsletter_label'     => array( __( 'Newsletter button label', 'ghh' ), 'Stay Connected', 'text', 'footer' ),
		'newsletter_url'       => array( __( 'Newsletter sign-up link', 'ghh' ), 'https://forms.office.com/r/EWuCT5BQRG', 'url', 'footer' ),
		'contact_email'        => array( __( 'Contact email', 'ghh' ), 'info@gracehelpinghands.org', 'email', 'footer' ),
		'ein'                  => array( __( 'EIN', 'ghh' ), '99-1834022', 'text', 'footer' ),
		'cfc_url'              => array( __( 'Combined Federal Campaign link', 'ghh' ), 'https://cfcgiving.opm.gov/welcome', 'url', 'footer' ),
		'cfc_code'             => array( __( 'CFC charity code', 'ghh' ), '27498', 'text', 'footer' ),
		'feedback_url'         => array( __( 'Website feedback form link', 'ghh' ), 'https://forms.office.com/r/b9eNgfc2Qu', 'url', 'footer' ),
		'transparency_url'     => array( __( 'Transparency badge link', 'ghh' ), 'https://app.candid.org/profile/15896753/grace-helping-hands-inc-99-1834022', 'url', 'footer' ),
		// Official seal served by Candid (updates automatically when the seal level/year changes).
		'transparency_image'   => array( __( 'Transparency badge image (from Candid)', 'ghh' ), 'https://widgets.guidestar.org/prod/v1/pdp/transparency-seal/15896753/svg', 'url', 'footer' ),
		'transparency_alt'     => array( __( 'Transparency badge description', 'ghh' ), 'Gold Transparency Standard 2026', 'text', 'footer' ),

		// Social profiles (leave a field empty to hide that icon).
		'social_facebook'      => array( 'Facebook', 'https://www.facebook.com/p/Grace-Helping-Hands-Inc-61566737904322/', 'url', 'social' ),
		'social_instagram'     => array( 'Instagram', 'https://www.instagram.com/gracehh_org', 'url', 'social' ),
		'social_tiktok'        => array( 'TikTok', 'https://www.tiktok.com/@gracehh_org', 'url', 'social' ),
		'social_x'             => array( 'X', 'https://x.com/gracehh_org', 'url', 'social' ),
		'social_linkedin'      => array( 'LinkedIn', 'https://www.linkedin.com/company/gracehh-org', 'url', 'social' ),
	);
}

/**
 * Get a theme option, falling back to its default.
 *
 * Returns the raw stored value — escape on output.
 *
 * @param string $key Option key from ghh_option_definitions().
 * @return string
 */
function ghh_get_option( $key ) {
	$definitions = ghh_option_definitions();
	$default     = isset( $definitions[ $key ] ) ? $definitions[ $key ][1] : '';

	return (string) get_theme_mod( 'ghh_' . $key, $default );
}

/**
 * Resolve a URL option: site-relative paths ("/donate", "#about-us") are
 * resolved against the home URL, absolute URLs are returned as-is.
 *
 * @param string $key Option key.
 * @return string Unescaped URL ('' when empty).
 */
function ghh_get_url_option( $key ) {
	$value = trim( ghh_get_option( $key ) );

	if ( '' === $value ) {
		return '';
	}

	if ( preg_match( '#^(/(?!/)|\#)#', $value ) ) {
		return home_url( $value );
	}

	return $value;
}

/**
 * Sanitize a URL option. Allows site-relative paths and anchors as well as
 * absolute http(s)/mailto URLs.
 *
 * @param string $value Raw input.
 * @return string
 */
function ghh_sanitize_url_option( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}

	if ( preg_match( '#^(/(?!/)|\#)#', $value ) ) {
		return sanitize_text_field( $value );
	}

	return esc_url_raw( $value, array( 'http', 'https', 'mailto' ) );
}

/**
 * Register the Theme Options panel.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function ghh_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'ghh_theme_options',
		array(
			'title'    => __( 'Theme Options', 'ghh' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'hero'   => __( 'Front Page Hero', 'ghh' ),
		'footer' => __( 'Footer', 'ghh' ),
		'social' => __( 'Social Links', 'ghh' ),
	);

	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			'ghh_' . $id,
			array(
				'title' => $title,
				'panel' => 'ghh_theme_options',
			)
		);
	}

	$sanitizers = array(
		'text'  => 'sanitize_text_field',
		'url'   => 'ghh_sanitize_url_option',
		'email' => 'sanitize_email',
	);

	foreach ( ghh_option_definitions() as $key => $definition ) {
		list( $label, $default, $type, $section ) = $definition;

		$wp_customize->add_setting(
			'ghh_' . $key,
			array(
				'default'           => $default,
				'sanitize_callback' => $sanitizers[ $type ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'ghh_' . $key,
			array(
				'label'   => $label,
				'section' => 'ghh_' . $section,
				'type'    => 'email' === $type ? 'email' : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'ghh_customize_register' );

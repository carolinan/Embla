<?php
/**
 *  Embla Theme Customizer.
 *
 * @package Embla
 */

/**
 * Add settings and controls for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function embla_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->add_section( 'embla_options', array(
		'title' => __( 'Theme Options', 'embla' ),
		'priority' => 90,
	) );

	/* Theme options */
	$wp_customize->add_setting( 'embla_postnav', array(
		'sanitize_callback' => 'embla_sanitize_checkbox',
	) );

	$wp_customize->add_control('embla_postnav', array(
		'type' => 'checkbox',
		'label' => __( 'Check this box to hide the next and previous post navigation for single posts.', 'embla' ),
		'section' => 'embla_options',
	) );

	$wp_customize->add_setting( 'embla_show_meta', array(
		'sanitize_callback' => 'embla_sanitize_checkbox',
	) );

	$wp_customize->add_control('embla_show_meta', array(
		'type' => 'checkbox',
		'label' => __( 'Check this box to display meta information (author, category, date) in archives.', 'embla' ),
		'section' => 'embla_options',
	) );

	$wp_customize->add_setting( 'embla_hide_credits', array(
		'sanitize_callback' => 'embla_sanitize_checkbox',
	) );

	$wp_customize->add_control('embla_hide_credits', array(
		'type' => 'checkbox',
		'label' => __( 'Check this box to hide the footer credit links. :(', 'embla' ),
		'section' => 'embla_options',
	) );

	$wp_customize->add_setting( 'embla_accent_color', array(
		'default'        => '#0073AA',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'embla_accent_color', array(
		'label'    => __( 'Accent color', 'embla' ),
		'section'  => 'colors',
		'priority' => 100,
	) ) );

}

add_action( 'customize_register', 'embla_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function embla_customize_preview_js() {
	wp_enqueue_script( 'embla_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20170910', true );
}
add_action( 'customize_preview_init', 'embla_customize_preview_js' );

/**
 * Checkbox sanitization callback, from https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function embla_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function embla_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

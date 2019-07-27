<?php
/**
 * Embla Theme Customizer -Icons
 *
 * @package Embla
 */

/**
 * Enqueue the customizer stylesheet for our radio buttons.
 */
if ( ! function_exists( 'embla_customizer_icon_stylesheet' ) ) {
	function embla_customizer_icon_stylesheet() {
		wp_enqueue_style( 'embla-customizer-css', get_template_directory_uri() . '/css/customizer.css' );
	}
}
add_action( 'customize_controls_print_styles', 'embla_customizer_icon_stylesheet' );


$embla_icon_list = array( 'activity', 'art', 'category', 'chat', 'close', 'comment', 'day', 'document', 'edit', 'editor-video', 'ellipsis', 'heart', 'help', 'info', 'image', 'location', 'mail', 'microphone', 'paintbrush', 'standard', 'star-empty', 'wordpress' );


if ( ! function_exists( 'embla_customize_register_icon' ) ) {
	/**
	 * Register our customizer settings.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function embla_customize_register_icon( $wp_customize ) {

		/**
		 * Custom control for our icons.
		 */
		class Embla_Icon_Control extends WP_Customize_Control {
			/**
			 * Create a fieldset, labels and radio buttons for our dashicons.
			 */
			public function render_content() {
				require get_template_directory() . '/images/svg-icons.svg';

				global $embla_icon_list;

				?>
				<div class="embla-radio-buttons">
					<fieldset>
					<legend class="customize-control-title"><?php echo esc_html( $this->label ); ?></legend>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
					foreach ( $embla_icon_list as &$value ) {
					?>
						<label>
						<?php echo '<span class="screen-reader-text">' . esc_html_x( 'Icon name: ', 'There is a space after the colon', 'embla' ) . esc_html( $value ) . '</span>'; ?>
						<?php echo embla_get_svg( array( 'icon' => $value ) ); ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						</label>
					<?php
					}
					?>
					</fieldset>
				</div>
				<?php
			}
		}

		$wp_customize->add_setting(
			'embla_header_icon',
			array(
				'sanitize_callback' => 'embla_validate_icons',
				'default' => 'wordpress',
			)
		);

		$wp_customize->add_control(
			new Embla_Icon_Control(
				$wp_customize,
				'embla_header_icon',
				array(
					'label'    => __( 'Custom Icon', 'embla' ),
					'section'  => 'embla_icon_options',
					'settings' => 'embla_header_icon',
					'priority' => 100,
				)
			)
		);

		$wp_customize->add_setting(
			'embla_icon_color',
			array(
				'default'           => '#000000',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'embla_icon_color',
				array(
					'label'    => __( 'Icon color', 'embla' ),
					'section'  => 'embla_icon_options',
					'settings' => 'embla_icon_color',
					'priority' => 100,
				)
			)
		);

		$wp_customize->add_setting(
			'embla_show_header_icon',
			array(
				'sanitize_callback' => 'embla_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'embla_show_header_icon',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Show the icon in the header.', 'embla' ),
				'section'  => 'embla_icon_options',
				'priority' => 110,
			)
		);

		$wp_customize->add_setting(
			'embla_show_footer_icon',
			array(
				'sanitize_callback' => 'embla_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'embla_show_footer_icon',
			array(
				'type'     => 'checkbox',
				'label'    => __( 'Show the icon in the footer.', 'embla' ),
				'section'  => 'embla_icon_options',
				'priority' => 110,
			)
		);

	}
}
add_action( 'customize_register', 'embla_customize_register_icon' );

if ( ! function_exists( 'embla_validate_icons' ) ) {
	/**
	 * Sanitize and validate the icons.
	 */
	function embla_validate_icons( $input ) {
		global $embla_icon_list;
		$input = sanitize_key( $input );
		return ( in_array( $input, $embla_icon_list, true ) ? $input : 'wordpress' );
	}
}

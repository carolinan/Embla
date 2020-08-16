<?php
/**
 * Embla Post Meta
 *
 * @package Embla
 * @since 1.6
 */

/**
 * Allows the user to display the header on individual posts or pages.
 *
 * @param int $value post id.
 *
 * @link Thanks to https://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */
function embla_get_meta( $value ) {
	if ( is_home() ) {
		$postid = get_option( 'page_for_posts' );
	} else {
		$postid = get_the_ID();
	}

	$field = get_post_meta( $postid, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

/**
 * Add meta box to the editor.
 */
function embla_add_meta_boxes() {
	$screens = array( 'post', 'page', 'jetpack-portfolio', 'jetpack-testimonial' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'header_settings',
			__( 'Header image settings', 'embla' ),
			'embla_meta_form',
			$screen,
			'side'
		);
	}
}
add_action( 'add_meta_boxes', 'embla_add_meta_boxes' );

/**
 * Add The form in the post meta section.
 *
 * @param int $post post id.
 */
function embla_meta_form( $post ) {
	wp_nonce_field( '_header_settings_nonce', 'embla_meta_nonce' ); ?>
	<p>
	<input type="checkbox" name="embla_featured_image_header" id="embla_featured_image_header" value="featured-image-header" 
	<?php echo ( embla_get_meta( 'embla_featured_image_header' ) === 'featured-image-header' ) ? 'checked' : ''; ?>>
	<label for="embla_featured_image_header">
		<?php esc_html_e( 'Use the featured image as a header image.', 'embla' ); ?>
	</label>
	</p>
	<?php
}

/**
 * Save the post meta.
 *
 * @param int $post_id post id.
 */
function embla_header_settings_save( $post_id ) {
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check if our nonce is set and verify that the nonce is valid.
	if ( ! isset( $_POST['embla_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['embla_meta_nonce'] ), '_header_settings_nonce' ) ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Use featured Image.
	if ( isset( $_POST['embla_featured_image_header'] ) ) {
		update_post_meta( $post_id, 'embla_featured_image_header', sanitize_text_field( wp_unslash( $_POST['embla_featured_image_header'] ) ) );
	} else {
		update_post_meta( $post_id, 'embla_featured_image_header', null );
	}

}
add_action( 'save_post', 'embla_header_settings_save' );

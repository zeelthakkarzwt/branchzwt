<?php
/**
 * Plugin Name: Zeel Custom Own Field
 * Plugin URI: https://metabox.io
 * Description: A simple plugin for custom fields.
 * Version: 1.0
 * Author: Meta Box
 * Author URI: https://metabox.io
 * License: GPL2
 */


 /**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function hcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'hcf_author',
        'hcf_published_date',
        'hcf_price',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
    
}
add_action( 'save_post', 'hcf_save_meta_box' );


// Example: Adding a custom shortcode
function custom_shortcode_function() {
    return 'Hello, this is a custom shortcode!';
}
add_shortcode('custom_shortcode', 'custom_shortcode_function');


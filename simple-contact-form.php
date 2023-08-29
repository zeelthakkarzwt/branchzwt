<?php
/*
Plugin Name: Simple Contact Form
Description: A basic contact form plugin.
Version: 1.0
Author: Zeel Thakkar
*/

// Include the form HTML
function simple_contact_form_shortcode() {
    ob_start();
    include 'form-template.php';
    return ob_get_clean();
}
add_shortcode('simple_contact_form', 'simple_contact_form_shortcode');



// Process form submissions
function process_contact_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'process_contact_form') {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        // Send email
        $to = 'your@email.com';
        $subject = 'New Contact Form Submission';
        $headers = "From: $name <$email>";
        $body = "Name: $name\nEmail: $email\n\n$message";

        wp_mail($to, $subject, $body, $headers);
    }
}
add_action('admin_post_process_contact_form', 'process_contact_form');
add_action('admin_post_nopriv_process_contact_form', 'process_contact_form'); // For non-logged-in users

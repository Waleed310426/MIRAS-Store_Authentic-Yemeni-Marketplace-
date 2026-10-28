<?php
define('ABSPATH', 'c:/Users/Qursan/Local Sites/miras/app/public/');
require_once('c:/Users/Qursan/Local Sites/miras/app/public/wp-load.php');
global $wpdb;

// Let's find forms (either elementor data on the contact page or metform forms)
$page = get_page_by_path('contact-2');
if ($page) {
    echo "Contact Page ID: " . $page->ID . "\n";
    $elementor_data = get_post_meta($page->ID, '_elementor_data', true);
    if ($elementor_data) {
        echo "Elementor data found on Contact page.\n";
        // Check if there's an email setting in the raw JSON
        if (strpos($elementor_data, 'Waleedalansi2023@gmail.com') !== false) {
             echo "Email already in Elementor data.\n";
        }
    }
}

// Check MetForm forms
$forms = get_posts(array(
    'post_type' => 'metform-form',
    'numberposts' => -1
));

if ($forms) {
    foreach ($forms as $form) {
        echo "\nMetForm Found - ID: " . $form->ID . " | Title: " . $form->post_title . "\n";
        $settings = get_post_meta($form->ID, 'mf_form_settings', true);
        if ($settings) {
            echo "Current Email To: " . (isset($settings['mf_admin_email_to']) ? $settings['mf_admin_email_to'] : 'Not set') . "\n";
        }
    }
} else {
    echo "\nNo MetForm forms found.\n";
}
?>

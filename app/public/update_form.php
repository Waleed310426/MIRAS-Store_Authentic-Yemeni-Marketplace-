<?php
define('ABSPATH', 'c:/Users/Qursan/Local Sites/miras/app/public/');
require_once('c:/Users/Qursan/Local Sites/miras/app/public/wp-load.php');
global $wpdb;

$page = get_page_by_path('contact-2');
if (!$page) {
    die("Contact page not found.\n");
}

$elementor_data = get_post_meta($page->ID, '_elementor_data', true);
if (!$elementor_data) {
    die("No Elementor data found for the contact page.\n");
}

$data = json_decode($elementor_data, true);
$updated = false;

function update_elementor_form_email(&$elements) {
    global $updated;
    foreach ($elements as &$element) {
        if (isset($element['widgetType']) && $element['widgetType'] === 'form') {
            if (isset($element['settings'])) {
                // Update email_to
                $element['settings']['email_to'] = 'Waleedalansi2023@gmail.com';
                $updated = true;
                echo "Updated form widget ID: " . $element['id'] . "\n";
            }
        }
        if (isset($element['elements']) && is_array($element['elements'])) {
            update_elementor_form_email($element['elements']);
        }
    }
}

update_elementor_form_email($data);

if ($updated) {
    // Save back to DB
    $new_json = wp_slash(wp_json_encode($data));
    update_post_meta($page->ID, '_elementor_data', $new_json);
    echo "Successfully updated the form email to Waleedalansi2023@gmail.com.\n";
} else {
    echo "No form widget found in the Elementor data, or it's not a standard Elementor Form widget.\n";
}
?>

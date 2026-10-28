<?php
define('ABSPATH', 'c:/Users/Qursan/Local Sites/miras/app/public/');
require_once('c:/Users/Qursan/Local Sites/miras/app/public/wp-load.php');
global $wpdb;
$page = get_page_by_path('contact-2');
if ($page) {
    echo "Title: " . $page->post_title . "\n";
    echo "Content:\n" . $page->post_content . "\n";
} else {
    echo "Page not found.";
}
?>

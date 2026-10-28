<?php
define('ABSPATH', 'c:/Users/Qursan/Local Sites/miras/app/public/');
require_once('c:/Users/Qursan/Local Sites/miras/app/public/wp-load.php');
$page = get_post(29);
if ($page) {
    echo "Content:\n" . $page->post_content . "\n";
} else {
    echo "Page not found.\n";
}
?>

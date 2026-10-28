<?php
$content = file_get_contents('C:\Users\Qursan\Local Sites\miras\app\public\wp-content\themes\miras\front-page.php');
// Delete the old static featured collections grid section
$content = preg_replace('/<section class="miras-featured-section">\s*<div class="miras-container">\s*<div class="miras-section-header.*?<div class="miras-featured-grid">.*?<\/section>/s', '', $content);
file_put_contents('C:\Users\Qursan\Local Sites\miras\app\public\wp-content\themes\miras\front-page.php', $content);
echo "Deleted.";
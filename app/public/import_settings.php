<?php
require_once('wp-load.php');
$json = file_get_contents('C:/Users/Qursan/Local Sites/miras/app/public/seo_search_settings.json');
if (!$json) { die('No file found'); }
$data = json_decode($json, true);
foreach($data['rank_math'] as $row) {
    update_option($row['option_name'], maybe_unserialize($row['option_value']));
}
foreach($data['fibo_search'] as $row) {
    update_option($row['option_name'], maybe_unserialize($row['option_value']));
}
echo 'Import done!';

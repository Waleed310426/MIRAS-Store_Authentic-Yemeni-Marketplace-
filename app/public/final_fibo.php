<?php
require_once("wp-load.php");
// One final check on the settings
$settings = get_option("dgwt_wcas_settings");
echo $settings["enqueue_js_css_everywhere"];
?>

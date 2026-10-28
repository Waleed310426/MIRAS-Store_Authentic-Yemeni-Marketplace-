<?php
require_once("wp-load.php");
$settings = get_option("dgwt_wcas_settings", []);
$settings["enqueue_js_css_everywhere"] = "on";
update_option("dgwt_wcas_settings", $settings);
echo "Setting updated.";
?>

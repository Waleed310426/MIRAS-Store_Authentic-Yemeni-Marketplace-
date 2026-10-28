<?php
require_once("wp-load.php");
if (class_exists("\Elementor\Plugin")) {
    \Elementor\Plugin::$instance->files_manager->clear_cache();
    echo "Elementor cache cleared.";
}
if (function_exists("DGWT_WCAS")) {
    DGWT_WCAS()->indexer->buildIndex();
}
?>

<?php
require_once("wp-load.php");
if (class_exists("DGWT_WCAS_Indexer")) {
    $indexer = new DGWT_WCAS_Indexer();
    $indexer->buildIndex();
    echo "Index built (method 1).";
} elseif (function_exists("DGWT_WCAS")) {
    DGWT_WCAS()->indexer->buildIndex();
    echo "Index built (method 2).";
} else {
    echo "FiboSearch classes not found.";
}
?>

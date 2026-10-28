<?php
require_once('wp-load.php');
$nonce = wp_create_nonce( 'dgwt_wcas_build_index' );
echo $nonce;

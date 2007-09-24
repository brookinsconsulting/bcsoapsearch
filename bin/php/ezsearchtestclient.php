<?php

include_once( 'extension/bcsoapsearch/services/bcsoapsearch.methods.php' );

// static variable settings
$searchStr = 'Cache';

$results = search( $searchStr );
print_r( $results );

?>
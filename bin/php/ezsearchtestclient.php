<?php

include_once( 'extension/bcsoapsearch/nusoap/bcsoapsearch.methods.php' );

// variables
$searchStr = 'Cache';
$searchLimit = 3;
$searchOffset = 0;
$results = search( $searchStr, $searchLimit, $searchOffset );
print_r( $results );

?>
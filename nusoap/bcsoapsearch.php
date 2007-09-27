<?php

include_once( 'extension/bcsoapsearch/nusoap/bcsoapsearch.methods.php' );

// Add soap server complex type, Result

$server->wsdl->addComplexType(
    'Result',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'title' => array('name'=>'title','type'=>'xsd:string'),
        'description' => array('name'=>'description','type'=>'xsd:string'),
        'url' => array('name'=>'url','type'=>'xsd:string'),
    )
);

// Add soap server complex type, ResultSet

$server->wsdl->addComplexType(
    'ResultSet',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Result[]')
    ),
    'tns:Result'
);


// Register soap server method, search_ez

$server->register( 'search_ez',
                   array( 'searchStr' => 'xsd:string', 'searchOffset' => 'xsd:string', 'searchLimit' => 'xsd:string' ),
                   array( 'result_set' => 'tns:ResultSet' ),
                   'urn:bcsoapsearch',
                   'urn:bcsoapsearch#search_ez',
                   'rpc',
                   'encoded',
                   'Returns search string'
                 );

// Register function, search_ez

function search_ez( $searchStr, $searchLimit = 2, $searchOffset = 0 )
{
    $results = search( $searchStr,  $searchLimit, $searchOffset );
    return $results;
}


// Register soap server method, search_ezpedia
$server->register( 'search_ezpedia',
                   array( 'searchStr' => 'xsd:string', 'searchOffset' => 'xsd:string', 'searchLimit' => 'xsd:string' ),
                   array( 'result_set' => 'tns:ResultSet' ),
                   'urn:ezpediasoapsearch',
                   'urn:ezpediasoapsearch#search_ezpedia',
                   'rpc',
                   'encoded',
                   'Returns search string'
                 );

// Register function, search_ezpedia

function search_ezpedia( $searchStr, $searchLimit = 2, $searchOffset = 0 )
{
    $results = search( $searchStr,  $searchLimit, $searchOffset );
    return $results;
}

?>
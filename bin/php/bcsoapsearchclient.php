#!/usr/bin/env php
<?php

require_once 'autoload.php';

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => 'BCSoapSearchTest SOAP client',
                                      'use-session' => false,
                                      'use-modules' => false,
                                      'use-extensions' => true ) );

$script->startup( );

$options = $script->getOptions( '[show-request][show-response]', '[WSDL_URI][NAME][LIMIT][OFFSET]', array( 'show-request' => 'show the SOAP HTTP request', 'show-response' => 'show the SOAP HTTP response' ) );

$script->initialize( );

// check argument count
if ( count( $options['arguments'] ) < 4 )
{
    $script->shutdown( 1, 'wrong argument count' );
}

$wsdlUri = $options['arguments'][0];
$searchStr = $options['arguments'][1];
$searchLimit = $options['arguments'][2];
$searchOffset = $options['arguments'][3];

require_once 'extension/nusoap/classes/nusoap.php';

$client = new nusoap_client( $wsdlUri, true );

$err = $client->getError( );

if ( $err )
{
    $script->shutdown( 1, $err );
}

$result = $client->call( 'search_ez',
                         array( 'searchStr' => $searchStr ),
                         array( 'searchLimit' => $searchLimit ),
                         array( 'searchOffset' => $searchOffset )
                       );

if ( $options['show-request'] )
{
    $cli->output( 'SOAP request:' );
    $cli->output( $client->request );
}

if ( $options['show-response'] )
{
    $cli->output( 'SOAP response:' );
    $cli->output( $client->response );
}

if ( $client->fault )
{
    $script->shutdown( 1, $result );
}

$err = $client->getError( );

if ( $err )
{
    $script->shutdown( 1, $err );
}

print_r( $result );
// $cli->output( $result );

$script->shutdown( 0 );

?>

<?php

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


$server->register( 'search_more',
                   array( 'searchStr' => 'xsd:string' ),
                   array('result_set' => 'tns:ResultSet'),
                   'urn:bcsoapsearch',
                   'urn:bcsoapsearch#hello',
                   'rpc',
                   'encoded',
                   'Returns search string'
                 );

$server->register( 'search_static',
                   array( 'searchStr' => 'xsd:string' ),
                   array('result_set' => 'tns:ResultSet'),
                   'urn:bcsoapsearch',
                   'urn:bcsoapsearch#hello',
                   'rpc',
                   'encoded',
                   'Returns search string'
                 );

$server->register( 'search_ez',
                   array( 'searchStr' => 'xsd:string' ),
                   array( 'result_set' => 'tns:ResultSet' ),
                   'urn:bcsoapsearch',
                   'urn:bcsoapsearch#hello',
                   'rpc',
                   'encoded',
                   'Returns search string'
                 );


function search_ezcontenttree( $searchStr )
{
  include_once( "kernel/classes/ezsearch.php" );

  // TODO: Replace these with ini settings, bcsoapsearch.ini.append.php

  // $maximumSearchLimit = $ini->variable( 'SearchSettings', 'MaximumSearchLimit' );
  $searchText = $searchStr;

  $searchSectionID = -1;
  $searchType = "fulltext";

  $searchTimestamp = false;
  // $subTreeArray = array();
  $subTreeArray[] = 1;

  $pageLimit = 5;
  $Offset = 0;

  $searchResult = eZSearch::search( $searchText, array( "SearchType" => $searchType,
							"SearchSectionID" => $searchSectionID,
							"SearchSubTreeArray" => $subTreeArray,
							'SearchTimestamp' => $searchTimestamp,
							"SearchLimit" => $pageLimit,
							"SearchOffset" => $Offset ) );

  // print_r( $searchResult );
  // return $searchResult;
  return $searchResult['SearchResult'];
  }


  function search( $searchStr )
  {
      // fetch settings
      $sini =& eZINI::instance( 'bcsoapsearch.ini' );
      $prefix = $sini->variable( 'BcSoapSearchSettings', 'DocumentUrlPrefix');

      // search content tree for string
      $results = search_ezcontenttree( $searchStr );
      $resultsArray = array();
      $i = 0;

      foreach( $results as $result )
      {
        $contentObject = $result->object();
        $obj =& $contentObject;
	$dm = $obj->dataMap();

	$name = $obj->name();
	$link = $prefix . $result->urlAlias();
	$description =& $name;

	$resultsArray[] = array( 'title' => $name, 'url' => $link, 'description' => $description );
	$i++;
      }

      // print_r( $resultsArray );
      return $resultsArray;
  }


function search_ez( $searchStr )
{
  include_once( 'extension/bcsoapsearch/services/bcsoapsearch.ez.php');

  $results = search( $searchStr );
  $result_set = & $results;
  // $result_set = array( $searchStr, $searchStr ); // & $results;
  // print_r( $results ); die();


  // $result_set = search_static( $searchStr);

  return $result_set;
}


function search_static( $searchStr )
{
    $result = array( 'title' => "This is the title",
                     'description' => "This is the description",
                     'url' => "http://test.com"
                   );
    $result_set = array($result,$result,$result,$result);
    return $result_set;
}


function search_more( $searchStr )
{
    $result = array( 'title' => "This is the title",
                     'description' => "This is the description",
                     'url' => "http://test.com"
                   );
    $result_set = array($result,$result,$result,$result);
    return $result_set;
}

?>
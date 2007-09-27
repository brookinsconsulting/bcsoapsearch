<?php

function search_ezcontenttree( $searchStr, $searchLimit = 2, $searchOffset = 0 )
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

   $Offset = $searchOffset;
   $pageLimit = $searchLimit;
   // $pageLimit = 1, 2, 3 or 5;

   $searchResult = eZSearch::search( $searchText, array( "SearchType" => $searchType,
	 						 "SearchSectionID" => $searchSectionID,
							 "SearchSubTreeArray" => $subTreeArray,
							 "SearchTimestamp" => $searchTimestamp,
							 "SearchLimit" => $pageLimit,
							 "SearchOffset" => $Offset ) );
  return $searchResult['SearchResult'];
}

function search( $searchStr, $searchLimit = 2, $searchOffset = 0 )
{
      include_once( "lib/ezutils/classes/ezini.php" );   

      // fetch settings
      $sini =& eZINI::instance( 'bcsoapsearch.ini' );
      $prefix = $sini->variable( 'BcSoapSearchSettings', 'DocumentUrlPrefix');

      // search content tree for string
      $results = search_ezcontenttree( $searchStr, $searchLimit, $searchOffset );
      $resultsArray = array();
      $i = 0;

      foreach( $results as $result )
      {
        $contentObject = $result->object();
        $obj =& $contentObject;
	// $dm = $obj->dataMap();
	$name = $obj->name();
	$link = $prefix . $result->urlAlias();
	$description =& $name;

	$resultsArray[] = array( 'title' => $name, 'url' => $link, 'description' => $description );
	$i++;
      }

      return $resultsArray;
}

?>
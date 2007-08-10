<?

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
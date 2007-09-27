<?php
class bcsoapsearchInfo
{
    function info()
    {
        return array(
		     'Name' => "BCSoapSearch",
		     'Version' => "0.1",
		     'Copyright' => "Copyright (C) 2007 Brookins Consulting",
		     'Author' => "Brookins Consulting",
		     'License' => "GNU General Public License v2.0 or greater at your option",
		     'Requires the following third-party software' => 
		     array( 'Name' => 'NuSOAP eZ publish integration',
			    'Version' => '1.0 (svn rev. unknown)',
			    'License' => 'GNU Lesser General Public License v2.0',
			    'Subversion' => 'http://pubsvn.ez.no/community/trunk/extension/nusoap/',
			    'More information' => 'http://ezpedia.org/wiki/en/ez/nusoap'
			    ),
		     array( 'Name' => 'NuSOAP',
			    'Version' => '0.7.2 (cvs rev. 1.95)',
			    'License' => 'GNU Lesser General Public License',
			    'More information' => 'http://sourceforge.net/projects/nusoap/',
			    'Applied patches: ' => 'http://sourceforge.net/tracker/index.php?func=detail&aid=1008122&group_id=57663&atid=484965'
			    )
        );
    }
}
?>
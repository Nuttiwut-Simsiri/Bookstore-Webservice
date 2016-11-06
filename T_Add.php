<?php
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
    $client = new nusoap_client("http://localhost/Webservice/Server.php?wsdl",true); 
	$add = array(
        'catagoryVar' => $_POST['from_catagory'],
		'titleVar'=>$_POST['from_title'],
		'authorVar'=>$_POST['from_author'],
		'publisherVar'=>$_POST['from_publisher'],
		'publish_dateVar'=>$_POST['from_publish_date'],
		'typeVar'=>$_POST['from_type'],
		'languageVar'=>$_POST['from_language'],
		'priceVar'=>$_POST['from_price']
		);
    $data = $client->call("AddXML",$add);		
    echo $data;
?>
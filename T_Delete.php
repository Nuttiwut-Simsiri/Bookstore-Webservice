<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
    require("lib/nusoap.php");
	$mark_name= $_POST['id'];
    $client = new nusoap_client("http://localhost/Webservice/Server.php?wsdl",true); 
    $params = array('mark_name'=>$mark_name);
    $data = $client->call("DeleteXML",$params); 
    echo $data;
    
?>
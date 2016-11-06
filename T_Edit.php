<?php
error_reporting( error_reporting() & ~E_NOTICE );
    // FOR CALL NUSOAP
require("lib/nusoap.php");
  
$id= $_POST['id'];
$element= $_POST['column_name'];
$value = $_POST['text'];
$client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
$params = array(
	'id'=>$id,
	'element'=>$element,
    'new_value'=>$value
	); 

$data = $client->call("T_EditXML",$params); 
echo $data;

?>

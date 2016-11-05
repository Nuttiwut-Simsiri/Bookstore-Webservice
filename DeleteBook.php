<html>
<head>
<title>Client SOAP</title>
<link rel="stylesheet" type="text/css" href="form.css"/>
<link rel="stylesheet" type="text/css" href="button.css"/>
</head>
<body>
<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
?>

<!-- DELETE SERVICE -->
<h1> Delete Book By Name Service </h1>
<h2><font color="red">CAUTION ! IT WILL BE DELETE NODE IN XML FILE.</font></h2>
<a class="button back" href="/Webservice/Client.php">Back</a>
<?php
  	if($_POST['submit_delete'] == "Submit") {
		$mark_name=$_POST['mark_name'];
        $client = new nusoap_client("http://localhost/Webservice/Server.php?wsdl",true); 
        $params = array('mark_name'=>$mark_name);
        $data = $client->call("DeleteXML",$params); 
        echo $data;
    }
?>
<form method="POST">
	<ul class="form-style-1">
    <li><label>Delete by Book name <span class="required">*</span></label>
    	<input type="text" name="mark_name" class="field-divided" placeholder="Title" size="30" maxlength="60"/>
    </li>
    <li>
        <input type="submit" name="submit_delete" value="Submit" />
    </li>
</form>
<!-- DELETE SERVICE -->

</body>
</html>

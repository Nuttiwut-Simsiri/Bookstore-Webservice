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

<!-- EDIT SERVICE -->
<h1> Edit Book By Name Service </h1>
<a class="button back" href="/Webservice/Client.php">Back</a>
<?php
  	if($_POST['submit_edit'] == "Submit") {
		$from_name=$_POST['from_name'];
		$to_name=$_POST['to_name'];
        $client = new nusoap_client("http://localhost/WebService/Server.php?wsdl",true); 
        $params = array(
			'from_name'=>$from_name,
			'to_name'=>$to_name
			);
        $data = $client->call("EditXML",$params); 
        echo $data;
    }
?>

<form method="POST">
	<ul class="form-style-1">
    <li><label>From Book <span class="required">*</span></label>
    	<input type="text" name="from_name" class="field-divided" placeholder="Title" size="30" maxlength="60"/>
    	&nbsp&nbsp <label>TO : <span class="required">*</span></label>
    	<input type="text" name="to_name" class="field-divided" placeholder="Title" size="30" maxlength="60"/>
    </li>
    <li>
        <input type="submit" name="submit_delete" value="Submit" />
    </li>
</form>

</body>
</html>

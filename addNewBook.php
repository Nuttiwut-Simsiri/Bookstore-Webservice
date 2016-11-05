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

<br><!-- ADD SERVICE -->
<h1> Add Book By Name Service </h1>
<a class="button back" href="/Webservice/Client.php">Back</a>
<?php
  	if($_POST['submit_add'] == "Submit") {
        $client = new nusoap_client("http://localhost/Webservice/Server.php?wsdl",true); 
		$add = array(
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
    }
?>
<form method="POST">
	<ul class="form-style-1">
    <li><label>Title <span class="required">*</span></label>
    	<input type="text" name="from_title" class="field-divided" placeholder="Title" size="30" maxlength="60"/>
    </li>
    <li>
        <label>Author <span class="required">*</span></label>
        <input type="text" name="from_author" class="field-divided" placeholder="Author" size="30" maxlength="60"/>
    </li>
    <li>
        <label>Publisher <span class="required">*</span></label>
        <input type="text" name="from_publisher" class="field-divided" placeholder="Publisher" size="30" maxlength="60"/>
    </li>
    <li>
        <label>Publish_date <span class="required">*</span></label>
        <input type="text" name="from_publish_date" class="field-divided" placeholder="dd-mm-yyyy" size="10" maxlength="10"/>
    </li>
    <li>
        <label>Type <span class="required">*</span></label>
        <input type="text" name="from_type" class="field-divided" placeholder="Paperback,Kindle,Hardcover" size="10" maxlength="15"/>
    </li>
    <li>
        <label>Language <span class="required">*</span></label>
        <input type="text" name="from_language" class="field-divided" placeholder="Language" size="10" maxlength="15"/>
    </li>
     <li>
        <label>Price<span class="required">*</span></label>
        <input type="text" name="from_price" class="field-divided" placeholder="Price" size="10" maxlength="5"/>
    </li>
    <li>
        <input type="submit" name="submit_add" value="Submit" />
    </li>
</ul>
</form>

</body>
</html>

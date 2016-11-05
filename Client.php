
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="menu.css"/>
  <link rel="stylesheet" type="text/css" href="table.css"/>
  </head>
  <body>
  <br>
  <center><h1> Search Book </h1></center>
    <nav id="primary_nav_wrap">
<ul>
  <li class="current-menu-item"><a href="#">All Service</a></li>
  <li><a href="#">Menu 1</a>
    <ul>
      <li><a href="/Webservice/addNewBook.php">Create A new Book </a></li>
      <li><a href="/Webservice/DeleteBook.php">Remove Book </a></li>
      <li><a href="/Webservice/EditBook.php">Edit Book</a></li>
    </ul>
  </li>
  <li><a href="/Webservice/Contact.php">Contact Us</a></li>
</ul>
<br><br>
  </nav>
<div align="right">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      Search  : <input type="text" name="key" onkeyup="(<?php echo $keyword;?>)">
  <input type="submit" name="submit" value="Search"> 
  </form>
</div>


<?php
require_once("lib/nusoap.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   	if (empty($_POST["key"])) {
      $searchK = "";
   	} else {
      $searchK = $_POST["key"];
   	}
   	$client = new nusoap_client("http://localhost/Webservice/Server.php?wsdl");
	  $result = $client->call("findBook", array("keyword" => "$searchK"));
    echo "<h2>Result</h2>";
    echo "keyword : $searchK <br><br>";
    $index = 0;
    echo  '<div align="center">
              <table>
                    <tr>
                        <th> Catagory </th>
                        <th> Title </th>
                        <th> Author </th>
                        <th> Publisher </th>
                        <th> Publish_date </th>
                        <th> Price </th>
                    </tr>
                    <tr>'."\n";

    foreach ($result as $key => $value) {
      switch ($index) {
        case 0:
          echo "<td> $value </td>\n";
          $index = $index+1;
          break;
        case 1:
          echo "<td> $value </td>\n";
          $index = $index+1;
          break;
        case 2:
          echo "<td> $value </td>\n";
          $index = $index+1;
          break;
        case 3:
          echo "<td> $value </td>\n";
          $index = $index+1;
          break;
        case 4:
          echo "<td> $value </td>\n";
          $index = $index+1;
          break; 
        case 5:
          echo "<td> ".'$'."$value </td>\n";
          $index = $index+1;
          break;  
        
      }
      if(($key+1) %6 ==0 ){
          $index = 0;
          echo "</tr>\n";
          if($key+1 < sizeof($result)){
            echo "<tr>\n";
          }
          
      }
    }
    echo "</table></div>";
}

?>

</body>
</html>
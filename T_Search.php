<?php

require_once("lib/nusoap.php");
if (empty($_POST["key"])) {
  $searchK = "";
} else {
  $searchK = $_POST["key"];
}
$client = new nusoap_client("http://localhost/Webservice/Server.php?wsdl");
$result = $client->call("findBook", array("keyword" => "$searchK"));
echo "keyword : $searchK <br><br>";
$index = 0;
echo  '<div align="center">
              <table>
                    <tr>
                        <th width="35%"> Title </th>
                        <th width="10%"> Catagory </th>
                        <th width="20%"> Author </th>
                        <th width="10%"> Publisher </th>
                        <th width="10%"> Publish_date </th>
                        <th width="7%"> Type </th>
                        <th width="5%"> Price </th>
                        <th width="3%"> Add / Remove </th>
                    </tr>
                    <tr>'."\n";
    $titleName ="";
    foreach ($result as $key => $value) {
      switch ($index) {
        case 0:
          $titleName = $value;
          echo '<td class="from_title" contenteditable="true" data-id1="'.$titleName.'">'.$value.'</td>'."\n";
          $index = $index+1;
          break;
        case 1:
          echo '<td class="from_catagory" contenteditable="true" data-id2="'.$titleName.'">'.$value .'</td>'."\n";
          $index = $index+1;
          break;
        case 2:
          echo '<td class="from_author" contenteditable="true" data-id3="'.$titleName.'">'.$value.' </td>'."\n";
          $index = $index+1;
          break;
        case 3:
          echo '<td class="from_publisher" contenteditable="true" data-id4="'.$titleName.'">'.$value .'</td>'."\n";
          $index = $index+1;
          break;
        case 4:
          echo '<td class="from_publish_date" contenteditable="true">'.$value .'</td>'."\n";
          $index = $index+1;
          break; 
        case 5:
          echo '<td class="from_type" contenteditable="true">'.$value .'</td>'."\n";
          $index = $index+1;
          break;
        case 6:
          echo '<td class="from_price" contenteditable="true">'.'$'."$value </td>\n";
          $index = $index+1;
          break;  
        
      }
      if(($key+1) %7 ==0 ){
          $index = 0;
          echo '<td><button type="button" name="delete_btn" class="btn btn-xs btn-danger btn_delete" data-id7="'.$titleName.'"">x</button></td>';
          echo "</tr>\n";
          if($key+1 < sizeof($result)){
            echo "<tr>\n";
          }else{
            echo '<tr>
                    <td id="from_title" contenteditable></td>
                    <td id="from_catagory" contenteditable></td>    
                    <td id="from_author" contenteditable></td>  
                    <td id="from_publisher" contenteditable></td>
                    <td id="from_publish_date" contenteditable></td>  
                    <td id="from_type" contenteditable></td>
                    <td id="from_price" contenteditable></td>
                    <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td> 
                  </tr>
                  ';
          }
          
      }
    }
    echo "</table></div>";


?>

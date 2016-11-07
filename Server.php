<?php
require_once "lib/nusoap.php";
$server= new nusoap_server();
$server->configureWSDL("BOOKSTORE","urn:book");
$server->wsdl->addComplexType("ArrayOfString", 
                 "complexType", 
                 "array", 
                 "", 
                 "SOAP-ENC:Array", 
                 array(), 
                 array(array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"xsd:string[]")), 
                 "xsd:string"); 
$server->register("findBook",
                array("keyword" => "xsd:string"),
                array("return" =>  "tns:ArrayOfString")
                );
$addVar = array(
            'titleVar'=>'xsd:string',
            'catagoryVar' => 'xsd:string',
            'authorVar'=>'xsd:string',
            'publisherVar'=>'xsd:string',
            'publish_dateVar'=>'xsd:string',
            'typeVar'=>'xsd:string',
            'languageVar'=>'xsd:string',
            'priceVar'=>'xsd:string',
            'heightVar'=>'xsd:string',
            'th_priceVar'=>'xsd:string'
            );
$editVar = array(
            'from_name'=>'xsd:string',
            'to_name'=>'xsd:string'
            );
$T_EditVar = array(
            'id'=>'xsd:string',
            'element'=>'xsd:string',
            'new_value' =>'xsd:string'
            );

$server->register(
            'AddXML',
            $addVar,
            array('return'=>'xsd:string')
            );

$server->register(
            'DeleteXML',
            array('mark_name'=>'xsd:string'),
            array('return'=>'xsd:string')
            );
$server->register(
            'EditXML',
            $editVar,
            array('return'=>'xsd:string')
            );
$server->register(
            'T_EditXML',
            $T_EditVar,
            array('return'=>'xsd:string')
            );


function findBook($keyword){
    $xml = simplexml_load_file('BookStore.xml');
    $result = array();
    foreach ($xml->book as $book) {
        $category = (string) $book['category'];
        $title = (String) $book->title;
        $author = (String) $book->author;
        $price = (int) $book->price;
        $type = (string) $book ->type;
        $oper = substr($keyword, 0,2);
        $KeyPrice = (int)substr($keyword, 1,strlen($keyword));
        $KeythPrice = (int)substr($keyword, 2,strlen($keyword));
        if($oper == '>B' || $oper == '<B' ||$oper == '>$' || $oper == '<$' ||$oper == '>h' || $oper == '<h' ){
            if($oper == '>B' ){
                if((int)$book->th_price >=  $KeythPrice ){
                    array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
                }
            }elseif($oper == '<B'){
                if((int)$book->th_price <=  $KeythPrice ){
                    array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
                }
            }elseif($oper == '>$'){
                if($price >=  $KeythPrice ){
                    array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
                }
            }elseif($oper == '<$'){
                if($price <=  $KeythPrice ){
                    array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
                }
            }elseif($oper == '<h'){
                if((int)$book->height <=  $KeythPrice ){
                    array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
                }
            }elseif($oper == '>h'){
                if((int)$book->height >=  $KeythPrice ){
                    array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
                }
            }
        }elseif(strncasecmp($category ,$keyword , strlen($keyword)) == 0 || (strncasecmp($title ,$keyword , strlen($keyword)) == 0) || (strncasecmp($author ,$keyword , strlen($keyword)) == 0)){
            array_push($result,$book->title,$category,$book->author,$book->publisher,$book->publish_date,$type,$book->price,$book->height,$book->th_price);
        }
    }  
    return $result;
}

function AddXML($titleVar,$catagoryVar,$authorVar,$publisherVar,$publish_dateVar,$typeVar,$languageVar,$priceVar,$heightVar,$th_priceVar){
    $file = 'BookStore.xml';
    $xml = simplexml_load_file($file);
    $book = $xml->addChild('book');
    $book->addAttribute('category', $catagoryVar);
    $book->addChild('title', $titleVar);
    $book->title->addAttribute('lang', 'en');
    $book->addChild('author', $authorVar);
    $book->addChild('publisher', $publisherVar);
    $book->addChild('publish_date', $publish_dateVar);
    $book->addChild('type', $typeVar);
    $book->addChild('language',$languageVar);
    $book->addChild('price',$priceVar);
    $book->addChild('height',$heightVar); 
    $book->addChild('th_price',$th_priceVar);        
    $xml->asXML($file); 
    return "Add $titleVar Success!";
}
function DeleteXML($mark_name) {
    $name = $mark_name;         
    $xmlStr = file_get_contents('BookStore.xml'); 
    $xml = new SimpleXMLElement($xmlStr);
    $book = $xml->book;
    for($k=0;$k<sizeof($book);$k++){
        foreach ($book[$k] as $key => $value) {
            if($mark_name==$value and $key=="title"){
                $dom=dom_import_simplexml($book[$k]);
                $dom->parentNode->removeChild($dom);
                        
            }
        }
    }           
    $output = $xml->asXML('BookStore.xml');     
    return "Delete $mark_name Success!";
}    
function EditXML($from_name, $to_name) {            
    $xmlStr = file_get_contents('BookStore.xml'); 
    $xml = new SimpleXMLElement($xmlStr);
    $book = $xml->book;
    for($j=0;$j<sizeof($book);$j++){
        foreach ($book[$j] as $key => $value) {
            if($from_name==$value and $key=="title")
                $book[$j]->title = $to_name;
            }
        }           
    $output = $xml->asXML('BookStore.xml');     
    return "Edit Done ! $from_name (to) $to_name";
}
function T_EditXML($id,$element,$new_value) {            
    $xmlStr = file_get_contents('BookStore.xml'); 
    $xml = new SimpleXMLElement($xmlStr);
    $book = $xml->book;

    for($j=0;$j<sizeof($book);$j++){
        foreach ($book[$j] as $key => $value) {
            if($id==$value and $key=="title")
                switch ($element) {
                    case 'catagory':
                        $book[$j]['catagory'] = $new_value;
                        break;
                    case 'author':
                        $book[$j]->author = $new_value;
                        break;
                    case 'publisher':
                        $book[$j]->publisher = $new_value;
                        break;
                    case 'type':
                        $book[$j]->type = $new_value;
                        break;
                    case 'publish_date':
                        $book[$j]->publish_date = $new_value;
                        break;
                    case 'price':
                        $book[$j]->price = $new_value;
                        break;
                    case 'height':
                        $book[$j]->height = $new_value;
                        break;
                    case 'th_price':
                        $book[$j]->th_price = $new_value;
                        break;
                }
            }
        }           
    $output = $xml->asXML('BookStore.xml');     
    return "Edit Done !";
}
$rawPostData = file_get_contents("php://input"); 
$server->service($rawPostData);



?>
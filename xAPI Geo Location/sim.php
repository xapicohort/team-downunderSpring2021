<?php 
header("Content-Type: application/json");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1'); 
error_reporting(E_ALL);

// Read the file contents into a string variable,
// and parse the string into a data structure
$fileName = "conf/simulation.json"; 
$string = file_get_contents("conf/simulation.json",FILE_USE_INCLUDE_PATH);

//get the values and update 
if($_REQUEST['action']=='get'){
  echo $string;     
    
}


//If setting
if($_REQUEST['action']=='set'){
//for each item being received, write the config data as a string

//Now replace the existing file
$tempArray = [];
$date = new DateTime('now');
$data = array(
	"lat"=>$_REQUEST['lat'],
	"long"=>$_REQUEST['long'],
	"incident"=>$_REQUEST['incidentType'],
    "location"=>$_REQUEST['location'],
    "radius"=>$_REQUEST['simradius'],
    "resources"=>$_REQUEST['simresources'],
    "descrip"=>$_REQUEST['incidentDescrip'],
    "title"=>$_REQUEST['simtitle'],
    "created"=>date('d-m-Y H:i:s a'));
    

if($string === null){

$tempArray['Entries'] = '';    
    
}else{
$tempArray = json_decode($string,true);
}


array_push($tempArray, $data);
$jsonData = json_encode($tempArray);
file_put_contents($fileName, $jsonData);

 

$str_data = file_get_contents($fileName);
echo json_decode(json_encode($str_data));   
    
}
//if getting
if($_REQUEST['action']=='get'){
   // $str_data = file_get_contents("conf/config.json");
//    echo json_decode(json_encode($str_data));
}
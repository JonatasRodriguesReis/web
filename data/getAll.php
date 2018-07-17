<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/data.php';;
 
$database = new Database();
$db = $database->getConnection();
$dataObj = new Data($db);
$AllData	 = $dataObj->getAll();
$data_arr=array();
$datas_arr["records"]=array();

foreach ($AllData as $data) {
	
	$data_arr = array(
	    "data" => $data[0],
	    "valor" => $data[1]
	);
	array_push($datas_arr["records"], $data);
}
$datas_arr2["jonatas"]=array();
$teste = array();
array_push($teste, $datas_arr);
array_push($teste, $datas_arr2);
print_r(json_encode($datas_arr));
?>
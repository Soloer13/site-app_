<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/roUnit.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare roUnit object
$roUnit = new roUnit($db);
  

// set ID property of record to read
$roUnit->ROId = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of roUnit to be edited
$roUnit->readOne();
  
if($roUnit->unit !=null){
    // create array
    $roUnit_arr = array(
        "ROId" =>  $roUnit->ROId,
        "unit" => $roUnit->unit,
        "created_on" => $roUnit->created_on,
        "modified_on" => $roUnit->modified_on  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($roUnit_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user roUnit does not exist
    echo json_encode(array("message" => "roUnit does not exist."));
}
?>

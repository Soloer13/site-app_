<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/roUnit.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();

// echo("got into here");

// prepare roUnit object
$roUnit = new roUnit($db);
  
// get id of roUnit to be edited
$data = json_decode(file_get_contents("php://input"));

// print_r($data);

// set ID property of roUnit to be edited
$roUnit->ROId = $data->ROId;
// echo($roUnit->id);
// set roUnit property values
$roUnit->unit = $data->unit;
$roUnit->modified_on = date('Y-m-d H:i:s');
$roUnit->created_on = '';
  
// print_r($roUnit);
// update the roUnit
if($roUnit->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "roUnit was updated."));
}
  
// if unable to update the roUnit, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update roUnit."));
}
?>
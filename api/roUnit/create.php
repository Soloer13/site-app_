<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate roUnit object
include_once '../objects/roUnit.php';
  
$database = new Database();
$db = $database->getConnection();
  
$roUnit = new roUnit($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

echo("create php is here");

// make sure data is not empty
if( !empty($data->unit) ){
  
    // set roUnit property values
    echo($data->unit);
    $roUnit->unit = $data->unit;

    // create the roUnit
    if($roUnit->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "roUnit was created."));
    }
  
    // if unable to create the roUnit, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create roUnit."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create roUnit. Data is incomplete."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate waterAnalysis object
include_once '../objects/waterAnalysis.php';
  
$database = new Database();
$db = $database->getMysqlConnection();
  
$waterAnalysis = new waterAnalysis($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// echo("create php is here");

// make sure data is not empty
if( !empty($data->unit) ){
  
    // set waterAnalysis property values
    // echo($data->unit);
    $waterAnalysis->date = $data->date;
    $waterAnalysis->shift = $data->shift; 
    $waterAnalysis->cond = $data->cond;
    $waterAnalysis->temp = $data->temp;
    $waterAnalysis->ph = $data->ph;
    $waterAnalysis->orp = $data->orp;
    $waterAnalysis->product = $data->productFlow;
    $waterAnalysis->roin = $data->roin;
    $waterAnalysis->roout = $data->roout;
    $waterAnalysis->unit = $data->unit;
    // $waterAnalysis->created_on = "CURRENT_TIMESTAMP()";
    $waterAnalysis->created_on = date('Y-m-d H:i:s');

    // create the waterAnalysis
    if($waterAnalysis->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "waterAnalysis was created."));
    }
  
    // if unable to create the waterAnalysis, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create waterAnalysis."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create waterAnalysis. Data is incomplete."));
}
?>
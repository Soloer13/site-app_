<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/waterAnalysis.php';
// include_once '../config/core.php';

// get database connection
$database = new Database();
$db = $database->getMysqlConnection();
//  print_r($db);

// echo("got into here");

// prepare waterAnalysis object
$waterAnalysis = new waterAnalysis($db);
  
// get id of waterAnalysis to be edited
$data = json_decode(file_get_contents("php://input"));

// print_r($data);

// set ID property of waterAnalysis to be edited
$waterAnalysis->waterAnalysisId = $data->ROId;
// echo($waterAnalysis->id);
// set waterAnalysis property values
$waterAnalysis->cond = $data->cond;
$waterAnalysis->temp = $data->temp;
$waterAnalysis->ph = $data->ph;
$waterAnalysis->orp = $data->orp;
$waterAnalysis->product = $data->productFlow;
$waterAnalysis->roin = $data->roin;
$waterAnalysis->roout = $data->roout;
$waterAnalysis->date = $data->date;
$waterAnalysis->shift = $data->shift;
$waterAnalysis->unit = $data->unit;
$waterAnalysis->modified_on = date('Y-m-d H:i:s');
  
// print_r($waterAnalysis);
// update the waterAnalysis
if($waterAnalysis->update())
  {
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "waterAnalysis was updated."));
}
  
// if unable to update the waterAnalysis, tell the user
else{
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update waterAnalysis."));
}

?>
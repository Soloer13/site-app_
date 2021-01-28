<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/waterAnalysis.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare waterAnalysis object
$waterAnalysis = new waterAnalysis($db);
  

// set ID property of record to read
$waterAnalysis->waterAnalysisId = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of waterAnalysis to be edited
$waterAnalysis->readOne();
  
if($waterAnalysis->waterAnalysisId !=null){

    //shift in json
    if($waterAnalysis->shift == 0){
        $waterAnalysis->shiftStr = "Morning";
        // echo("shift 0 \n");
    }else if ($waterAnalysis->shift == 1){
        $waterAnalysis->shiftStr = "Night";
        // echo("shift 1 \n");
    }

    //debuging section 
    // echo(strval($waterAnalysis->shift) + " it worked");
    // $allVars = get_defined_vars(); //gets all the defined variables including built-ins and custom variables (print_r to view them
    // print_r($allVars);
    // debug_zval_dump($allVars); //dumps the variable with its reference counts. This is useful when there are multiple paths to update a single reference.
    // print_r($waterAnalysis->shiftStr);

    // create array
    $waterAnalysis_item=array(
        "Id" => $waterAnalysis->waterAnalysisId,
        "unit" => $waterAnalysis->unit,
        "cond" => $waterAnalysis->cond,
        "temp" => $waterAnalysis->temp,
        "ph" => $waterAnalysis->ph,
        "orp" => $waterAnalysis->orp,
        "productFlow" => $waterAnalysis->product,
        "ROin" => $waterAnalysis->roin,
        "ROout" => $waterAnalysis->roout,
        "date" => $waterAnalysis->date,
        "shift" => $waterAnalysis->shift,
        "shiftStr" => $waterAnalysis->shiftStr,
        "created_on" => $waterAnalysis->created_on,
        "modified_on" => $waterAnalysis->modified_on
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($waterAnalysis_item);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user waterAnalysis does not exist
    echo json_encode(array("message" => "waterAnalysis does not exist."));
}
?>

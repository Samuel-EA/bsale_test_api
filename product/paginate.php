<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate paginator object
include_once '../objects/paginator.php';

$database = new DatabaseBsale();
$db = $database->getConnection();


// get posted data
$data = json_decode(file_get_contents("php://input"));
// $data = file_get_contents("php://input");

// make sure data is not empty
if(
    !empty($data) &&
    $data != null
){
    $getProductsAttempt = new Paginator($db,"product",$data->records,$data->page);
    // set sale id
    $result = $getProductsAttempt->paginate();

    // save the code
    if(!isset($result["error"])){
            // set response code - 200 OK
            http_response_code(200);
 
            // tell the user
            echo json_encode($result);
    }
 
    // if unable to save the code, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode($result);
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to retrieve data.".$data));
}
?>
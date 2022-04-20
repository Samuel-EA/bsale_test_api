<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate openpay object
include_once '../objects/category.php';
 
$database = new DatabaseBsale();
$db = $database->getConnection();
 
$getCategoryAttempt = new Category($db);
 
// try to get cageory list
if($result = $getCategoryAttempt->getCategories()){
    // set response code - 200 OK
    http_response_code(200);
    // tell the user
    echo $result; 
}
 
// if unable to get category list, tell the user
else{
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to get category data."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
    // set response code - 200 OK
    http_response_code(200);
}


// import database connection
require_once '../config/database.php';
 
// import openpay object
require_once '../objects/category.php';

// import AUTH_KEY object
require_once '../resources/OAuthSimulation.php';
 
//instantiate database connection
$database = new DatabaseBsale();
$db = $database->getConnection();

//get AUTH_KEY
if(isset($_SERVER['HTTP_AUTH_KEY'])){
    $headerAuthKey = $_SERVER['HTTP_AUTH_KEY'];
}else{
    $headerAuthKey = "";
}

//instantiate OAuthSimulation
$OAuthSimulation = new OAuthSimulation($headerAuthKey);

//make sure request is authorized
if(!$OAuthSimulation->validateAuthKey()){
    // set response code - 403 forbbiden
    http_response_code(403);
 
    // tell the user
    echo json_encode(array("error" => "Unauthorized request"));
}else{
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
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Auth-Key");

if($_SERVER["REQUEST_METHOD"] === "OPTIONS"){
    // set response code - 200 OK
    http_response_code(200);
    return 0;
}else {
    

    // import database connection
    require_once '../config/database.php';
    
    // import productsByCategory object
    require_once '../objects/productsByCategory.php';

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
    } else {
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // $data = file_get_contents("php://input");

        // make sure data is not empty
        if(
            !empty($data) &&
            $data != null
        ){
            $getProductsByCategoryAttempt = new Product($db,"product",$data->records,$data->page,$data->category);
            
            $result = $getProductsByCategoryAttempt->getProductsByCategory();

            // return response
            if(!isset($result["error"])){
                    // set response code - 200 OK
                    http_response_code(200);
        
                    // tell the user
                    echo json_encode($result);
            }
            // if unable to get response, tell the user
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
            echo json_encode(array("message" => "Unable to retrieve required request data."));
        }
    }
}
?>
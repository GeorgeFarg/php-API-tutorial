<?php 

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, x-Request-with');

$requestMethod = $_SERVER['REQUEST_METHOD'];

include('function.php');

if ($requestMethod == "POST") {
    
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $storeCustomer = storeCustomer($_POST);
    }
    else {
        $storeCustomer = storeCustomer($inputData);
    }

    echo $storeCustomer;
}else {
    $data = [
        'status' => 405,
        'message' => $requestMethod." Method is not allowed"
    ];
    header("HTTP/1.0 405 METHOD NOT ALLOWED");
    echo json_encode($data);
}

?>
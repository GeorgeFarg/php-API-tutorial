<?php 
require '../dbconn.php';

function error422($message) {
    $data = [
        'status' => 422,
        'message' => $message
    ];
    header("HTTP/1.0 422 unprocessable");
    echo json_encode($data);
    exit();
} 

function storeCustomer($customerInput) {
    global $conn;

    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    if (empty(trim($name))) {
        error422("enter you name");
    }
    elseif(empty(trim($email))){
        error422("enter you email");
    }
    elseif(empty(trim($phone))){
        error422("enter you phone");
    }
    else {
        $query = "INSERT INTO customers (name,email,phone) VALUES ('$name','$email','$phone')";
        $resule = mysqli_query($conn, $query);

        if ($resule) {
            $data = [
                'status' => 201,
                'message' => "Customer created successfully"
            ];
            header("HTTP/1.0 201 OK");
            return json_encode($data);
        }
        else {
            $data = [
                'status' => 500,
                'message' => "Internal server error"
            ];
            header("HTTP/1.0 500 Internal server error");
            return json_encode($data);
        }
    }
}







function getCustomerList() {

    global $conn;

    $query = "SELECT * FROM customers";
    $queryRun = mysqli_query($conn ,$query);

    if ($queryRun) {

        if (mysqli_num_rows($queryRun) > 0) 
        {
            $res = mysqli_fetch_all($queryRun, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => "customers found successfully",
                'data' => $res,

            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);

        } 
        else {
            $data = [
                'status' => 404,
                'message' => "No customer found"
            ];
            header("HTTP/1.0 404 No customer found");
            return json_encode($data);
        }


    }
    else {
        $data = [
            'status' => 500,
            'message' => "Internal server error"
        ];
        header("HTTP/1.0 500 Internal server error");
        return json_encode($data);
    
    }
}

?>
<?php

    $host = "localhost";
    $username = "<Your username>";
    $password = "";
    $dbname= "<your db>";
    
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed". mysqli_connect_error());
    }
?>
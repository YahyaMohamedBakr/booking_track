<?php 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];
    $newGuestName = $_POST['guestName'];
    $newCheckIn = $_POST['checkIn'];
    $newCheckOut = $_POST['checkOut'];

    // connect with database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "emaar-users";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("can not connect database " . $conn->connect_error);
    }
    
    

    echo 'success';
 
    $conn->close();
   
   
    
} else {
    http_response_code(400); 
    echo 'Invalid request';
}
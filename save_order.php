<?php 
/**
 * save order server side
 */

 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];
    $newGuestName = $_POST['guestName'];
    $newCheckIn = $_POST['checkIn'];
    $newCheckOut = $_POST['checkOut'];


    //include_once(ABSPATH.'config.php');
    //connect with database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "emaar-users";
    
     $conn = new mysqli($servername, $username, $password, $database);
    
     if ($conn->connect_error) {
        die("can not connect database " . $conn->connect_error);
     }

     echo $orderId ;

// echo "khjkhkjhjkhjkhjkhjkhjk"; exit();
//     try{
        // global $wpdb;
        // $query = $wpdb->prepare("UPDATE {$wpdb->prefix}st_order_item_meta SET check_in='$newCheckIn' WHERE wc_order_id ='$orderId'");
        // $wpdb->query($query);
    
        // $wpdb->update(
        //     'wp_st_order_item_meta',
        //     array('check_in' => $newCheckIn),
        //     array('wc_order_id' => $booking_id),
        //     array('%d'),
        //     array('%d')
        //     );
            // var_dump($any);
            //  echo $newGuestName; echo'<br>';
            //  echo $newCheckIn ;echo'<br>';
            //  echo $newCheckOut ;echo'<br>';
            //  echo $orderId ;echo'<br>';
    
        echo 'success';
        $conn->close();    
    // }
    // catch(Exception $e){
    //     echo $e->getMessage();
    // }
  
    
} else {
    http_response_code(400); 
    echo 'Invalid request';
}



// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $orderId = $_POST['orderId'];
//     $newGuestName = $_POST['guestName'];
//     $newCheckIn = $_POST['checkIn'];
//     $newCheckOut = $_POST['checkOut'];

//     // connect with database
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $database = "emaar-users";

//     $conn = new mysqli($servername, $username, $password, $database);

//     if ($conn->connect_error) {
//         die("can not connect database " . $conn->connect_error);
//     }




    
// $queryUser = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}st_order_item_meta WHERE user_id = %d", $user_id);

// $results = $wpdb->get_results($queryUser);

//  foreach ($results as $order) {

//     $data= json_decode($order->raw_data)->guest_name[0];
//     $newData = json_encode($data = $newGuestName) ;
   
//  }
 
      
  

    // Build the SQL UPDATE query
//     $sql = "UPDATE wp_st_order_item_meta SET check_in = ?, check_out = ? WHERE order_id = ?";

//     // Prepare the query
//     $stmt = $conn->prepare($sql);

//     if ($stmt === false) {
//         echo 'Error preparing update statement: ' . $conn->error;
//     } else {
//         // Bind parameters
//         $stmt->bind_param("sssi", $newCheckIn, $newCheckOut, $orderId);

//         // Execute the query
//         if ($stmt->execute()) {
//             echo 'success'; 
//         } else {
//             echo 'Error updating data: ' . $conn->error; 
//         }

//         // Close the statement
//         $stmt->close();
//     }

//     $conn->close();
// } else {
//     http_response_code(400);
//     echo 'Invalid request';
// }


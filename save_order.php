<?php 
/**
 * save order php
 * save updates in data base
 */


 add_action( 'rest_api_init', function () {
    register_rest_route( 'booking','/saveorder', array(
      'methods' => 'POST',
      'callback' => 'save_order',
      'permission_callback' => '__return_true'
    ));
  });


  function save_order(){
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];
    $newGuestName = $_POST['guestName'];
    $newCheckIn = $_POST['checkIn'];
    $newCheckOut = $_POST['checkOut'];

    $user_id=$_POST['userId'];
    
   global $wpdb;
$queryUser = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}st_order_item_meta WHERE user_id = %d", $user_id);

$results = $wpdb->get_results($queryUser);

 foreach ($results as $order) {

    $data= json_decode($order->raw_data);
    $data->guest_name[0] = $newGuestName;
    $data=json_encode($data);
   echo'';   
 }


 $wpdb->update(
  $wpdb->prefix.'st_order_item_meta',
     array(
         'raw_data' => $data,
         'check_in' => $newCheckIn,
         'check_out' => $newCheckOut
     ),
     array('wc_order_id' => $orderId),
     array(
         '%s', // Format for 'guest_name', assuming it's a string
         '%s', // Format for 'check_in', assuming it's a string
         '%s'  // Format for 'check_out', assuming it's a string
     ),
     array('%d') // Format for 'order_id', assuming it's an integer
 );
 

    echo json_encode('success');
 
   
   
    
} else {
    http_response_code(400); 
    echo 'Invalid request';
}

  }

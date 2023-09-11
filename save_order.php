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
  $userId = json_decode($_POST['userId']) ;

  // $currentUserId = wp_get_current_user()->ID;
  // if ($currentUserId != $userId) {
  //     http_response_code(403); 
  //     echo 'Access denied';
  //     exit;
  // }

  $order = wc_get_order($orderId);
  $order->update_status('cancelled');
  
  echo json_encode('success'); 

  
} else {
  http_response_code(400); 
  echo 'Invalid request';
}

  }

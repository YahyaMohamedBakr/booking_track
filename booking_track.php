<?php
/**
 * Plugin Name: Booking Track
 * Plugin URI: https://tawarly.com
 * Description: track gest booking
 * Author: Tawarly
 * Author URI: http://tawarly.com
 * Version: 1.0.0
 */

 function booking_track_page() {
   
    include_once('submit_form .php');
    
}

function redirect_page(){
    include_once('redirect.php');
}



add_shortcode( 'Booking_Track', 'booking_track_page' );

add_shortcode('Redirect','redirect_page');







// add_action( 'rest_api_init', function () {
//   register_rest_route( 'booking','/getbookingedites', array(
//     'methods' => 'GET',
//     'callback' => 'get_booking_edites',
//     'permission_callback' => '__return_true'
//   ));
// });

// function get_booking_edites(){

//     $page = get_post(16608);
//     var_dump(get_permalink());
//    //  echo 'hello';
//   //$url= get_site_url().'/dashboard/?sc=booking-history';
//   //header('Location: '.'https://www.google.com/');
    
//   $email = isset($_GET['email']) ? ($_GET['email']) : '';
//   $booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
//   $token = isset($_GET['token']) ? $_GET['token'] : '';
  
  
  
  
//   if (empty($email) || empty($booking_id) || empty($token)) {
  
     
//       echo '<h1>Invalid one or more values</h1>';
//        return;
//   }
  
  
  
  
//   //if (check_valid_token($booking_id, $token)) {
//       $user = get_user_by('email', $email);
  
//       if (empty($user)) {
//           $username = substr($email, 0, strpos($email, '@'));
//           $password = wp_generate_password();
          
//           $userdata = array(
//               'user_login' => $username,
//               'user_email' => $email,
//               'user_pass' => $password,
//               'role' => 'subscriber'
//           );
          
//           $user_id = wp_insert_user($userdata);
//       } else {
//           $user_id = $user->ID;
//       }
//   //}
//       wp_set_current_user($user_id);
  
//       wp_set_auth_cookie($user_id, false);
  
//   wp_redirect(site_url('/dashboard/?sc=booking-history'));    
// }
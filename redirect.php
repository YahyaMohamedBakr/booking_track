<?php
  /**
   * redirect page 
   * 
   **/

//endpoint to handel email link auth 
add_action( 'rest_api_init', function () {
    register_rest_route( 'booking','/getbookingedites', array(
      'methods' => 'GET',
      'callback' => 'get_booking_edites',
      'permission_callback' => '__return_true'
    ));
  });
  
  function get_booking_edites(){
      
    $email = isset($_GET['email']) ? ($_GET['email']) : '';
    $booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';
    
    //validation link
    if (empty($email) || empty($booking_id) || empty($token)) {
    
       
        echo '<h1>Invalid one or more values</h1>';
         return;
    }
    
    
        $user = get_user_by('email', $email);
    
        if (empty($user)) {
            $username = substr($email, 0, strpos($email, '@'));
            $password = wp_generate_password();
            
            $userdata = array(
                'user_login' => $username,
                'user_email' => $email,
                'user_pass' => $password,
                'role' => 'customer'
            );
            
            $user_id = wp_insert_user($userdata);
        } else {
            $user_id = $user->ID;
        }
  
        wp_set_current_user($user_id);
    
        wp_set_auth_cookie($user_id, false);
  
          global $wpdb;
  
    
      
      // assigen booking to user in booking system by order_item_meta
  $wpdb->update(
    $wpdb->prefix.'st_order_item_meta',
  array('user_id' => $user_id),
  array('wc_order_id' => $booking_id),
  array('%d'),
  array('%d')
  );
  
    //assign booking to user in woocommerce by post meta
    update_post_meta($booking_id, '_customer_user', $user_id);
   
    wp_redirect(site_url('/dashboard/?user_id='.$user_id));    
  }
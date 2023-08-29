<?php


 // $headers = getallheaders();

  //  $host =$headers['Host'];


   //wp_clear_auth_cookie();

   // get token from link

// ob_start();
$email = isset($_GET['email']) ? ($_GET['email']) : '';
$booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';




if (empty($email) || empty($booking_id) || empty($token)) {

   
    echo '<h1>Invalid one or more values</h1>';
     return;
}

//if (check_valid_token($booking_id, $token)) {
    $user = get_user_by('email', $email);

    if (empty($user)) {
        $username = substr($email, 0, strpos($email, '@'));
        $password = wp_generate_password();
        
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,
            'role' => 'subscriber'
        );
        
        $user_id = wp_insert_user($userdata);
    } else {
        $user_id = $user->ID;

    }

    wp_set_current_user($user_id);

    wp_set_auth_cookie($user_id, false);

   // do_action('wp_login', $user->user_login, $user);
   
//    ob_end_clean();

   // wp_redirect(site_url().'/test-2');
   // exit;
// } else {
//     echo '<h1>Invalid Token</h1>';
// }

// function check_valid_token($e, $t) {
//     $args = array(
//         'post_type' => 'wp_postmeta', 
//         'meta_query' => array(
//             'relation' => 'AND',
//             array(
//                 'key' => 'st_email',
//                 'value' => $e,
//                 'compare' => '='
//             ),
//             array(
//                 'key' => 'order_token_code',
//                 'value' => $t,
//                 'compare' => '='
//             )
//         )
//     );

//     $query = new WP_Query($args);

//     if ($query->have_posts()) {
//         return true;
//     } else {
//         return false;
//     }
// }





//    $email = isset($_GET['email'])? isset($_GET['email']) :'';
    
//     if(empty($email)){

//            // wp_redirect(get_site_url());

//         echo '<h1>Token is not found</h1>';
        
//         return;
//         }else{
//             // Check if token exists in user_meta
//             $user = get_user_by( 'email',  urldecode($email) );
//             echo '<pre>';
//             var_dump($user);
//             echo '<pre>';
//         }


//         if(empty($user)){
//             echo 'user not exsist';

//             $username = substr($email, 0, strpos($email, '@'));
//             $password = wp_generate_password();


//             $userdata = array(
//                 'user_login' => $username,
//                 'user_email' => $email,
//                 'user_pass' => $password,
//                 'role' => 'customer'
//             );
//         }

////////////////////////
// if (empty($user)) {


//     // Token not found, send request to API
//     $apiUrl = 'https://backofficetest.turbo-eg.com/api/client/find-user?token=' . $token;
//     $response = wp_remote_get($apiUrl);
    
//     if (!is_wp_error($response)) {
//         $data = json_decode(wp_remote_retrieve_body($response), true);
        
//         if (isset($data['success']) && $data['success'] == 1) {
//             // Create a new user
//             $email = $data['email'];
//             $roleName = $data['role_name'];
//             $roleId = $data['role'];
            
//             $username = substr($email, 0, strpos($email, '@'));
//             $password = wp_generate_password();
            
//             $userdata = array(
//                 'user_login' => $username.'_turbo',
//                 'user_email' => $email,
//                 'user_pass' => $password,
//                 'role' => $roleName
//             );
            
//             $newUserId = wp_insert_user($userdata);
            
//             if (!is_wp_error($newUserId)) {
//                 // Add token to user_meta
//                 update_user_meta($newUserId, 'token', $token);
                
//                 switch ($roleId) {
//                     case 5:
//                         // Set shop_manager role if role_id is 5
//                         // $adminRole = get_role('administrator');
//                         // $adminRole->add_cap('level_10');
//                         $user = new WP_User($newUserId);
//                         $user->set_role('turbo_store_manager');
//                         break;
//                     case 1:
//                         // Set turbo client role if role_id is 1
//                         $user = new WP_User($newUserId);
//                         $user->set_role('wholesale_customer');
//                         break;
//                     default:
//                         // Set default role if roleId is neither 5 nor 1
//                         $user = new WP_User($newUserId);
//                         $user->set_role('wholesale_customer');
//                         break;
//                 }
//                 // Login the user
//                 wp_set_auth_cookie($newUserId, false);
                
//                 // Redirect to shopping page
//                 wp_redirect(get_site_url().'/shop');
//                 exit;
//             } else {
//                 echo '<h1> Unable to create user account</h1>';
//             }
//         } elseif (isset($data['error_msg'])){
            
//                 echo '<h1>'. $data['error_msg'].'</h1>';
//         }else{
//                 echo '<h1>Token Error</h1>';
//         }
//     } else {
//         echo '<h1>Error making API request.</h1>';
//     }
// } else {
//     // Token found, login the user
//     $userId = $user[0]->ID;
    
//     wp_set_auth_cookie($userId, false);

//     // Redirect to shopping page
//     wp_redirect(get_site_url().'/shop');
//     exit;
// }
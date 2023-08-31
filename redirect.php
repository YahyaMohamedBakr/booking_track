<?php

//get_header(dirname('header.php'));
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
//}
    wp_set_current_user($user_id);

    wp_set_auth_cookie($user_id, false);

    

    global $wpdb;

    //header('Location: '.site_url().'/dashboard/?sc=booking-history');
    $wpdb->query($wpdb->prepare("UPDATE wp_st_order_item_meta SET user_id='$user_id' WHERE order_item_id='$booking_id'"));


   wp_redirect(site_url().'/dashboard/?sc=booking-history');
    
    exit;
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






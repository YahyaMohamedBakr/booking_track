<?php






// $booking_id=16594;
 global $wpdb;
// $query = $wpdb->prepare("SELECT raw_data FROM wp_st_order_item_meta WHERE wc_order_id = %d", $booking_id);

// $raw_data = $wpdb->get_var($query);

//$q =json_decode($raw_data);
// echo'<pre>';
// var_dump($q);
// echo'</pre>';

$user_id = isset($_GET['user_id'])? $_GET['user_id']:'';

if($user_id){
    $queryUser = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}st_order_item_meta WHERE user_id = %d", $user_id);

$results = $wpdb->get_results($queryUser);

// echo'<pre>';
// var_dump($results);
// echo'</pre>';
include_once('pages/html/dashboard_front.php');


}

?>


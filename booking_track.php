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
?>







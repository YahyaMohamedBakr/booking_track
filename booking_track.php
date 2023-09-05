<?php
/**
 * Plugin Name: Booking Track
 * Plugin URI: https://tawarly.com
 * Description: Easily set up a tracking page for your customers by placing the shortcode [Booking_Track]. Customers can use their email and booking number to access their tracking page. Once they click the link in the email, they can conveniently manage their bookings through their account.
 * Author: Tawarly
 * Author URI: http://tawarly.com
 * Version: 1.0.0
 */

 function booking_track_page() {
   
    include_once('submit_form.php');
    
}

function dashboard(){
   include_once('dashboard.php');
}

add_shortcode( 'Booking_Track', 'booking_track_page' );
add_shortcode( 'Dashboard', 'dashboard' );

include_once('redirect.php');
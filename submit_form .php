<?php

  /**
   * submit form php 
   * 
   **/
  
   
   if (isset($_GET['submit'])) {
       $booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
       $submitted_email = isset($_GET['submitted_email']) ? $_GET['submitted_email'] : '';
   
       $booking = get_post_meta($booking_id);
    //    echo'<pre>';
    //    var_dump($booking);
    //    echo'</pre>';

       $guest_email = $booking["st_email"][0];
   
       if ($booking && $guest_email == urldecode($submitted_email)) {

            $token = isset($booking["order_token_code"][0]) ? $booking["order_token_code"][0] : '';

            if (empty($token)) {
                echo 'Token not found in post meta.';
                return;
            }



           $redirect_link = site_url() . '/redirect/?email=' . $guest_email . '&booking_id=' . $booking_id . '&token=' . $token;

           $subject = 'Confirmation and Action Required';
           $message = 'Click the following link to manage your booking: ' . $redirect_link;
           wp_mail($guest_email, $subject, $message);
           
           echo 'Check your Email for further instructions.';
       } else {
           echo 'Invalid email or booking';
       }
   }
   
    // if(isset($_GET['submit'])){
    // $booking_id = isset($_GET['booking_id'])? $_GET['booking_id'] : '';
    // $submitted_email = isset($_GET['submitted_email'])? $_GET['submitted_email'] : '';
    
    // $booking = get_post_meta($booking_id);
    // $guest_email= $booking["st_email"][0];
    // if($booking &&  $guest_email== urldecode($submitted_email)){
    //     echo'sucsess';
    //     // echo'<pre>';
    //     // echo var_dump($booking);
    //     // echo '</pre>';
    //     $token = '';
    //     $url =site_url().'/redirect/?email='.$guest_email.'&id='.$booking_id.'&token='.$token;
    //     wp_mail($guest_email, 'Confirm To edite your booking', "$url");
    //     echo 'Check your Email to Confirm and next track or edite your booking';
    //     wp_footer();
    //     exit;
       
    //    }elseif(!$booking){
        
    //     echo 'This Booking Numbe Is Not Found';
    //    }elseif($guest_email != urldecode($submitted_email)){
    //    echo 'This Email Is Not Found';
    //    }
       
    // }
   
    include_once('pages/html/form.html');
    

    
    ?>

  


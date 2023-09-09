<?php

  /**
   * submit form php page
   * 
   **/
  

   if (isset($_GET['submit'])) {
       $booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
       $submitted_email = isset($_GET['submitted_email']) ? $_GET['submitted_email'] : '';
   
       //$booking = get_post_meta($booking_id);
       $booking = wc_get_order($booking_id);

      // $guest_email = $booking["st_email"][0];
      $guest_email = $booking->get_billing_email();

       if ($booking && $guest_email == urldecode($submitted_email)) {
            $post =get_post_meta($booking_id);
            $token = isset($post["_order_key"][0]) ? $post["_order_key"][0] : '';

            if (empty($token)) {
                echo 'Token not found in post meta.';
                return;
            }

           $redirect_link = site_url() . '/wp-json/booking/getbookingedites/?email=' . $guest_email . '&booking_id=' . $booking_id . '&token=' . $token;

           $subject = 'Confirmation and Action Required';
           $message = 'Click the following link to manage your booking: ' . $redirect_link;
           wp_mail($guest_email, $subject, $message);
           
           echo 'Check your Email for further instructions.';
       } else {
           echo 'Invalid email or booking';
       }
   }
 
    include_once('pages/html/form.html');
    
    ?>

  


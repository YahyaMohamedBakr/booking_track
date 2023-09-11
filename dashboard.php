<?php
/**
 * dashboard page 
 * 
 */

 
global $wpdb;


$user_id=get_current_user_id();

if(!$user_id) {echo "<h1>You do'nt have permission to show this page </h1>"; exit;};

$queryUser = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}st_order_item_meta WHERE user_id = %d", $user_id);

$results = $wpdb->get_results($queryUser);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href=<?php $url =plugins_url()."/booking_track/pages/css/style.css"?>>
    
</head>
<body>
    <div id="order-history">
        <h1>Order History</h1>
        <table id="order-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Guest Name</th>
                    <th>Status</th>
                    <!-- <th>Status2</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

           
                <?php foreach ($results as $order) : ?>

                    <?php $id = isset($order->wc_order_id)?$order->wc_order_id:'';
                    $woo_order = wc_get_order($id);
                    $status = isset($woo_order)? $woo_order->get_status():'';
                    ?>
                    <tr>
                        <td data-field-name="wc_order_id"><?php echo $order->wc_order_id; ?></td>
                        <td data-field-name="check_in"><?php echo $order->check_in; ?></td>
                        <td data-field-name="check_out"><?php echo $order->check_out; ?></td>
                        <td data-field-name="guest_name"><?php echo json_decode($order->raw_data)->guest_name[0]; ?></td>
                        <td data-field-name="status"> <?php echo $status ?></td>
                        <!-- <td data-field-name="status"> <?php echo $order->status ?></td> -->

                        <td><button class="cancel-button" data-order-id="<?php echo $order->wc_order_id; ?>">cancel this booking</button></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript Code -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
   
    <script>
    $(document).ready(function() {
    var table = $('#order-table').DataTable();

    // ...

    $('.cancel-button').on('click', function () {
        var orderId = $(this).data('order-id');
        var $row = $(this).closest('tr');
        var $cancelButton = $(this);

            var confirmCancel = confirm('Are you sure you want to cancel this order?');
           
            var urlParams = new URLSearchParams(window.location.search);
                    var user_id = urlParams.get('user_id');
            if (confirmCancel) {
                $.ajax({
                    url: '<?=site_url()?>/wp-json/booking/cancelorder', 
                    method: 'POST',
                    data: {
                        orderId: orderId,
                        userId: user_id
                    },
                    success: function(response) {
                        if (response === 'success') {
                            alert('Order canceled successfully!');
                            $row.find('[data-field-name="status"]').text('canceled');
                        } else {
                            alert('Error canceling order: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error communicating with the server: ' + error);
                    }
                });
            }
   
    });
});
</script>

</body>
</html>
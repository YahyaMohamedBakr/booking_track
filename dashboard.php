<?php
/**
 * dashboard page 
 * 
 */
global $wpdb;


$user_id=$_GET['user_id'];
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $order) : ?>
                    <tr>
                        <td data-field-name="wc_order_id"><?php echo $order->wc_order_id; ?></td>
                        <td data-field-name="check_in"><?php echo $order->check_in; ?></td>
                        <td data-field-name="check_out"><?php echo $order->check_out; ?></td>
                        <td data-field-name="guest_name"><?php echo json_decode($order->raw_data)->guest_name[0]; ?></td>
                        <td><button class="edit-button" data-order-id="<?php echo $order->wc_order_id; ?>">Edit</button></td>
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

           
//////////////////////////////////////////
            $('.edit-button').on('click', function () {
                var orderId = $(this).data('order-id');
                var $row = $(this).closest('tr');
                var $editButton = $(this);

                if ($editButton.text() === 'Edit') {
                   
                    $row.find('td:not(:last-child)').each(function () {
                        var $cell = $(this);
                        var text = $cell.text();
                        var fieldName = $cell.attr('data-field-name');

                        if (fieldName === 'guest_name' || fieldName === 'check_in' || fieldName === 'check_out') {
                            $cell.html('<input type="text" class="edit-field" value="' + text + '">');
                        }
                    });

                    $editButton.text('Save');
                } else {
                    var newGuestName = $row.find('[data-field-name="guest_name"] .edit-field').val();
                    var newCheckIn = $row.find('[data-field-name="check_in"] .edit-field').val();
                    var newCheckOut = $row.find('[data-field-name="check_out"] .edit-field').val();
                    var urlParams = new URLSearchParams(window.location.search);
                    var user_id = urlParams.get('user_id');
                    $.ajax({
                        url: '<?=site_url()?>/wp-json/booking/saveorder',
                        method: 'POST',
                        data: {
                            orderId: orderId,
                            guestName: newGuestName,
                            checkIn: newCheckIn,
                            checkOut: newCheckOut,
                            userId:  user_id
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == 'success') {
                                alert('Data saved successfully!');
                                $row.find('td:not(:last-child)').each(function () {
                                    var $cell = $(this);
                                    var fieldName = $cell.attr('data-field-name');

                                    if (fieldName === 'guest_name' || fieldName === 'check_in' || fieldName === 'check_out') {
                                        var newValue = $cell.find('.edit-field').val();
                                        $cell.html(newValue);
                                    }
                                });

                                $editButton.text('Edit');
                            } else {
                                alert('Error saving data: ' + response);
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
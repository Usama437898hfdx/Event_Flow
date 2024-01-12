<?php
session_start();
include("admin/includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CheckOutAmount = $_POST['amount'];

    $fetch_event = mysqli_query($con, "SELECT `amount` FROM `users` WHERE `id` = ".$_SESSION['uid']);
    $events = mysqli_fetch_assoc($fetch_event);
    $id = $_SESSION['uid'];

    // Validate the amount (you might want to add more validation)
    if (!is_numeric($CheckOutAmount) || $CheckOutAmount <= 0) {
        die("Invalid amount");
    }

    // Check if the user has sufficient funds
    if ($events['amount'] < $CheckOutAmount) {
        die("Insufficient funds");
    }

    // Get the user ID from the session
    $fromUserId = $_SESSION['uid'];

    // Assuming ID 14 is the organizer
    foreach ($_SESSION['cart'] as $carts) {
        
        $t = $carts['quantity'] * $carts['price'];
        $tt = $carts['ticket_type_id'];
        $oid = $carts['oid'];
        $event_id = $carts['event_id'];
        $tqty = $carts['quantity'];
        
        // Perform the SQL insertion into the wallet table
        $sql = "INSERT INTO wallet (`from_user_id`, `to_user_id`, `amount`)
                VALUES ('$fromUserId', '$oid', '$t')";
        $result = mysqli_query($con, $sql) or die("error");

        // Check for errors
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        // Update the user's wallet amount (deduct the amount)
        $sql = "UPDATE users SET amount = amount - $t WHERE id = $fromUserId";
        $result = mysqli_query($con, $sql);

        // Check for errors
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        // Update the organizer's wallet amount (add the amount)
        $sql = "UPDATE users SET amount = amount + $t WHERE id = $oid";
        $result = mysqli_query($con, $sql);

         // Check for errors
         if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        // Update the ticket status as booked
        $sql = "UPDATE ticket SET is_booked = $fromUserId WHERE event_id = $event_id and ticket_type_id = $tt and is_booked = 0 and is_deleted = 0 and is_active =1 order by ticket_id limit $tqty";
        $result = mysqli_query($con, $sql);
    
        // Check for errors
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        // Check for query success
    }
    
    $emailbody = "";
    if (isset($_SESSION['cart'])) {
    
        $emailbody .= '
          <div class="d-flex justify-content-between">
            <p>Dear <strong>' . $_SESSION['username'] . '!</strong> Thanks for your purchase.</p>
            <center>
              <h2>Your Tickets Information</h2>
            </center>
          </div>
          <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr style="border-bottom: 1px solid #ddd;">
              <th style="padding: 10px; text-align: left;">Event</th>
              <th style="padding: 10px; text-align: left;">Ticket Type</th>
              <th style="padding: 10px; text-align: left;">Unit Price</th>
              <th style="padding: 10px; text-align: left;">Quantity</th>
              <th style="padding: 10px; text-align: left;">Total</th>
            </tr>';
    
        $total = 0;
        foreach ($_SESSION['cart'] as $cart_data) {
    
            $emailbody .= '
            <tr style="border-bottom: 1px solid #ddd;">
              <td style="padding: 10px;">' . $cart_data['name'] . '</td>
              <td style="padding: 10px;">' . $cart_data['ticket_type'] . '</td>
              <td style="padding: 10px;">PKR' . $cart_data['price'] . '</td>
              <td style="padding: 10px;">' . $cart_data['quantity'] . '</td>
              <td style="padding: 10px;">PKR' . ($cart_data['quantity'] * $cart_data['price']) . '</td>
            </tr>';
            $total += $cart_data['quantity'] * $cart_data['price'];
        }
    
        $emailbody .= '
          <tr>
            <td colspan="4" style="text-align: right; padding: 10px;"><strong>Total:</strong></td>
            <td style="padding: 10px;">PKR' . $total . '</td>
          </tr>
          </table>';

          $emailbody .= '
          <div style="text-align: center; margin-top: 20px;">
              <a href="localhost/event_flow/admin/my_ticket.php?tt_id=' . $myticket['tt_id'] . '" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">View Tickets</a>
          </div>';
      
        $recemail = $_SESSION['email'];
        include('gmail-email/index.php');
        
    }
    



    // Update the user's wallet amount in the session after successful transaction
    $_SESSION['user_wallet'] -= $CheckOutAmount;

    // Clear the cart after successful transaction
    unset($_SESSION['cart']);

    // Close database connection
    mysqli_close($con);

    echo "Check-Out successful!";
}
?>

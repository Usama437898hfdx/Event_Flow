<?php
session_start();
include("admin/includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CheckOutAmount = $_POST['amount'];

    // Validate the amount (you might want to add more validation)
    if (!is_numeric($CheckOutAmount) || $CheckOutAmount <= 0) {
        die("Invalid amount");
    }

    // Update the user's wallet amount in the session
    if (isset($_SESSION['user_wallet'])) {
        $_SESSION['user_wallet'] -= $CheckOutAmount;
    } else {
        $_SESSION['user_wallet'] = $CheckOutAmount;
    }

    // Get the user ID from the session
    $fromUserId = $_SESSION['uid'];

    // Assuming ID 14 is the organizer
    foreach ($_SESSION['cart'] as $carts) {
        
        $t = $carts['quantity'] * $carts['price'];
        $tt= $carts['ticket_type_id'];
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

        // Update the user's wallet amount
        $sql = "UPDATE users SET amount = amount - $t WHERE id = $fromUserId";
        $result = mysqli_query($con, $sql);

        // Check for errors
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        // Update the organizer's wallet amount
        $sql = "UPDATE users SET amount = amount + $t WHERE id = $oid";
        $result = mysqli_query($con, $sql);

         // Check for errors
         if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        $sql = "UPDATE ticket SET is_booked = $fromUserId WHERE event_id = $event_id and ticket_type_id = $tt and is_booked = 0 and is_deleted = 0 and is_active =1 order by ticket_id limit $tqty";
        $result = mysqli_query($con, $sql);
    
        // Check for errors
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        // Check for query success
       
    }

        unset($_SESSION['cart']);
        //echo "<script>window.location.href='cart.php';</script>";
    echo "Check-Out successful!";
}

// Close database connection
mysqli_close($con);
?>

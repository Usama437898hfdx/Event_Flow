<?php
session_start();
include("includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $WithdrawAmount = $_POST['amount'];
    
    $fetch_event = mysqli_query($con, "SELECT `amount` FROM `users` WHERE `id` = ".$_SESSION['uid']);
    $events = mysqli_fetch_assoc($fetch_event);

    // Perform server-side validation and processing
    // Get the user ID from the session
    $id = $_SESSION['uid'];

    // Check if the user has sufficient funds for withdrawal
    if ($events['amount'] >= $WithdrawAmount) {
        $_SESSION['user_wallet'] -= $WithdrawAmount;

        // Perform the SQL insertion (consider using prepared statements)
        $sql = "INSERT INTO wallet (`from_user_id`, `to_user_id`, `amount`)
                VALUES ('$id', '$id', '$WithdrawAmount')";

        // Execute the query
        $result = mysqli_query($con, $sql);

        // Check for successful wallet update
        if ($result) {
            // Update the user's amount in the 'users' table
            $sql = "UPDATE users SET amount = amount - $WithdrawAmount WHERE id = $id";
            $result = mysqli_query($con, $sql);

            // Check for successful amount update
            if ($result) {
                $message = "Withdrawal successful!";
            } else {
                $message = "Withdrawal failed! (Error updating user amount)";
            }
        } else {
            $message = "Withdrawal failed! (Error updating wallet)";
        }
    } else {
        $message = "Insufficient funds!";
    }

    // Use JavaScript to show an alert
    echo "<script>alert('$message');</script>";
}

// Close the database connection
mysqli_close($con);
?>

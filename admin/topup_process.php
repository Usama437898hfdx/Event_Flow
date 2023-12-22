<?php
session_start();
include("includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topUpAmount = $_POST['amount'];

    // Perform server-side validation and processing
    // Update the user's wallet amount in the session
    if (isset($_SESSION['user_wallet'])) {
        $_SESSION['user_wallet'] += $topUpAmount;
    } else {
        $_SESSION['user_wallet'] = $topUpAmount;
    }

    // Get the user ID from the session
    $id = $_SESSION['uid'];

    // Perform the SQL insertion
    $sql = "INSERT INTO wallet (`from_user_id`, `to_user_id`, `amount`)
            VALUES ('$id', '$id', '$topUpAmount')";

    // Execute the query
    $result = mysqli_query($con, $sql);


    $sql = "update users set amount = amount+$topUpAmount where id = $id;";

    $result = mysqli_query($con, $sql);

    // Check for query success
    if ($result) {
        echo "Top-up successful!";
    }
}
    ?>
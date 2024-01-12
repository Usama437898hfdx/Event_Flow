<?php
// Start the session and include necessary configuration
session_start();
include("includes/config.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get refund amount and ticket ID from the form
    $refundAmount = $_POST['amount'];
    $ticketId = $_POST['ticket_id'];

    // Fetch user's current wallet amount
    $fromUserId = $_SESSION['uid'];


    $org = "SELECT organizer_id from events where event_id = (SELECT event_id FROM `ticket` where ticket_id = $ticketId);";
    $qq = mysqli_query($con, $org) or die("Error getting organizer id");
    $o = mysqli_fetch_assoc($qq);
    $OId = $o['organizer_id'];


    // Insert a record into the wallet table for the refund
    $insertWalletQuery = "INSERT INTO wallet (`from_user_id`, `to_user_id`, `amount`)
                          VALUES ('$fromUserId', '$OId', '$refundAmount')";
    mysqli_query($con, $insertWalletQuery) or die("Error inserting into wallet");

    // Update user's wallet (deduct the refund amount)
    $updateUserWalletQuery = "UPDATE users SET amount = amount + '$refundAmount' WHERE id = '$fromUserId'";
    mysqli_query($con, $updateUserWalletQuery) or die('Error updating user wallet');

    // Assuming 'oid' is the organizer's ID, update organizer's wallet (add the refund amount)
    $updateOrganizerWalletQuery = "UPDATE users SET amount = amount - '$refundAmount' WHERE id = '$OId'";
    mysqli_query($con, $updateOrganizerWalletQuery) or die('Error updating organizer wallet');

    // Update the ticket status as unbooked
    $updateTicketQuery = "UPDATE ticket SET is_booked = 0 
                          WHERE ticket_id = $ticketId";
    mysqli_query($con, $updateTicketQuery) or die('Error updating ticket status');

    // Update user's wallet amount in the session after a successful transaction
    $_SESSION['user_wallet'] -= $refundAmount;

    // Close the database connection
    mysqli_close($con);

    // Display success message
    echo "Refund successful!";
}
?>

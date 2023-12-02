<?php
session_start();

if (isset($_POST['ticketTypeId']) && isset($_POST['action'])) {
    $ticketTypeId = $_POST['ticketTypeId'];
    $action = $_POST['action'];

    if ($action === 'increase') {
        // Increase quantity
        $_SESSION['cart'][$ticketTypeId]['quantity']++;
    } elseif ($action === 'decrease') {
        // Decrease quantity, but ensure it doesn't go below 1
        if ($_SESSION['cart'][$ticketTypeId]['quantity'] > 1) {
            $_SESSION['cart'][$ticketTypeId]['quantity']--;
        }
    }
    echo 'success';
} else {
    echo 'error';
}
?>

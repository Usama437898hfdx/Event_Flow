<?php
// Start a session to manage user authentication
session_start();
if (!isset($_SESSION['Admin']) && !isset($_SESSION['Organizer']) && !isset($_SESSION['Attendee'])) {
    header('location:login.php');
    exit;
}
include("includes/config.php");
include("includes/header.php");
?>
<style>
.payment-info {
    background: blue;
    padding: 10px;
    border-radius: 6px;
    color: #fff;
    font-weight: bold;
}

.product-details {
    padding: 10px;
}

body {
    background: #eee;
}

.cart {
    background: #fff;
}

.p-about {
    font-size: 12px;
}

.table-shadow {
    -webkit-box-shadow: 5px 5px 15px -2px rgba(0, 0, 0, 0.42);
    box-shadow: 5px 5px 15px -2px rgba(0, 0, 0, 0.42);
}

.type {
    font-weight: 400;
    font-size: 10px;
}

label.radio {
    cursor: pointer;
}

label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none;
}

label.radio span {
    padding: 1px 12px;
    border: 2px solid #ada9a9;
    display: inline-block;
    color: #8f37aa;
    border-radius: 3px;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 300;
}

label.radio input:checked+span {
    border-color: #fff;
    background-color: blue;
    color: #fff;
}

.credit-inputs {
    background: rgb(102, 102, 221);
    color: #fff !important;
    border-color: rgb(102, 102, 221);
}

.credit-inputs::placeholder {
    color: #fff;
    font-size: 13px;
}

.credit-card-label {
    font-size: 9px;
    font-weight: 300;
}

.form-control.credit-inputs:focus {
    background: rgb(102, 102, 221);
    border: rgb(102, 102, 221);
}

.line {
    border-bottom: 1px solid rgb(102, 102, 221);
}

.information span {
    font-size: 12px;
    font-weight: 500;
}

.information {
    margin-bottom: 5px;
}

.items {
    -webkit-box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.25);
    box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08);
}

.spec {
    font-size: 11px;
}
</style>
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Wallet</a></li>
            </ol>
        </div>
    </div>

    <div class="col-md-4">
        <div class="payment-info">
            <div class="d-flex justify-content-between align-items-center">
                <span>Card details</span>
                <img class="rounded" src="https://i.imgur.com/WU501C8.jpg" width="30">
            </div>
            <span class="type d-block mt-3 mb-1">Card type</span>
            <label class="radio">
                <input type="radio" name="card" value="payment" checked>
                <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png" /></span>
            </label>

            <label class="radio">
                <input type="radio" name="card" value="payment">
                <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png" /></span>
            </label>

            <label class="radio">
                <input type="radio" name="card" value="paypal" onclick="openPayPalModal()">
                <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png" /></span>
            </label>

            <div>
                <label class="credit-card-label">Name on card</label><input type="text"
                    class="form-control credit-inputs" placeholder="Name">
            </div>
            <div>
                <label class="credit-card-label">Card number</label><input type="text"
                    class="form-control credit-inputs" placeholder="0000 0000 0000 0000">
            </div>
            <div class="row">
                <div class="col-md-6"><label class="credit-card-label">Date</label><input type="date"
                        class="form-control credit-inputs" placeholder="12/24"></div>
                <div class="col-md-6"><label class="credit-card-label">CVV</label><input type="number"
                        class="form-control credit-inputs" placeholder="342"></div>
            </div>
            <hr class="line">
            <label>Top-Up Amount</label>
            <input type="number" id="topupAmount" class="form-control" placeholder="Enter the top-up amount">

            <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button"
                onclick="submitTopUp()">
                <span>Top Up<i class="fa fa-long-arrow-right ml-1"></i></span>
            </button>
        </div>
    </div>

    <script>
   function submitTopUp() {
    var topUpAmount = document.getElementById('topupAmount').value;

    // Perform validation if needed

    // Use AJAX to send the top-up amount to the server-side script
    $.ajax({
        type: 'POST',
        url: 'topup_process.php',
        data: {
            amount: topUpAmount
        },
        success: function(response) {
            // Handle the response from the server (e.g., update UI)

            // Redirect to wallet.php
            window.location.href = 'wallet.php';
        },
        error: function(error) {
            console.error(error);
        }
    });
}

    </script>

    <?php include("includes/footer.php"); ?>
</div>

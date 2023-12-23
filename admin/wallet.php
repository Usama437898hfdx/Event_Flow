<?php
session_start();
if (!isset($_SESSION['Admin']) && !isset($_SESSION['Organizer']) && !isset($_SESSION['Attendee'])) {
    header('location:login.php');
    exit;
}
include("includes/config.php");
include("includes/header.php");
?>

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

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">

                            <h1>Your Wallet</h1>
                            <?php 
                                $fetch_event = mysqli_query($con, "SELECT `amount` FROM `users` WHERE `id` = ".$_SESSION['uid']);
                                $events = mysqli_fetch_assoc($fetch_event);
                            ?>
                            <div id="balance">Balance: PKR <?php echo isset($events['amount']) ? number_format($events['amount'], 2) : '0.00'; ?></div>

                            <a href="topup.php" class="btn btn-primary">Top Up</a>
                            <a href="withdraw.php" class="btn btn-primary">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</div>

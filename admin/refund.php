<?php
session_start();
include("includes/header.php");
?>

<style>
    .container {
        text-align: center;
    }

    img {
        max-width: 100%;
        height: auto;
        margin: 0 auto; /* This will center the image horizontally within the container */
        display: block; /* This removes extra space beneath the image */
        width: 80%; /* Adjust the width percentage as needed */
        max-height: 400px; /* Set a maximum height for the image */
    }
</style>

<body>

    <div class="content-body">
        <!-- Breadcrumbs -->
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="my_ticket.php">My Tickets</a></li>
                </ol>
            </div>
        </div>
        <!-- Your header content goes here -->
        <!-- Content body start -->

        <br></br>
        <div class="container">
            <img class="img-fluid" src="../assets/images/re.jpeg">
        </div>

        <div class="container">

        </div>

        <br></br>
        <br></br>
        <br></br>

        <?php include("includes/footer.php"); ?>
</body>

<?php
session_start();
include("includes/config.php");
include("includes/header.php");


?>
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Calender</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Calendar</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mt-5">
                                <div id="external-events" class="m-t-20">
                                    <!-- Your external events section -->

                                    <!-- Add more events here -->
                                </div>
                            </div>
                            <div class="col-md-8 d-flex justify-content-center align-items-center">
                                <div class="card-box m-b-50">
                                    <div id="calendar" class="calendar-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php include("includes/footer.php"); ?>

    <!--**********************************
        Scripts
    ***********************************-->
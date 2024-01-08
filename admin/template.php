<?php session_start();
if (!isset($_SESSION['Admin']) && !isset($_SESSION['Organizer'])) {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Main Events</a></li>
            </ol>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title">Create Main Events</h1>
                            <?php if(isset($_SESSION['Organizer'])){ ?>
                            <a href="create_main_event.php" style="margin-bottom:12px !important;"
                                class="btn btn-primary">Create new</a>
                            <?php } ?>
                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Tempelate No</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <a href="assets/images/t1.png"
                                                class="btn btn-primary">View Tempelate</a>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            <a href="assets/images/t2.png"
                                                class="btn btn-primary">View Tempelate</a>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            3
                                        </td>
                                        <td>
                                            <a href="assets/images/t3.png"
                                                class="btn btn-primary">View Tempelate</a>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            4
                                        </td>
                                        <td>
                                            <a href="assets/images/t4.png"
                                                class="btn btn-primary">View Tempelate</a>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            5
                                        </td>
                                        <td>
                                            <a href="assets/images/t5.png"
                                                class="btn btn-primary">View Tempelate</a>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include("includes/footer.php"); ?>
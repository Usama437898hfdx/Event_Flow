<?php session_start();
if ( !isset($_SESSION['Organizer']) ) {
    header('location:login.php');
    exit;
}
include("includes/config.php");
include("includes/header.php"); ?>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Events</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Mian Event</a></li>
            </ol>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Create Main Event</h1>
                        <form action="includes/db.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_name">Event Name:</label>
                                        <input type="text" class="form-control" id="eventname" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">image:</label>
                                        <input class="form-control" type="file" id="image" name="image" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="eventDescription">Description:</label>
                                        <textarea class="form-control" cols="" rows="6" id="description"
                                            name="description" required></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="event_type" value="main">
                            </div>
                           
                           
                            <button type="submit" name="create_new" class="btn btn-primary">Create new</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
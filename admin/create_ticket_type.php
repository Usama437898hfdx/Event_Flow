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
                <li class="breadcrumb-item"><a href="javascript:void m (0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Ticket Type</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Ticket Type</a></li>
            </ol>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Create Ticket Type</h1>
                        <form action="includes/db.php" method="POST" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketName">Event:</label>
                                        <select name="event_id" class="form-control">
                                            <?php $fetch_event = mysqli_query($con, "SELECT * FROM `events` WHERE `parent_id` IS NOT NULL AND `is_deleted` = 0 AND `is_active` = 1 AND `organizer_id` = '" . $_SESSION['Organizer']['id'] . "'");
                                            foreach ($fetch_event as $event) {

                                                ?>
                                                <option value="<?php echo $event['event_id']; ?>">
                                                    <?php echo $event['name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketName">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Price:</label>
                                        <input class="form-control" type="number" id="price" name="price" required>
                                    </div>
                                </div>

                            </div>


                            <button type="submit" name="create_ticket_type" class="btn btn-primary">Create new</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
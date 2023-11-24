<?php session_start();
if (!isset($_SESSION['Admin']) && !isset($_SESSION['Organizer']) && !isset($_SESSION['Attendee'])) {
    header('location:login.php');
    exit;

}
include("includes/config.php");
include("includes/header.php");


?>

<!-- Content body start -->
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

    <!-- Main Content -->
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
                                        <th>Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_SESSION['uid'];

                                    if (isset($_SESSION['Organizer'])) {
                                        $condition = "AND `organizer_id` = $id ";
                                    } else {
                                        $condition = "";
                                    }


                                    $fetch_event = mysqli_query($con, "SELECT * FROM `events` where is_deleted = 0  AND `parent_id` IS NULL $condition");

                                    foreach ($fetch_event as $event) {

                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $event['name']; ?>
                                        </td>

                                        <td>

                                            <a href="events.php?main_id=<?php echo $event['event_id']; ?>"
                                                class="btn btn-primary">View Sub Events</a>



                                            <button class="btn btn-primary text-white" onclick="openEditModal(
                                                    '<?php echo $event['event_id']; ?>',
                                                    '<?php echo $event['name']; ?>',
                                                    '<?php echo $event['start_date']; ?>',
                                                    '<?php echo $event['image']; ?>',
                                                    '<?php echo $event['description']; ?>',
                                                    '<?php echo $event['end_date']; ?>'
                                                    
                                                
                                                    );">Edit</button>



                                            <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $event['event_id']; ?>');">Delete</button>




                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="EditEventModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editForm" action="includes/db.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="submit" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventname">Event Name:</label>
                                <input type="text" class="form-control" id="edit_eventname" name="eventname" required>
                                <input class="form-control" type="hidden" name="event_id" id="edit_event_id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventname">Description:</label>
                                <input type="text" class="form-control" id="edit_description" name="description"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventname">Start Date:</label>
                                <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventname">End Date:</label>
                                <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_image">New Image:</label>
                                <input class="form-control" type="file" id="new_image" name="new_image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old_image">Old Image:</label>
                                <input type="hidden" id="old_image" name="old_image"
                                    value="<?php echo $event['image']; ?>">
                                <img src="" id="edit_old_image" alt="Old Image" width="100">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="editMainEvent" class="btn btn-primary">Save Changes</button>
                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="DeleteEventModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog ">
        <form id="deleteForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Event</h5>
                    <button type="submit" name="delete" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete this event?</p>
                        <input type="hidden" id="delete_event_id" name="id" value="">
                        <input type="hidden" id="delete_event_id" name="main" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteMainEvent" class="btn btn-danger">Delete</button>
                </div>

            </div>
        </form>
    </div>
</div>





<script>
function openEditModal(id, name, start_date, image, description, end_date) {

    document.getElementById("edit_event_id").value = id;
    document.getElementById("edit_eventname").value = name;
    document.getElementById("edit_start_date").value = start_date;


    document.getElementById("edit_old_image").src = '../assets/images/events/' + image;
    $("#EditEventModal").modal("show");

    document.getElementById("edit_description").value = description;
    document.getElementById("edit_end_date").value = end_date;

}

function openDeleteModal(id) {
    document.getElementById("delete_event_id").value = id;
    $("#DeleteEventModal").modal("show");
}
</script>

<?php include("includes/footer.php"); ?>
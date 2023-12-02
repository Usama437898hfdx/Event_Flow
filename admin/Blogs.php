<?php session_start();

if (!isset($_SESSION['Admin'])  && !isset($_SESSION['Organizer']) && !isset($_SESSION['Attendee']) ) {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Blogs</a></li>
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
                            <h1 class="card-title">Blogs</h1>


                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Sub Event name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                            
                          
                            <?php
                                  

                                  $blogs = mysqli_query($con, "SELECT 
                                  e.name AS event_name,  
                                  b.text
                              FROM 
                                  events e
                              INNER JOIN 
                                  blog b ON b.event_id = e.event_id
                              WHERE 
                                  e.organizer_id = $id
                              ");


                            foreach ($blogs as $blog) {
                                ?>
                                <tr>
                                <td>
                                            <?php echo $blog['event_name']; ?>
                                            
                                        </td>

                                        <td>

                                            <button class="btn btn-primary text-white" onclick="openViewModal('<?php echo $blog['blog_id']; ?>',
                                                    '<?php echo $blog['event_name']; ?>',
                                                    '<?php echo $blog['description']; ?>',
                                                   

                                                );">View</button>

                                            <button class="btn btn-primary text-white" onclick="openEditModal(
                                                    '<?php echo $blog['blog_id']; ?>',
                                                    '<?php echo $blog['name']; ?>',
                                                   
                                                    

                                                    );">Edit</button>

                                            <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $blog['blog_id']; ?>');">Delete</button>


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
                    <h5 class="modal-title">Edit Blog</h5>
                    <button type="submit" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventname">Event Name:</label>
                                <input type="text" class="form-control" id="edit_eventname" name="eventname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="edit_description"
                                    required></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="editEvent" class="btn btn-primary">Save Changes</button>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteEvent" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>




<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventname">Event Name:</label>
                            <input type="text" class="form-control" id="view_eventname" readonly name="name" required>
                            <input class="form-control" type="hidden" name="view_event_id" id="view_event_id" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description"> Description:</label>
                            <textarea class="form-control" id="view_description" readonly name="description"
                                required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">start_date:</label>
                            <input class="form-control" type="date" id="view_start_date" readonly name="start_date"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">end_date:</label>
                            <input class="form-control" type="date" id="view_end_date" readonly name="end_date"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_time">start_time:</label>
                            <input class="form-control" type="time" id="view_start_time" readonly name="start_time"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_time">end_time:</label>
                            <input class="form-control" type="time" id="view_end_time" readonly name="end_time"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">location:</label>
                            <input class="form-control" type="text" id="view_location" readonly name="location"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacity">capacity:</label>
                            <input class="form-control" type="number" id="view_capacity" readonly name="capacity"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="old_image">Old Image:</label>
                            <input type="hidden" id="old_image" name="old_image" value="<?php echo $event['image']; ?>">
                            <img src="" id="view_old_image" alt="Old Image" width="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<script>
function openEditModal(id, name, description, start_date, end_date, start_time, end_time, location, capacity,
    image) {

    document.getElementById("edit_event_id").value = id;
    document.getElementById("edit_eventname").value = name;
    document.getElementById("edit_description").value = description;
    document.getElementById("edit_start_date").value = start_date;
    document.getElementById("edit_end_date").value = end_date;
    document.getElementById("edit_start_time").value = start_time;
    document.getElementById("edit_end_time").value = end_time;
    document.getElementById("edit_location").value = location;
    document.getElementById("edit_capacity").value = capacity;
    document.getElementById("edit_old_image").src = '../assets/images/events/' + image;
    $("#EditEventModal").modal("show");

}

function openDeleteModal(id) {
    document.getElementById("delete_event_id").value = id;
    $("#DeleteEventModal").modal("show");
}


function openViewModal(id, name, description, start_date, end_date, start_time, end_time, location, capacity,
    image) {

    document.getElementById("view_event_id").value = id;
    document.getElementById("view_eventname").value = name;
    document.getElementById("view_description").value = description;
    document.getElementById("view_start_date").value = start_date;
    document.getElementById("view_end_date").value = end_date;
    document.getElementById("view_start_time").value = start_time;
    document.getElementById("view_end_time").value = end_time;
    document.getElementById("view_location").value = location;
    document.getElementById("view_capacity").value = capacity;
    document.getElementById("view_old_image").src = '../assets/images/events/' + image;


    $("#ViewModal").modal("show");
}
</script>

<?php include("includes/footer.php"); ?>
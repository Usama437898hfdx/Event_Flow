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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Question Form</a></li>
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
                            <h1 class="card-title">Question Forms</h1>

                            <a href="create_question_form.php" style="margin-bottom:12px !important;"
                                class="btn btn-primary">Create new</a>
                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               
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
                                <label for="eventname">Name:</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                                <input class="form-control" type="hidden" name="addon_id" id="edit_addon_id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_image">Price:</label>
                                <input class="form-control" type="number" id="edit_price" name="price">
                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="edit_addon" class="btn btn-primary">Save Changes</button>
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
                        <input type="hidden" id="delete_addon_id" name="addon_id" value="">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteAddon" class="btn btn-danger">Delete</button>
                </div>

            </div>
        </form>
    </div>
</div>





<script>
function openEditModal(id, name, price) {
    document.getElementById("edit_addon_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_price").value = price;


    $("#EditEventModal").modal("show");

}

function openDeleteModal(id) {
    document.getElementById("delete_addon_id").value = id;
    $("#DeleteEventModal").modal("show");
}
</script>

<?php include("includes/footer.php"); ?>
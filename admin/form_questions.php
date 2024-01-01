<?php session_start();
if ( !isset($_SESSION['Organizer']) ) {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Form Questions</a></li>
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
                            <h1 class="card-title">Form Questions</h1>

                            <a href="create_question_form.php?fid=<?php echo $questions['form_id']; ?>"
                                style="margin-bottom:12px !important;" class="btn btn-primary">Create new</a>
                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Question</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
        
        $fetch_questions = mysqli_query($con,"SELECT q.*,e.parent_id,e.name As eventname,f.form_id
        FROM events e
        LEFT JOIN registration_form f ON f.event_id = e.event_id
        LEFT JOIN registrationquestions q  ON q.form_id = f.form_id
        WHERE 
    e.organizer_id = $id AND e.parent_id IS NOT NULL
        " );

        foreach($fetch_questions as $questions){  
            
          ?>

                                    <tr>
                                        <td>
                                            <?php echo $questions["eventname"]?>
                                        </td>
                                        <td>
                                            <?php echo $questions["Question"]?>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $event['question_id']; ?>');">Delete</button>
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
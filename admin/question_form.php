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

                            <button class="btn btn-primary text-white" onclick="openCreateModal();">Create Form</button>
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
                                <tbody>
                                    <?php
        
        $fetch_form = mysqli_query($con,"SELECT f.*,e.name As eventname
        FROM registration_form f 
        LEFT JOIN events e ON f.event_id = e.event_id
        WHERE 
    e.organizer_id = $id
        " );

        foreach($fetch_form as $form){  
            
          ?>

                                    <tr>
                                        <td>
                                            <?php echo $form["eventname"]?>
                                        </td>
                                        <td>
                                            <a href="view_questions.php?fid=<?php echo $form['form_id']; ?>"
                                                class="btn btn-primary">View Questions</a>
                                            <a href="create_questions.php?fid=<?php echo $form['form_id']; ?>"
                                                class="btn btn-primary">Create Question</a>
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

<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="createForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Form</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="eventname">Event:</label>
                        <input class="form-control" type="hidden" name="event_id" id="event_id" required>
                        <input class="form-control" type="hidden" name="form_id" id="form_id" required>
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

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="add_form" class="btn btn-primary">Submit</button>

                </div>
            </div>



        </form>
    </div>
</div>


<script>
function openCreateModal(form_id, event_id) {
    document.getElementById("form_id").value = form_id;
    document.getElementById("event_id").value = event_id;




    $("#CreateModal").modal("show");
}
</script>


<?php include("includes/footer.php"); ?>
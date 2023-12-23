<?php
session_start();
if ( !isset($_SESSION['Organizer']) ) {
    header('location:login.php');
    exit;
}
include("includes/config.php");
include("includes/header.php");

?>

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Ticket</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">View Tickets</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title">View Tickets</h1>
                            <!-- <a href="create_ticket.php" class="btn btn-primary">Create new</a> -->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Type</th>
                                        <th>Discount</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                    $tickets = mysqli_query($con, "SELECT t.ticket_id, e.name AS event_name, tt.name AS ticket_type_name, t.Qrcode, t.discount, t.ticket_type_id FROM ticket t JOIN events e ON t.event_id = e.event_id JOIN ticket_type tt ON t.ticket_type_id = tt.ticket_type_id WHERE t.is_deleted = 0 AND t.ticket_type_id  = '".$_GET['tt_id']."'");

                                    foreach ($tickets as $ticket) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $ticket['event_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ticket['ticket_type_name']; ?>
                                        </td>

                                        <td>
                                            <?php echo $ticket['discount']; ?>
                                        </td>

                                        <!-- button class="btn btn-primary text-white" onclick="openEditModal('<?php echo $ticket['ticket_id']; ?>',
    '<?php echo $ticket['ticket_type_id']; ?>',
    '<?php echo $ticket['discount']; ?>');">Edit</button> -->
                                        <td>
                                            <!-- <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $ticket['ticket_id']; ?>',
                                                '<?php echo $ticket['ticket_type_id']; ?>');">
                                                Delete</button> -->
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

<!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" action="includes/db.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to delete this ticket?</p>
                    <input type="hidden" id="ticket_id" name="ticket_id" value="">
                    <input type="hidden" id="ticket_type_id" name="ticket_type_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteticket" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_ticket_id" name="ticket_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ticketType">Ticket Type:</label>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ticketName">Discount:</label>
                                            <input type="number" class="form-control" id="discount" name="discount"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ticketDescription">Addon:</label>
                                            <input type="number" class="form-control" id="addon_id" name="addon_id"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="editticket" class="btn btn-primary">Save
                                        Changes</button>
                                </div>
                            </div>
        </form>
    </div>
</div> -->

<!-- 
<script>
function openEditModal(ticket_id, ticket_type_id, discount, addon_id, ) {

    document.getElementById("edit_ticket_id").value = ticket_id;

    document.getElementById("discount").value = discount;
    document.getElementById("addon_id").value = addon_id;


    $("#EditModal").modal("show");
}



// function openDeleteModal(ticket_id, ticket_type_id) {
//     document.getElementById("ticket_id").value = ticket_id;
//     document.getElementById("ticket_type_id").value = ticket_type_id;
//     $("#deleteModal").modal("show");
// }
</script> -->






<?php include("includes/footer.php"); ?>
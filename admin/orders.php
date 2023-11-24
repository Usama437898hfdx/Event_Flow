<?php
session_start();
include("includes/config.php");
include("includes/header.php");

$fetch_tickets = mysqli_query($con, "SELECT * FROM ticket WHERE is_deleted = 0");
$tickets = mysqli_fetch_all($fetch_tickets, MYSQLI_ASSOC);
?>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">orders</a></li>
            </ol>
        </div>
    </div>

    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Addon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket) { ?>
                                    <tr>
                                        <td><?php echo $ticket['ticket_type_id']; ?></td>
                                        <td><?php echo $ticket['price']; ?></td>
                                        <td><?php echo $ticket['discount']; ?></td>
                                        <td><?php echo $ticket['addon_id']; ?></td>

                                        <td>
                                            <button class="btn btn-primary text-white" onclick="openViewModal(
                                            <?php echo $ticket['ticket_type_id']; ?>,
                                            <?php echo $ticket['price']; ?>,
                                            <?php echo $ticket['discount']; ?>,
                                            <?php echo $ticket['addon_id']; ?>
                                             )">View</button>

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
    </div> -->
</div>

<!-- View Ticket Modal -->
<div class="modal fade" id="viewTicketModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ticket Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="viewTicketType">Ticket Type:</label>
                            <input type="text" class="form-control" id="viewTicketType" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="viewTicketPrice">Ticket Price:</label>
                            <input type="text" class="form-control" id="viewTicketPrice" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="viewTicketDiscount">Discount:</label>
                            <input type="text" class="form-control" id="viewTicketDiscount" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="viewTicketAddon">Addon:</label>
                            <input type="text" class="form-control" id="viewTicketAddon" readonly>
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
function openViewModal(type, price, discount, addon) {
    document.getElementById("viewTicketType").value = type;
    document.getElementById("viewTicketPrice").value = price;
    document.getElementById("viewTicketDiscount").value = discount;
    document.getElementById("viewTicketAddon").value = addon;

    $("#viewTicketModal").modal("show");
}
</script>

<?php include("includes/footer.php"); ?>
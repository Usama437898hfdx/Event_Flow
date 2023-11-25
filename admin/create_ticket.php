<?php session_start();
include("includes/config.php");
include("includes/header.php"); ?>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Ticket</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Ticket</a></li>
            </ol>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Create New Ticket</h1>
                        <form action="includes/db.php" method="POST">
                            <input type="hidden" value="<?php echo $_GET['eid']; ?>" name="event_id" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketType">Ticket Type:</label>
                                        <select class="form-control" id="ticketType" name="ticket_type_id" required>
                                            <?php $fetch_ticket_types = mysqli_query($con, "SELECT * FROM ticket_type WHERE `event_id` = '" . $_GET['eid'] . "'");
                                            foreach ($fetch_ticket_types as $ticket_type) { ?>
                                            <option value="<?php echo $ticket_type['ticket_type_id']; ?>">
                                                <?php echo $ticket_type['name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketType">Add On:</label>
                                        <select name="addons[]" class="selectpicker form-control" multiple
                                            data-live-search="true">
                                            <?php $fetch_addon = mysqli_query($con, "SELECT * FROM addon WHERE is_deleted = 0 AND is_active = 1 AND `organizer_id` = $id");
            foreach ($fetch_addon as $addons) { ?>
                                            <option value="<?php echo $addons['Addon_id']; ?>">
                                                <?php echo $addons['name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketName">Discount:</label>
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            required>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketQuantity">Quantity:</label>
                                        <input type="number" name="quantity" class="form-control" id="Capacity"
                                            required>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" name="create_ticket" class="btn btn-primary">Create Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
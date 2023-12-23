<?php session_start();

if (!isset($_SESSION['Attendee']) ) {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">My tickets</a></li>
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
                            <h1 class="card-title">My tickets</h1>
                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Event name</th>
                                        <th>ticket type</th>
                                        <th>Price</th>
                                        <th>Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id=$_SESSION['uid'];
                             $fetch_mytickets = mysqli_query($con, "SELECT  
                             e.name AS event_name,
                             e.event_id,
                             t.is_booked,
                             tt.price AS ticket_price,
                             MIN(t.ticket_id) AS ticket_id,
                             tt.name AS ticket_type_name,
                             t.ticket_type_id AS tt_id,
                             COUNT(t.is_booked IS NOT NULL) AS Mytickets_Count
                         FROM 
                         
                             events e
                         LEFT JOIN 
                             ticket t ON t.event_id = e.event_id
                         LEFT JOIN 
                             ticket_type tt ON t.ticket_type_id = tt.ticket_type_id 
                         WHERE 
                             t.is_deleted = 0 
                            AND t.is_booked = $id
                         GROUP BY 
                             e.event_id, tt.ticket_type_id, e.name, tt.name, t.is_booked = $id
                         HAVING 
                         Mytickets_Count > 0
                         LIMIT 0, 25;
                         " );
                         
                                    foreach ($fetch_mytickets as $myticket) {
                                        ?>

                                    <tr>
                                        <td>
                                            <?php echo $myticket['event_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['ticket_type_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['ticket_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['Mytickets_Count']; ?>
                                        </td>
                                    <td>
                                        <button class="btn btn-primary text-white" onclick=" ">View</button>


                                        <button class="btn btn-danger" onclick=" ">Refund</button>


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











<script>

</script>

<?php include("includes/footer.php"); ?>
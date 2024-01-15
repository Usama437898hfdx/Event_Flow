<?php session_start();

if (!isset($_SESSION['Organizer']) ) {
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
                                        <th>Ticket Quantity</th>
                                        <th>Ticket Sold</th>
                                        <th>Ticket Sold Price</th>
                                        <th>Ticket Left</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
    $org = "SELECT organizer_id from events ";
    $qq = mysqli_query($con, $org) or die("Error getting organizer id");
    $o = mysqli_fetch_assoc($qq);
    $OId = $o['organizer_id'];

                             $fetch_mytickets = mysqli_query($con, "SELECT  
                             e.*,
                             cat.category_id AS cid,
                             t.Qrcode,
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
                        LEFT JOIN 
                             event_categories cat ON cat.category_id = e.category_id
                         WHERE 
                             t.is_deleted = 0 
                            AND t.is_booked 
                         GROUP BY 
                             e.event_id, tt.ticket_type_id, e.name, tt.name, t.is_booked = $OId
                         HAVING 
                         Mytickets_Count > 0
                         LIMIT 0, 25;" );


                                    foreach ($fetch_mytickets as $myticket) {
                                        ?>

                                    <tr>
                                        <td>
                                            <?php echo $myticket['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['ticket_type_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['capacity']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['Mytickets_Count']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['ticket_price'] * $myticket['Mytickets_Count']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['capacity']-$myticket['Mytickets_Count'] ; ?>
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
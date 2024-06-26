<?php
session_start();

if (!isset($_SESSION['Attendee'])) {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">View My tickets</a></li>
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
                                        <th>tickettype</th>
                                        <th>Price</th>
                                        <th>Event Start Time left</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $uid = $_SESSION['uid']; // Sanitize this input to prevent SQL injection
                                $mytickets = mysqli_query($con, "SELECT t.ticket_id, e.*, tt.name  AS ticket_type_name, tt.temp_id as temp_id,tt.price, t.Qrcode, t.discount, t.ticket_type_id FROM ticket t JOIN events e ON t.event_id = e.event_id JOIN ticket_type tt ON t.ticket_type_id = tt.ticket_type_id WHERE t.is_deleted = 0 AND t.is_booked = '$uid' AND t.ticket_type_id  = '".$_GET['tt_id']."'");
                                $cinema = 0;
                                $i = 1;
                          


                                foreach ($mytickets as $myticket) { 
                                    if($i == 1){
                                        $i++;
                                        $cinema = $myticket['temp_id'] == 5 ? $myticket['ticket_id'] : 0;
                                    }
                                  
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $myticket['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['ticket_type_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $myticket['price']; ?>
                                        </td>
                                        <td>

                                            <?php    
                                            $startDateTime = $myticket['start_date'] . ' ' . $myticket['start_time'];
                                            $startTimestamp = strtotime($startDateTime);
                                            $currentTimestamp = time();
                                            $timeDifferences = $startTimestamp - $currentTimestamp;
                                            // Calculate hours and minutes
                                            $hours = floor($timeDifferences / 3600);
                                            $minutes = floor(($timeDifferences % 3600) / 60);
                                            echo "$hours hours & $minutes minutes";?>

                                        </td>
                                        <td>
                                            <button class="btn btn-primary text-white"
                                                onclick="viewTicket(<?php echo $myticket['ticket_id']; ?>, <?php echo $myticket['temp_id']; ?>)">View
                                                Ticket</button>
                                            <?php
if ($myticket['temp_id'] == 5) {
    // Some other logic for temp_id 5
} else {
    $startDateTime = $myticket['start_date'] . ' ' . $myticket['start_time'];
    $startTimestamp = strtotime($startDateTime);
    $currentTimestamp = time();
    $timeDifference = $startTimestamp - $currentTimestamp;


    if ($timeDifference > 12 * 3600) {
    // Calculate refund amount based on time difference
    if ($timeDifference > 36 * 3600) {
        // Fully refund if more than 36 hours left
        $refundPercentage = 100;
    } elseif ($timeDifference > 30 * 3600) {
        // 80% refund if between 30 and 36 hours left
        $refundPercentage = 80;
    } elseif ($timeDifference > 22 * 3600) {
        // 60% refund if between 22 and 30 hours left
        $refundPercentage = 60;
    } else {
        // 40% refund if less than 22 hours left
        $refundPercentage = 40;
    }

    $refundAmount = $myticket['price'] * ($refundPercentage / 100);

    // Basic error check for refundAmount
    if ($refundAmount > 0) {
        ?>
                                            <button class="btn btn-danger text-white"
                                                onclick="refundConfirmation(<?php echo $myticket['ticket_id']; ?>, <?php echo $refundAmount; ?>)">Refund</button>
                                            <?php
    } else {
        echo "Error: Refund amount is zero or negative.";
    }
}
}
?>

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
function viewTicket(ticketId, tempId) {
    if (tempId === 1) {
        // Redirect to the view ticket page with the reference ID for tempId = 1
        window.open('e_ticket.php?tt_id=' + ticketId, '_blank');
    } else if (tempId === 2) {
        // Redirect to the view ticket page with the reference ID for tempId = 2
        window.open('e_ticket2.php?tt_id=' + ticketId, '_blank');
    } else if (tempId === 3) {
        // Redirect to the view ticket page with the reference ID for tempId = 3
        window.open('e_ticket3.php?tt_id=' + ticketId, '_blank');
    } else if (tempId === 4) {
        // Redirect to the view ticket page with the reference ID for tempId = 4
        window.open('e_ticket4.php?tt_id=' + ticketId, '_blank');
    } else if (tempId === 5) {
        // Redirect to the view ticket page with the reference ID for tempId = 5
        window.open('e_ticket5.php?tt_id=<?php echo $cinema;?>', '_blank');
    } else {
        // Handle other cases if needed
        console.error('Invalid tempId:', tempId);
    }
}

// function viewTicket(ticketId) {
//     window.open('refund.php?tt_id=' + ticketId );
// }



function refundConfirmation(ticketId, refundAmount) {
    // Show alert with refund conditions and details for confirmation
    var confirmationMessage = "Are you sure you want to refund?\n\n" +
        "Refund amount: PKR " + refundAmount.toFixed(2) + "\n\n" +
        "Refund amount is subject to the following conditions:\n" +
        "  - If the refund request is made more than 36 hours before the event, a full refund will be issued.\n" +
        "  - If the refund request is made between 30 and 36 hours before the event, an 80% refund will be issued.\n" +
        "  - If the refund request is made between 22 and 30 hours before the event, a 60% refund will be issued.\n" +
        "  - If the refund request is made between 12 and 22 hours before the event, a 40% refund will be issued.\n" +
        "  - No refund request will be  made between 0 and 12 hours before the event, refund button will be vanished.\n\n" +

        " For more details, view our Policies Page ";

    var isConfirmed = confirm(confirmationMessage);

    if (isConfirmed) {
        // User confirmed, proceed with refund
        $.ajax({
            type: 'POST',
            url: 'refund_process.php',
            data: {
                amount: refundAmount,
                ticket_id: ticketId
            },
            success: function(response) {
                // Handle the response from the server (e.g., update UI)
                // Redirect to refund.php or handle as needed
                window.location.reload(); // Reload the page for simplicity
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
}
</script>


<?php include("includes/footer.php"); ?>
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
                                          <button class="btn btn-primary text-white" onclick="viewTicket(<?php echo $myticket['ticket_id']; ?>, <?php echo $myticket['temp_id']; ?>)">View Ticket</button>
                                          <button class="btn btn-danger text-white" onclick="refundticket(<?php echo $myticket['ticket_id']; ?>,<?php echo $myticket['price']; ?>)">Refund</button>
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
        }  else if (tempId === 3) {
            // Redirect to the view ticket page with the reference ID for tempId = 3
            window.open('e_ticket3.php?tt_id=' + ticketId, '_blank');
        }   else if (tempId === 4) {
            // Redirect to the view ticket page with the reference ID for tempId = 4
            window.open('e_ticket4.php?tt_id=' + ticketId, '_blank');
        }  else if (tempId === 5) {
            // Redirect to the view ticket page with the reference ID for tempId = 5
            window.open('e_ticket5.php?tt_id=<?php echo $cinema;?>', '_blank');
        } 
        else {
            // Handle other cases if needed
            console.error('Invalid tempId:', tempId);
        }
    }

    // function viewTicket(ticketId) {
    //     window.open('refund.php?tt_id=' + ticketId );
    // }

    function refundticket(ticketId, refundAmount) {
        $.ajax({
            type: 'POST',
            url: 'refund_process.php',
            data: {
                amount: refundAmount,
                ticket_id: ticketId // Include the ticket_id in the data sent to the server
            },
            success: function(response) {
                // Handle the response from the server (e.g., update UI)
                // console.log(response);
                // Redirect to refund.php
                window.location.href = 'refund.php';
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

</script>


<?php include("includes/footer.php"); ?>

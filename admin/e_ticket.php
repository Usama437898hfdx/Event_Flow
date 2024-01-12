<?php session_start();
include("includes/config.php");?>
<!DOCTYPE html>
<html lang="en">

<?php $tickets = mysqli_query($con, "
SELECT t.ticket_id, e.*,users.username as named , tt.name AS ticket_type_name,tt.price, t.Qrcode, t.discount, t.ticket_type_id 
FROM ticket t JOIN events e ON t.event_id = e.event_id 
JOIN ticket_type tt ON t.ticket_type_id = tt.ticket_type_id 
JOIN users ON t.is_booked = users.id
WHERE t.is_deleted = 0 AND t.is_booked = ".$_SESSION['uid']." AND t.ticket_id  = ".$_GET['tt_id'].";");

 $ticket = mysqli_fetch_assoc($tickets); 
 
//  print_r($ticket);
 
 ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Ticket</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <style>
    @import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body,
    html {
        height: 100vh;
        display: grid;
        font-family: "Staatliches", cursive;
        background: #d83565;
        color: black;
        font-size: 14px;
        letter-spacing: 0.1em;
        margin: 0;
        /* Add this line to remove default margin */
    }

    .ticket {
        margin: auto;
        display: flex;
        background: white;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
    }

    .left {
        display: flex;
    }

    .image {
        height: 250px;
        width: 400px;
        background-image: url("../assets/images/events/<?php echo $ticket['image']?>");
        overflow: hidden;
        background-size: 100% 100%;
        /* background-size: cover; */
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.85;
        margin: 0;
        max-width:100%;
        max-height:100%;
        /* Add this line to remove default margin */
    }

    .admit-one {
        position: absolute;
        color: darkgray;
        height: 250px;
        padding: 0 10px;
        letter-spacing: 0.15em;
        display: flex;
        text-align: center;
        justify-content: space-around;
        writing-mode: vertical-rl;
        transform: rotate(-180deg);
        margin: 0;
        /* Add this line to remove default margin */
    }

    .admit-one span:nth-child(2) {
        color: white;
        font-weight: 700;
    }

    .left .ticket-number {
        height: 250px;
        width: 250px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        padding: 5px;
    }

    .ticket-info {
        padding: 10px 30px;
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-between;
        align-items: center;
    }

    .date {
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        padding: 5px 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .date span {
        width: 100px;
    }

    .date span:first-child {
        text-align: left;
    }

    .date span:last-child {
        text-align: right;
    }

    .date .june-29 {
        color: #d83565;
        font-size: 15px;
    }

    .show-name {
        font-size: 32px;
        font-family: "Nanum Pen Script", cursive;
        color: #d83565;
    }

    .show-name h1 {
        font-size: 48px;
        font-weight: 700;
        letter-spacing: 0.1em;
        color: #4a437e;
    }

    .time {
        padding: 0px 0;
        color: #4a437e;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 0px;
        font-weight: 700;
    }

    .time span {
        font-weight: 400;
        color: gray;
    }

    .left .time {
        font-size: 16px;
    }


    .location {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        padding-top: 8px;
        border-top: 1px solid gray;
    }

    .location .separator {
        font-size: 20px;
    }

    .right {
        width: 180px;
        border-left: 1px dashed #404040;
    }

    .right .admit-one {
        color:#d83565;
    }

    .right .admit-one span:nth-child(2) {
        color:#d83565 ;
    }

    .right .right-info-container {
        height: 250px;
        padding: 10px 10px 10px 35px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .right .show-name h1 {
        font-size: 18px;
    }

    .barcode {
        height: 100px;
    }

    .barcode img {
        height: 100%;
    }

    .right .ticket-number {
        color: gray;
    }
    </style>
</head>


<body>
    <div class="ticket">
        <!-- Your existing HTML content goes here -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


        <div class="left">
            <div class="image">
                
                <!-- <img src="../assets/images/events/<?php echo $ticket['image']?>"> -->

                <!-- <p class="admit-one">
                    <span>EVENT FLOW</span>
                    <span>EVENT FLOW</span>
                    <span>EVENT FLOW</span>
                </p> -->
                <div class="ticket-number">
                    <p>
                        #<?php echo  $ticket['ticket_id']; ?>
                    </p>
                </div>
            </div>
            <div class="ticket-info">
                <?php
    // Assuming $ticket['start_date'] contains the start date of the event
    $startDate = strtotime($ticket['start_date']);
    
    // Format the date components
    $day = date('l', $startDate); // Day of the week (e.g., Tuesday)
    $monthDate = date('F jS', $startDate); // Month and date (e.g., June 29th)
    $year = date('Y', $startDate); // Year (e.g., 2021)
    ?>
                <p class="date">
                    <span><?php echo $day; ?></span>
                    <span class="june-29"><?php echo $monthDate; ?></span>
                    <span><?php echo $year; ?></span>
                </p>
                <div class="event-name">
                    <h1><?php echo $ticket['name']?></h1>
                    <h2><?php echo $ticket['named']?></h2>
                </div>
                <div class="time">
                    <?php
    // Assuming $ticket['start_time'] and $ticket['end_time'] contain the time values
    $startTime = date('g:i A', strtotime($ticket['start_time'])); // Format start time (e.g., 8:00 PM)
    $endTime = date('g:i A', strtotime($ticket['end_time'])); // Format end time (e.g., 11:00 PM)
    ?>
                    <p><?php echo $startTime; ?> <span>TO</span> <?php echo $endTime; ?></p>
                </div>

                <p class="location">
                <span>RS:<?php echo $ticket['price']; ?></span>
                    <span><?php echo $ticket['ticket_type_name']; ?></span>
               

                    <span class="separator"><i class="far fa-smile"></i></span>
                </p>
                <p class="location">
                <span><?php echo $ticket['location']; ?></span>
                </p>

            </div>
        </div>
        <div class="right">
        <p class="admit-one">
                    <span>EF</span>
                    <span>EVENT FLOW</span>
                    <span>EF</span>
                </p>
            <!-- <p class="admit-one">
                <span>ADMIT ONE</span>
                <span>ADMIT ONE</span>
                <span>ADMIT ONE</span>
            </p> -->
            <div class="right-info-container">
                <div class="show-name">
                    <h1><?php echo $ticket['name'] ?></h1>
                </div>
                <div class="time">
                    <?php
    // Assuming $ticket['start_time'] and $ticket['end_time'] contain the time values
    $startTime = date('g:i A', strtotime($ticket['start_time'])); // Format start time (e.g., 8:00 PM)
    $endTime = date('g:i A', strtotime($ticket['end_time'])); // Format end time (e.g., 11:00 PM)
    ?>
                    <p><?php echo $startTime; ?> <span>TO</span> <?php echo $endTime; ?></p>
                </div>
                <div class="barcode" id="qrcode">
                <script type="text/javascript">
new QRCode(document.getElementById("qrcode"), "<?php echo $ticket['name'].$ticket['named'].$ticket['Qrcode']; ?>");
</script>
                </div>
                <p class="ticket-number">
                    #<?php echo $ticket['ticket_id']; ?>
                </p>
            </div>
        </div>
    </div>
    <a class="center" href="index.php" target="_blank">Go Back</a>
</body>


</html>


<?php session_start();
include("includes/config.php");?>

<?php $tickets = mysqli_query($con, "
SELECT t.ticket_id, e.*,users.username as named , tt.name AS ticket_type_name,tt.price, t.Qrcode, t.discount, t.ticket_type_id , r.ticket_id as rid , r.seat_name as rsn
FROM ticket t JOIN events e ON t.event_id = e.event_id 
JOIN ticket_type tt ON t.ticket_type_id = tt.ticket_type_id 
JOIN users ON t.is_booked = users.id
JOIN reservations  r ON r.ticket_id = t.ticket_id
WHERE t.is_deleted = 0 AND t.is_booked = ".$_SESSION['uid']." AND t.ticket_id  = ".$_GET['tt_id'].";");

 $ticket = mysqli_fetch_assoc($tickets); 
?>
<link rel="stylesheet" type="text/css" href="print-styles.css" media="print">

<style>
  .cardWrap {
    width: 27em;
    margin: 3em auto;
    color: #fff!important;
    font-family: sans-serif;
  }

  .card {
    background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
    height: 11em;
    float: left;
    position: relative;
    padding: 1em;
    margin-top: 100px;
  }

  
  .cardLeft {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    width: 16em;
  }

  .cardRight {
    width: 6.5em;
    border-left: .18em dashed #fff;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
  }

  .cardRight:before,
  .cardRight:after {
    content: "";
    position: absolute;
    display: block;
    width: .9em;
    height: .9em;
    background: #fff;
    border-radius: 50%;
    left: -.5em;
  }

  .cardRight:before {
    top: -.4em;
  }

  .cardRight:after {
    bottom: -.4em;
  }

  h1 {
    font-size: 1.1em;
    margin-top: 0;
  }

  span {
    font-weight: normal;
  }

  .title,
  .name,
  .seat {
    text-transform: uppercase;
    font-weight: normal;
    margin-bottom: 1em; /* Add margin between event name, name, and seat */
  }

  h2 {
    font-size: .9em;
    color: #525252!important;
    margin: 0;
  }

  span {
    font-size: .7em;
    color: #a2aeae!important;
  }

  .title {
    margin: 2em 0 0 0;
  }

  .name,
  .seat {
    margin: .7em 0 0 0;
  }

  .time {
    margin: .7em 0 0 1em;
  }

  .seat,
  .time {
    float: left;
  }

  .eye {
    position: relative;
    width: 2em;
    height: 1.5em;
    background: #fff;
    margin: 0 auto;
    border-radius: 1em/0.6em;
    z-index: 1;
  }

  .eye:before,
  .eye:after {
    content: "";
    display: block;
    position: absolute;
    border-radius: 50%;
  }

  .eye:before {
    width: 1em;
    height: 1em;
    background: #e84c3d;
    z-index: 2;
    left: 8px;
    top: 4px;
  }

  .eye:after {
    width: .5em;
    height: .5em;
    background: #fff;
    z-index: 3;
    left: 12px;
    top: 8px;
  }

  .number {
    text-align: center;
    text-transform: uppercase;
    margin-top: 1em; /* Add margin above the Ticket# */
  }

  h3 {
    color: #e84c3d!important;
    margin: .9em 0 0 0;
    font-size: 2.5em;
  }

  .number span {
    display: block;
    color: #a2aeae!important;
  }

  .barcode {
    height: 70px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em; /* Add margin above the QR code */
  }
  .barcode img {
    height: 70px;
  }

  .tic{
    margin-top: 1em;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<div class="cardWrap">
  <div class="card cardLeft">
    <h1>EVENT FLOW<span></span></h1>
    <div class="title">
      <h2><?php echo $ticket['name']; ?></h2>
      <span>RS:<?php echo $ticket['price'];?>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo  $ticket['ticket_type_name']; ?></span>
    </div>
    <div class="name">
      <h2><?php echo $ticket['named']; ?></h2>
      <span>name</span>
    </div>
    <div class="seat">
      <?php
        $startTime = date('g:i A', strtotime($ticket['start_time']));
        $endTime = date('g:i A', strtotime($ticket['end_time']));
      ?>
      <?php
        $startDate = strtotime($ticket['start_date']);
        $day = date('l', $startDate);
        $monthDate = date('F jS', $startDate);
        $year = date('Y', $startDate);
      ?>
      <h2><?php echo $monthDate; ?> &nbsp;<?php echo $year; ?></h2>
      <span><?php echo $startTime; ?> TO <?php echo $endTime; ?></span>
    </div>
  </div>
  <div class="card cardRight">
    <div class="eye"></div>
    <div class="number">
      <span><strong><?php echo $ticket['name']; ?></strong></span>
    </div>
    <div class="barcode" id="qrcode"></div>
    <script type="text/javascript">
      new QRCode(document.getElementById("qrcode"), "<?php echo $ticket['Qrcode']; ?>");
    </script>
    <div>
      <span class="tic" >Ticket#<?php echo $ticket['rsn']; ?></span>
    </div>
  </div>
</div>

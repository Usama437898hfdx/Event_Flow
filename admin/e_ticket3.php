<?php session_start();
include("includes/config.php");?>

<?php $tickets = mysqli_query($con, "
SELECT t.ticket_id, e.*,users.username as named , tt.name AS ticket_type_name,tt.price, t.Qrcode, t.discount, t.ticket_type_id 
FROM ticket t JOIN events e ON t.event_id = e.event_id 
JOIN ticket_type tt ON t.ticket_type_id = tt.ticket_type_id 
JOIN users ON t.is_booked = users.id
WHERE t.is_deleted = 0 AND t.is_booked = ".$_SESSION['uid']." AND t.ticket_id  = ".$_GET['tt_id'].";");

 $ticket = mysqli_fetch_assoc($tickets); 
?>

<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Inline CSS */
    body {
      background-color: Thistle;
      font-family: 'Yanone Kaffeesatz', sans-serif;
      font-weight: 600;
      margin: 0; /* Remove default margin */
    }

    img {
      /* max-width: 100%; */
      height: auto;
      overflow: hidden;
        background-size: 100% 100%;
        /* background-size: cover; */
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.85;
        margin: 0;
        max-width:100%;
        max-height:100%;
    }

    .ticket {
      width: 420px;
      height: 675px;
      background-color: white;
      margin: 25px auto;
      position: relative;
    }

    .holes-top {
      height: 50px;
      width: 50px;
      background-color: Thistle;
      border-radius: 50%;
      position: absolute;
      left: 50%;
      margin-left: -25px;
      top: -25px;
    }

    .holes-top:before,
    .holes-top:after {
      content: '';
      height: 50px;
      width: 50px;
      background-color: Thistle;
      position: absolute;
      border-radius: 50%;
    }

    .holes-top:before {
      left: -200px;
    }

    .holes-top:after {
      left: 200px;
    }

    .holes-lower {
      position: relative;
      margin: 25px;
      border: 1px dashed #aaa;
    }

    .holes-lower:before,
    .holes-lower:after {
      content: '';
      height: 50px;
      width: 50px;
      background-color: Thistle;
      position: absolute;
      border-radius: 50%;
    }

    .holes-lower:before {
      top: -25px;
      left: -50px;
    }

    .holes-lower:after {
      top: -25px;
      left: 350px;
    }

    .title {
      padding: 20px 25px 10px; /* Adjusted padding */
    }

    .cinema {
      color: #aaa;
      font-size: 15px;
      margin: 0; /* Remove margin */
    }

    .movie-title {
      font-size: 30px;
      margin: 0; /* Remove margin */
    }

    .info {
      padding: 15px 25px;
    }

    table {
      width: 100%;
      font-size: 18px;
      margin-bottom: 15px;
    }

    table tr {
      margin-bottom: 5px; /* Adjusted margin */
    }

    table th {
      text-align: left;
    }

    table th:nth-of-type(1) {
      width: 38%;
    }

    table th:nth-of-type(2) {
      width: 40%;
    }

    table th:nth-of-type(3) {
      width: 15%;
    }

    table td {
      width: 33%;
      font-size: 32px;
    }

    .bigger {
      font-size: 30px;
    }
    .big {
      font-size: 20px;
    }
    .serial {
      padding: 15px 25px; /* Adjusted padding */
    }

    /* .barcode {
      border-collapse: collapse;
      margin: 0 auto;
    } */

    .barcode {
    height: 110px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em; /* Add margin above the QR code */
  }
  .barcode img {
    height: 100px;
  }

    .numbers td {
      font-size: 16px;
      text-align: center;
    }
  </style>
</head>
<body>
  <!-- Inline HTML -->
  <div class="ticket">
    <div class="holes-top"></div>
    <div class="title"><br></br>
      <p class="cinema">EVENT FLOW PRESENTS</p>
      <p class="movie-title"><?php echo $ticket['name']; ?></p>
    </div>
    <div class="poster">
      <img src="../assets/images/events/<?php echo $ticket['image']?>" />
    </div>
    <div class="info">
      <table>
        <tr>
          <th class="bigger"><?php echo $ticket['named']; ?></th>
     
        </tr>
        <tr>
          <!-- <td class="big">RS:<?php echo $ticket['price']; ?></td> -->
          <td class="big">Ticket Type:- &nbsp;<?php echo $ticket['ticket_type_name']; ?></td>
        </tr>
      </table>
      <table>
        <tr>
          <th>PRICE</th>
          <th>DATE</th>
          <th>TIME</th>
        </tr>
        <tr>
          <td class="big"><?php echo $ticket['price']; ?></td>
          <td class="big"><?php
    $startDate = strtotime($ticket['start_date']);
    $day = date('d', $startDate);  // Day in two digits
    $month = date('m', $startDate);  // Month in two digits
    $year = date('Y', $startDate);

    $formattedDate = "$day/$month/$year";
?>
<?php echo $formattedDate?></td>
          <td class="big"> <?php $startTime = date('g:i A', strtotime($ticket['start_time']));?><?php echo $startTime; ?></td>
        </tr>
      </table>
    </div>
    <div class="holes-lower"></div>
    <div >
      <table  class="barcode" id="qrcode">
</table>
<script type="text/javascript">
      new QRCode(document.getElementById("qrcode"), "<?php echo $ticket['name'].$ticket['named'].$ticket['Qrcode']; ?>");
    </script>
    </div>
  </div>
</body>
</html>

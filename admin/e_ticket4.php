
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


<?php
    $startDate = strtotime($ticket['start_date']);
    $day = date('d', $startDate);  // Day in two digits
    $month = date('m', $startDate);  // Month in two digits
    $year = date('Y', $startDate);

    $formattedDate = "$day/$month/$year";
?>

<?php
    $endDate = strtotime($ticket['end_date']);
    $dayend = date('d', $endDate);  // Day in two digits
    $monthend = date('m', $endDate);  // Month in two digits
    $yearend = date('Y', $endDate);

    $formattedDatee = "$dayend/$monthend/$yearend";
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inline Boarding Pass</title>
  <style>
    /*--------------------
    Body
    --------------------*/
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      margin: 0;
      background: radial-gradient(ellipse farthest-corner at center top, #ECECEC, #999);
      color: #363c44;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;
    }

    @media (max-width: 768px) {
      .boarding-pass {
        width: 100%;
      }
    }

    /*--------------------
    Boarding Pass
    --------------------*/
    .boarding-pass {
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      height: 500px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 5px 30px rgba(0, 0, 0, .2);
      overflow: hidden;
      text-transform: uppercase;
      font-family: 'Roboto', sans-serif;

      small {
        display: block;
        font-size: 11px;
        color: #A2A9B3;
        margin-bottom: 2px;
      }

      strong {
        font-size: 15px;
        display: block;
      }

      /*--------------------
      Header
      --------------------*/
      header {
        background: linear-gradient(to bottom, #ffffff, #7ca2e1);
        padding: 12px 20px;
        height: 53px;

        .logo {
          float: left;
          width: 104px;
          height: 31px;
        }

        .flight {
          float: right;
          color: #fff;
          text-align: right;

          small {
            font-size: 8px;
            margin-bottom: 2px;
            opacity: 0.8;
          }

          strong {
            font-size: 18px;
          }
        }
      }

      /*--------------------
      Cities
      --------------------*/
      .cities {
        position: relative;

        &::after {
          content: '';
          display: table;
          clear: both;
        }

        .city {
          padding: 20px 18px;
          float: left;

          &:nth-child(2) {
            float: right;
          }

          strong {
            font-size: 20px;
            font-weight: 300;
            line-height: 1;
          }

          small {
            margin-bottom: 0px;
            margin-left: 3px;
          }
        }

        .airplane {
          position: absolute;
          width: 30px;
          height: 25px;
          top: 57%;
          left: 30%;
          opacity: 0;
          transform: translate(-50%, -50%);
          animation: move 3s infinite;
        }

        @keyframes move {
          40% {
            left: 50%;
            opacity: 1;
          }

          100% {
            left: 70%;
            opacity: 0;
          }
        }
      }

      /*--------------------
      Infos
      --------------------*/
      .infos {
        display: flex;
        border-top: 1px solid #99D298;

        .places,
        .times {
          width: 50%;
          padding: 10px 0;

          &::after {
            content: '';
            display: table;
            clear: both;
          }
        }

        .times {
          strong {
            font-size: 12px;
            transform: scale(0.9);
            transform-origin: bottom;
          }
        }

        .places {
          background: #ffffff;
          border-right: 1px solid #99D298;
          margin-inline-start:3px ;
          margin-top: 1px;
          margin-bottom: 1px;
          margin-right: 10px;
          

        

          small {
            font-size: 15px;
            color: #000000;
           
          }

          strong {
            color: #7ca2e1;
            font-size:15px ;
          }
        }

        .box {
          padding: 10px 20px 10px;
          width: 50%;
          float: left;

          strong{
            color: #7ca2e1;
            font-size: 15px;
          }

          small {
            font-size: 15px;
            color: #000000;
          }
        }
      }

      /*--------------------
      Strap
      --------------------*/
      .strap {
        clear: both;
        position: relative;
        border-top: 1px solid #99D298;

        &::after {
          content: '';
          display: table;
          clear: both;
        }

        .box {
          padding: 23px 0 20px 20px;

          & div {
            margin-bottom: 15px;

            small {
              font-size: 10px;
            }

            strong {
              font-size: 13px;
            }
          }

          sup {
            font-size: 8px;
            position: relative;
            top: -5px;
          }
        }
        .barcode {
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em; /* Add margin above the QR code */
  }
  .barcode img {
    height: 100px;
  }

        /* .qrcode {
          position: absolute;
          top: 20px;
          right: 20px;
          width: 80px;
          height: 80px;
        } */
      }
    }

    /*--------------------
    SVG Styles
    --------------------*/
    svg {
      display: none;
    }
  </style>
</head>

<body>

  <div class="boarding-pass">
  <header>
    <img class="logo" src="../assets/images/ab.jpeg" alt="Logo">
    <!-- <div class="flight">
        <small>flight</small>
        <strong>AL 101</strong>
    </div> -->
</header>

    <section class="cities">
      <div class="city">
        <strong><?php echo $ticket['name']; ?></strong>
        <br></br>
        <strong><?php echo $ticket['named']; ?></strong>
      </div>
      <!-- <svg class="airplane">
        <use xlink:href="#airplane"></use>
      </svg> -->
    </section>

    <section class="infos">
      <div class="places">
          <strong>Type</strong>
          <small><?php echo $ticket['ticket_type_name']; ?></small>
          <br></br>
          <strong>Price</strong>
          <small><?php echo $ticket['price']; ?></small>
        </div>
      

        <div class="box">
       <div>
        
          <strong>Start Date</strong>
          <small><?php echo $formattedDate?></small>
          <br></br>
          <strong>End Date</strong>
          
          <small><?php echo $formattedDatee?></small>
       
</div>

</div>

<div class="box">
    
        <strong>Start Time</strong>
<?php $startTime = date('g:i A', strtotime($ticket['start_time']));?>
          <small><?php echo $startTime; ?></small>
  <br></br>
  <strong>End Time</strong>
<?php $endTime = date('g:i A', strtotime($ticket['end_time']));?>
          <small><?php echo $endTime; ?></small>
</div>
      
    </section>
    <footer class="strap">
      <div class="box">
        <div>
        <?php echo $ticket['named']; ?>
          <strong></strong>
      </div>

      <div class="barcode" id="qrcode">
<script type="text/javascript">
      new QRCode(document.getElementById("qrcode"), "<?php echo $ticket['Qrcode']; ?>");
    </script>
     </div>
      </div>
    </footer>
  </div>



</body>

</html>

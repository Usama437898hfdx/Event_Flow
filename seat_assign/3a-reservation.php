<?php
include("../header.php");
?>

<script src="3b-reservation.js"></script>
<link rel="stylesheet" href="3c-reservation.css">

<!-- Breadcrumbs -->
<div class="content-body" style="text-align: center;">


    <div class="container" style="width: 50%; margin: 0 auto;">
        <div>
            <h2> Cinema Ticket Booking
            </h2>
        </div>

        <?php
           
                $sessid = 1;
                $userid = 999;

                require "2-reserve-lib.php";
                $seats = $_RSV->get($sessid);
                ?>

        <!-- (C) DRAW SEATS LAYOUT -->
        <div id="layout"><?php
                                    foreach ($seats as $s) {
                                        $taken = is_numeric($s["user_id"]);
                                        printf(
                                            "<div class='seat%s'%s>%s</div>",
                                            $taken ? " taken" : "",
                                            $taken ? "" : " onclick='reserve.toggle(this)'",
                                            $s["seat_name"]
                                        );
                                    }
                                    ?></div>
        <div>
            <div id="legend" style="width: 50%; margin: 0 auto; display: flex; justify-content: space-between;">
                <div class="seat"></div>
                <div class="txt">Available</div>
                <div class="seat taken"></div>
                <div class="txt">Already Taken</div>
                <div class="seat selected"></div>
                <div class="txt">Selected Seats</div>
            </div>
            </br>

            <form id="ninja" method="post" action="4-save.php">
                <input type="hidden" name="sessid" value="<?= $sessid ?>">
                <input type="hidden" name="userid" value="<?= $userid ?>">
            </form>
            <button id="go" onclick="reserve.save()">Reserve Seats</button>
        </div>

    </div>


</div>
</body>

</html>
<?php

include("../footer.php"); ?>
<?php
// (A) LOAD LIBRARY
require "2-reserve-lib.php";

// (B) SAVE
$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
if ($_RSV) {
    header("location:../my_ticket.php");
    exit();
} else {
    echo "Seat is not reserved";
}
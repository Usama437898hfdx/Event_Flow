<?php
// (A) LOAD LIBRARY
require "2-reserve-lib copy.php";

// (B) SAVE
$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
echo "SAVED";
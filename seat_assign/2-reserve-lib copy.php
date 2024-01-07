
<?php

// class Reserve {
//   // (A) CONSTRUCTOR - CONNECT TO DATABASE
//   private $pdo = null;
//   private $stmt = null;
//   public $error = null;
//   function __construct () {
//     $this->pdo = new PDO(
//       "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
//       DB_USER, DB_PASSWORD, [
//       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]);
//   }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  // function __destruct () {
  //   if ($this->stmt !== null) { $this->stmt = null; }
  //   if ($this->pdo !== null) { $this->pdo = null; }
  // }

  // (C) HELPER FUNCTION - RUN SQL QUERY
  // function query ($sql, $data=null) : void {
  //   $this->stmt = $this->pdo->prepare($sql);
  //   $this->stmt->execute($data);
  // }

  // (D) GET SEATS FOR GIVEN SESSION
  function get($sessid, $con) {
    $query = "SELECT sa.`seat_name`, sa.`seat_id`, r.`user_id` FROM `seats` sa
              LEFT JOIN `reservations` r ON sa.`seat_name` = r.`seat_name`
              ORDER BY sa.`seat_name`";

    $get_seats = mysqli_query($con, $query);

    if (!$get_seats) {
        die("Error: " . mysqli_error($con));
    }

    $sess = mysqli_fetch_all($get_seats, MYSQLI_ASSOC);
    return $sess;
}

  // (E) SAVE RESERVATION
  function save($sessid, $userid, $seats, $con) {
    $sql = "INSERT INTO `reservations` (`session_id`, `seat_name`, `user_id`) VALUES ";

    // Prepare placeholders for multiple rows
    $values = [];
    foreach ($seats as $seat) {
        $values[] = "($sessid, '$seat', $userid)";
    }
    $sql .= implode(",", $values);

    // Execute the query
    $save_query = mysqli_query($con, $sql);

    if (!$save_query) {
        die("Error: " . mysqli_error($con));
    }

    return true;
}



// (F) DATABASE SETTINGS - CHANGE TO YOUR OWN!

// (G) NEW CATEGORY OBJECT
$_RSV = new Reserve();

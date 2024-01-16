<?php session_start();
$basepath="http://localhost/Event_Flow/";
?> 
<!DOCTYPE html>
<?php include("admin/includes/config.php");?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Event Flow </title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="parsa" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo $basepath; ?>assets/plugins/bootstrap/bootstrap.min.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="<?php echo $basepath; ?>assets/plugins/slick/slick.css">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="<?php echo $basepath; ?>assets/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main Stylesheet -->
    <link href="<?php echo $basepath; ?>assets/css/style.css" rel="stylesheet">

    <style>
    .quantity-container {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 5px;
        margin-left: 5px;
    }

    .quantity-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    .quantity-button:hover {
        background-color: #45a049;
    }
    </style>
    <!--Favicon-->

</head>

<body>
    <!-- preloader -->
    <!-- <div class="preloader">
    <div class="loader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> -->
    <!-- /preloader -->
    <style>
    .img-fluid.small-logo {
        max-width: 220px;
        /* Set the maximum width as needed */
        height: auto;
        /* Maintain aspect ratio */
    }
    </style>


    <header class="navigation">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">
                <img class="img-fluid small-logo" src="<?php echo $basepath; ?>assets/images/ab.jpeg" alt="parsa">
            </a></a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navogation"
                aria-controls="navogation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navogation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="allevents.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="policies.php">Policies</a>
                    </li>


                    <?php if (!isset($_SESSION['Attendee']) && !isset($_SESSION['Organizer']) && !isset($_SESSION['Admin'])) { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase text-dark" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin/login.php">SignIn</a>
                            <a class="dropdown-item" href="admin/signup.php">SignUp</a>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['Attendee'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="category.php">Categories</a>
                    </li>
                    <?php } ?>

                    </li>
                    <?php if (isset($_SESSION['Attendee'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="cart.php">Cart</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['Attendee'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase text-dark" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="admin/index.php">Dashboard</a>
                            <a class="dropdown-item" href="admin/profile.php">User Profile</a>
                            <a class="dropdown-item" href="calendar.php">Event Calendar</a>
                            <a class="dropdown-item" href="admin/wallet.php">Wallet</a>
                            <a class="dropdown-item" href="admin/my_ticket.php">My Tickets</a>
                            <a class="dropdown-item" href="admin/includes/logout.php">Logout</a>
                        </div>
                    </li>
                    <?php } ?>



                    <?php if (isset($_SESSION['Organizer'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase text-dark" href="myevents.php">My Events</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase text-dark" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin/index.php">Dashboard</a>
                            <a class="dropdown-item" href="admin/includes/logout.php">Logout</a>
                        </div>
                    </li>
                    <?php } ?>

                    <?php if (isset($_SESSION['Admin']) ) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase text-dark" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin/index.php">Dashboard</a>
                            <a class="dropdown-item" href="admin/includes/logout.php">Logout</a>
                        </div>
                    </li>
                    <?php } ?>
                    <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-uppercase text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin/index.php">Dashboard</a>
          
        </div>
      </li> -->

                    <!--  -->
                    <!-- Display categories in a dropdown -->





                    <!-- Container to display events -->
                    <div id="eventsContainer"></div>

                    <!-- JavaScript to handle the category click and fetch events -->





                </ul>
            </div>
        </nav>
    </header>
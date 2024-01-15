<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="" />

    <title>Event Flow</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="30x30" href="assets\images\u.png">
    <!-- Pignose Calender -->
    <link href="assets/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="assets/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
<?php
include("includes/config.php");
$userRoles = ["Admin", "Organizer", "Attendee"];

$sql = null;
$loggedIn = false;

foreach ($userRoles as $role) {
    if (isset($_SESSION[$role])) {
        $loggedIn = true;
        $id = $_SESSION[$role]['id'];
        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE id = $id");
        $userData = mysqli_fetch_assoc($sql);

        break;
    }
}

if (!$loggedIn) {
    header("location: login.php");
    exit;
}
?>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="../index.php">
                    <b class="logo-abbr"><img src="assets/images/v.png" alt=""> </b>
                    <span class="brand-title">
                        <!-- <img src="assets/images/logo-text.png" alt=""> -->

                        <h2 style="color: white;">Event Flow</h2>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <!-- <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <!-- <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1">3</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="assets/images/avatar/1.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="assets/images/avatar/2.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="assets/images/avatar/3.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="assets/images/avatar/4.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li> -->

                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="assets/images/avatar/<?php echo $userData['avatar'] ?>" height="60" width="60"
                                    alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>

                                        <li>
                                            <a href="profile.php"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                        
                                        <li><a href="includes/logout.php"><i class="icon-key"></i>
                                                <span>Logout</span></a></li>
                                        <li><a href="../index.php"><i class="icon-home"></i>
                                                <span>Home</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="index.php" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a></li>
                        <li><a href="wallet.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Wallet</span>
                            </a></li>

                            <?php if (isset($_SESSION['Attendee'])) { ?>
                        <li><a href="my_ticket.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">My tickets</span>
                            </a></li>
                    <?php } ?>

                    <?php if (isset($_SESSION['Admin'])) { ?>
                        <li><a href="users.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Users</span>
                            </a></li>
                        <li><a href="categories.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Categories</span>
                            </a></li>
                    <?php } ?>

                    <?php if (!isset($_SESSION['Attendee'])) { ?>
                        <li><a href="main_events.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Main Events</span>
                            </a></li>
                        <li><a href="events.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Sub Events</span>
                            </a></li>
                    <?php } ?>

                    <?php if (isset($_SESSION['Organizer'])) { ?>
                        <li><a href="template.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Ticket Templates</span>
                            </a></li>
                        <li><a href="Blogs.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Blogs</span>
                            </a></li>
                        <li><a href="Addons.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Addons</span>
                            </a></li>
                        <li><a href="question_form.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Question Form</span>
                            </a></li>
                        <li><a href="ticket_types.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Tickets Types</span>
                            </a></li>
                        <li><a href="ticket.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Tickets</span>
                            </a></li>
                        <li><a href="orders.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">orders</span>
                            </a></li>
                    <?php } ?>

                    <?php if (!isset($_SESSION['Attendee'])) { ?>
                        <li><a href="index.php" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Analytics</span>
                            </a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
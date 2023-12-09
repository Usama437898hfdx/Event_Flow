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

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="assets/plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="assets/plugins/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"    />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

  <!-- Main Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">
  
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
  <style> .img-fluid.small-logo {
    max-width: 220px; /* Set the maximum width as needed */
    height: auto; /* Maintain aspect ratio */
  }</style>
 

<header class="navigation">
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php">
    <img class="img-fluid small-logo" src="assets/images/ab.jpeg" alt="parsa">
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
          <a class="nav-link text-uppercase text-dark" href="admin/login.php">Sign in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase text-dark" href="cart.php">Cart</a>
        </li>
      </ul>
      <form class="form-inline position-relative ml-lg-4">
        <input class="form-control px-0 w-100" type="search" placeholder="Search">
        <!-- <button class="search-icon" type="submit"><i class="ti-search text-dark"></i></button>
        <a href="search.html" class="search-icon"><i class="ti-search text-dark"></i></a> -->
      </form>
    </div>
  </nav>
</header>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->
<?php include("admin/includes/config.php"); ?>
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

  <!-- Main Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!--Favicon-->

</head>

<body>
  <!-- preloader -->
  <div class="preloader">
    <div class="loader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- /preloader -->

<header class="navigation">
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php"><img class="img-fluid" src="assets/images/logo.png" alt="parsa"></a>
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
      </ul>
      <form class="form-inline position-relative ml-lg-4">
        <input class="form-control px-0 w-100" type="search" placeholder="Search">
        <!-- <button class="search-icon" type="submit"><i class="ti-search text-dark"></i></button> -->
        <a href="search.html" class="search-icon"><i class="ti-search text-dark"></i></a>
      </form>
    </div>
  </nav>
</header>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Interview Prep</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<body>
    <!-- ? Preloader Start -->
    
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/img/logo/hireprep.png" alt="" style="width:50%"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <?php
											error_reporting(0);
											session_start();
											if($_SESSION['user']=='user')
											{
											?>
											<ul id="navigation">                                                                                          
                                                <li class="active" ><a href="index1.php">Home</a></li>
                                                <li><a href="interview.php">Interview</a></li>
                                                <li><a href="job_profile.php">Job Profile</a></li>
                                                <li><a href="profile.php">Profile</a></li>
                                                <!-- Button -->
                                                <li class="button-header"><a href="logout.php" class="btn btn3">Logout</a></li>
                                                <!-- <li class="button-header"><a href="profile.php" style="font-size:35px; margin-top:10px;"><i class="ti-user"></i></a></li> -->

                                            </ul>
											<?php
											}else{
											?>
											<ul id="navigation">                                                                                          
                                                <li class="active" ><a href="index.php">Home</a></li>
                                                <li><a href="about.php">About</a></li>
                                                <!-- Button -->
                                                <li class="button-header"><a href="login.php" class="btn btn3">Log in</a></li>
                                            </ul>
											
											<?php
											}
											?>
                                        </nav>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
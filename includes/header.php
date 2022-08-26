<?php
//session_start();
//include_once 'admin/db/connection.php';
//
//$select_blood_group = "SELECT * FROM blood_group";
//$b_group_query = $conn->query($select_blood_group);

  function isPageActive($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url){
    echo 'active'; //class name in css
   }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fa/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
<!--    jQuery UI-->
    <link rel="stylesheet" href="assets/css/jq_ui/jquery-ui.min.css">
    <!--    Toaster CSS-->
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <!-- Default style sheet -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Blood Donation System</title>
</head>
<body>
    
    <header>
      <div class="container">
        <nav class="navbar navbar-expand-lg cust_nav">
            <div class="container-fluid">
              <!-- Logo -->
              <a class="navbar-brand logo" href="index.php"><i class="fa-solid fa-hand-holding-droplet"></i> Blood Donation</a>
              <button class="navbar-toggler cust_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse menu" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link <?php isPageActive('index.php');?>" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php isPageActive('about.php');?>" href="about.php">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php isPageActive('all_doner.php');?>" href="all_doner.php">Doner List</a>
                  </li>
<!--                  <li class="nav-item">-->
<!--                    <a class="nav-link" href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#becomeDoner">Become a Doner</a>-->
<!--                  </li>-->

                    <li class="nav-item">
                        <button class="nav-link bdoner_btn become_doner_btn">Become a Doner</button>
                  </li>

<!--                  <li class="nav-item">-->
<!--                    <a class="nav-link --><?php //isPageActive('be_donner.php');?><!--" href="be_donner.php">Become a Doner</a>-->
<!--                  </li>-->
                  <li class="nav-item">
                    <a class="nav-link <?php isPageActive('login.php');?>" href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                  </li>
                  <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li> -->
                  
                </ul>
                
              </div>
            </div>
          </nav>
        </div>
    </header>
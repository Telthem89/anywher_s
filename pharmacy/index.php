<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['pharmacy_id'])) { Redirect::to('../login/login.php');}
// elseif (isset($_SESSION['adminstatus'])) {
//      $status=$_SESSION['adminstatus'];
//      // if ($status =='Pending' || $status =='Rejected' ) {
//      //     Redirect::to('../login/verification.php');
//      //     unset($_SESSION['doctor_id']);
//      //     session_destroy();
//      // }}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anywhere Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="no-index">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="../css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.blue.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <!-- <link rel="stylesheet" href="../css/custom.css"> -->
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/favicon.png?3">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/php5shiv/3.7.3/php5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body onload="LoadPharmacistFromLocalStorage_home()">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">         <img src="../img/ustawi_logo.png" style="border-radius: 0%;"></a>
      <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
        <li class="nav-item">
          <form id="searchForm" class="ml-auto d-none d-lg-block">
            <div class="form-group position-relative mb-0">
              <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
              <input type="search" placeholder="Search on your dashboard..." class="form-control form-control-sm border-0 no-shadow pl-4">
            </div>
          </form>
        </li>
  
        <li class="nav-item dropdown ml-auto"><a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="../img/avatar-3.jpg" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1" style="border-radius: 50%!important;"></a>
        <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" ><span></span></strong><small  id="flname"></small></a>
        <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Profile</a><a href="#" class="dropdown-item">Activity log</a>
        <div class="dropdown-divider"></div><a  class="dropdown-item" onclick="Logout()">Logout</a>
      </div>
    </li>
  </ul>
</nav>
</header>
<div class="d-flex align-items-stretch">
<div id="sidebar" class="sidebar py-3">
 <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">ANYWHERE</div>
<ul class="sidebar-menu list-unstyled">
<li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
<li class="sidebar-list-item"><a href="category.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Categories</span></a></li>
<li class="sidebar-list-item"><a href="supplier.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Suppliers</span></a></li>
<li class="sidebar-list-item"><a href="medicine.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Inventory</span></a></li>
 <li class="sidebar-list-item"><a href="pharm-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
 <li class="sidebar-list-item"><a href="myorder.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Orders</span></a></li>
 <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Expired Medicines</span></a></li>
  <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
</ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text text-center">
                <h6 class="mb-0">Inventory</h6><span class="text-gray">0</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-envelope"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text text-center">
                <h6 class="mb-0">Suppliers<br></h6><span class="text-gray">0</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="far fa-clock"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text text-center">
                <h6 class="mb-0">Sales Report</h6><span class="text-gray">0</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-clock"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text-center">
                <h6 class="mb-0">Recent Orders</h6><span class="text-gray" id="countprescriptions">0</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fas fa-search"></i></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="row mb-4">
        <div class="col-lg-7 mb-4 mb-lg-0">
          <div class="card">
            <div class="card-header">
              <h2 class="h6 text-uppercase mb-0">Usage Frequency</h2>
            </div>
            <div class="card-body">
              <p class="text-gray">Find out how often you use this app in a month.
              </p>
              <div class="chart-holder">
                <canvas id="lineChart1" style="max-height: 14rem !important;" class="w-100"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 mb-4 mb-lg-0 pl-lg-0">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row align-items-center flex-row">
                <div class="col-lg-12">
                  <h2 class="mb-0 d-flex align-items-center"><span id="attendedAppoint">5</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Attended Appointments</span>
                  <hr><small class="text-muted">How many appointments you have attended so far</small>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row align-items-center flex-row">
                <div class="col-lg-12">
                  <h2 class="mb-0 d-flex align-items-center"><span id="attendedPatient">4</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Prescriptions</span>
                  <hr><small class="text-muted">how many prescriptions you have been given so far</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="py-5">
      <div class="row text-center">
        <p class="text text-center">ORDERS (By Most Recent):</p>
        <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
          <div class="row">
            <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">24<sup class="smaller text-gray font-weight-normal">Apr</sup></strong><img src="../img/avatar-1.jpg" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
              <h6 class="mb-0">Jason Max</h6>
            </div>
            <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
              <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Home Delivery</div>
              <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Expected 12 Dec 2020</div>
              <p class="mb-0 mt-3 mt-lg-0">Amoxylene, Penicylene and Otroxyl</p>
            </div>
          </div></a></div>
          <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
            <div class="row">
              <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">24<sup class="smaller text-gray font-weight-normal">Nov</sup></strong><img src="../img/avatar-2.jpg" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                <h6 class="mb-0">Simende Jari</h6>
              </div>
              <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Hospital Delivery</div>
                <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Expected 25 Nov 2020</div>
                <p class="mb-0 mt-3 mt-lg-0">Hydra-Codaine</p>
              </div>
            </div></a></div>
            <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
              <div class="row">
                <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">17<sup class="smaller text-gray font-weight-normal">Aug</sup></strong><img src="../img/avatar-3.jpg" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                  <h6 class="mb-0">Margret Peturu</h6>
                </div>
                <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                  <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Hospital Delivery</div>
                  <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Expected 01 Nov 2020</div>
                  <p class="mb-0 mt-3 mt-lg-0">PST Kit, Infrared Thermometer, Bluegon</p>
                </div>
              </div></a></div>
              <div class="col-lg-12"><a href="#" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
                <div class="row">
                  <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left"><strong class="h5 mb-0">15<sup class="smaller text-gray font-weight-normal">Sep</sup></strong><img src="../img/avatar-4.jpg" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                    <h6 class="mb-0">Jaron Dombo</h6>
                  </div>
                  <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Meetup</div>
                    <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">Expected 12 Nov 2020</div>
                    <p class="mb-0 mt-3 mt-lg-0">Ipbrofen, Paracetamol 500ml</p>
                  </div>
                </div></a></div>
              </div>
            </section>
          </div>
          <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 text-center text-md-left text-primary">
                  <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
      <!-- JavaScript files-->
      <script src="../vendor/jquery/jquery.min.js"></script>
      <script src="../vendor/popper.js/umd/popper.min.js"> </script>
      <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
      <script src="../vendor/chart.js/Chart.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
     <script src="../js/lib/charts-home.js"></script>
      <script src="../js/lib/front.js"></script>
      <script src="../js/controllers/PharmacistController.js"></script>
      <!-- <script src="../js/controllers/userdashController.js"></script> -->
    </body>
  </html>

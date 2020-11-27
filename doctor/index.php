<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['doctor_id'])) { Redirect::to('../login/login.php');}
elseif (isset($_SESSION['adminstatus'])) {
     $status=$_SESSION['adminstatus'];
     if ($status =='Pending' || $status =='Rejected' ) {
         Redirect::to('../login/verification.php');
         unset($_SESSION['doctor_id']);
         session_destroy();
     }}
     $prescript = new Prescription();
     $myTotal=$prescript->totalPatienthist($_SESSION['doctor_id'])
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
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/favicon.png?3">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/php5shiv/3.7.3/php5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body onload="homedocdetail(),getTotalPrescript(),DoctorCountBookings(),DoctorCountRevenues()">
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
        
        <li class="nav-item dropdown ml-auto"><a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="" alt="username" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar"></a>
        <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" ><span id="flname"></span></strong><small id="speciality"></small></a>
        <div class="dropdown-divider"></div><a href="doc-profile.php" class="dropdown-item">Profile</a>
        <div class="dropdown-divider"></div><a onclick="Logout()" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
</header>
<div class="d-flex align-items-stretch">
<div id="sidebar" class="sidebar py-3">
  <div class="text-grey-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">ANYWHERE</div>
<ul class="sidebar-menu list-unstyled">
  <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
  <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>My Appointments</span></a></li>
  <li class="sidebar-list-item"><a href="doc-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
  <li class="sidebar-list-item d-none"><a href="att-patients.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Attended Patients</span></a></li>
  <li class="sidebar-list-item"><a href="patient_history.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Patient History</span></a></li>
</ul>
  </div>
  <div class="page-holder w-100 d-flex flex-wrap">
    <div class="container-fluid px-xl-5">
      <section class="py-5">
        <div class="row">
          <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0 d-none ">
            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-blue"></div>
                <div class="text text-center">
                  <h6 class="mb-0">New<br>Messages</h6><span class="text-gray">0</span>
                </div>
              </div>
              <div class="icon text-white bg-blue"><i class="fa fa-envelope"></i></div>
            </div>
          </div>
          <div class="col-md-4 mb-4 mb-xl-0">
            
            <button style="border:none; background-color:transparent; width: 100%;" onclick="upcomingAppointment()">
            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-green"></div>
                <div class="text text-center">
                  <h6 class="mb-0">Upcoming<br>Appointments</h6><span class="text-gray" id="countAppointments">1</span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="far fa-clock"></i></div>
            </div>
          </div>
          <div class="col-md-4 mb-4 mb-xl-0">
            <button style="border:none; background-color:transparent; width: 100%;" id="pendingRegBtn" onclick="patientHistory()">
            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-blue"></div>
                <div class="text text-center">
                  <?php foreach ($myTotal as $myTotalue): ?>
                    
                  <h6 class="mb-0">Patients<br>History</h6><span class="text-gray"><?php echo $myTotalue['totalPatienthist'] ?></span>
                  <?php endforeach ?>
                </div>
              </div>
              <div class="icon text-white bg-blue"><i class="fa fa-clock"></i></div>
            </div>
          </div>
          <div class="col-md-3 mb-4 mb-xl-0 d-none">
            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-green"></div>
                <div class="text-center">
                  <h6 class="mb-0">Recent Prescriptions</h6><span class="text-gray" id="countprescriptions"></span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="fas fa-search"></i></div>
            </div>
          </div>

           <div class="col-md-4 mb-4 mb-xl-0">
            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-green"></div>
                <div class="text-center">
                  <h6 class="mb-0">My Revenue Update</h6><span class="text-gray" id="countRevenues"></span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="fas fa-money-bill" onclick="loc()"></i></div>
            </div>
          </div>
        </div>
      </section>
      <section class="d-none">
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
                  <div class="col-lg-5">
                    <h2 class="mb-0 d-flex align-items-center"><span id="attendedPatient">5</span><span class="dot bg-green d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Attended Appointments</span>
                    <hr><small class="text-muted">How many appointments you have attended so far</small>
                  </div>
                  <div class="col-lg-7">
                    <canvas id="pieChartHome1"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center flex-row">
                  <div class="col-lg-5">
                    <h2 class="mb-0 d-flex align-items-center"><span id="attendedAppoint">4</span><span class="dot bg-violet d-inline-block ml-3"></span></h2><span class="text-muted text-uppercase small">Prescriptions</span>
                    <hr><small class="text-muted">how many prescriptions you have given out so far</small>
                  </div>
                  <div class="col-lg-7">
                    <canvas id="pieChartHome2"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
     
            </div>
            <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 text-center text-md-left text-primary">
                    <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
                  </div>
                  <div class="col-md-6 text-center text-md-right text-gray-400">
                    <p class="mb-0">Design by <a href="#" class="external text-gray-400">Sagehill</a></p>
                    <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
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
        <script src="../js/controllers/doctor.js"></script>

        <script type="text/javascript">
          function patientHistory() {
            window.location.href="patient_history.php";
          }

          function upcomingAppointment() {
            window.location.href="calender.php";
          }

          
        </script>
      </body>
    </html>
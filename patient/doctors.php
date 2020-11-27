<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['patient_id'])) { Redirect::to('../login/login.php');} ?>
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

        <style type="text/css">
            .search-result-item {
                width: 100%!important;
                padding: 50px;
                background-color: #fff!important;
                border-radius: 10px;
            }
        </style>
    </head>
    <body onload="listAllDoctors(),homedocdetail()">
        <!-- navbar-->
        <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="index.php" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">         <img src="../img/ustawi_logo.png" style="border-radius: 0%;"></a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
                <li class="nav-item">
                    <form id="searchForm" class="ml-auto d-none d-lg-block">
                        <div class="form-group position-relative mb-0">
                            <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                            <input type="search" placeholder="Search on your dashboard..." class="form-control form-control-sm border-0 no-shadow pl-4">
                        </div>
                    </form>
                </li>
               
                <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="../img/avatar-3.jpg" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1"></a>
                <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" ><span ></span></strong><small id="flname">User</small></a>
                <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Profile</a><a href="#" class="dropdown-item">Activity log</a>
               <div class="dropdown-divider"></div><a  class="dropdown-item" onclick="Logout()">Logout</a>
            </div>
        </li>
    </ul>
</nav>
</header>
<div class="d-flex align-items-stretch">
<div id="sidebar" class="sidebar py-3">
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">Anywhere</div>
   <ul class="sidebar-menu list-unstyled">
    <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Your Appointments</span></a></li>
    <li class="sidebar-list-item"><a href="doctors.php" class="sidebar-link text-muted active"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
    <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
    <li class="sidebar-list-item"><a href="shop.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Pharmacies</span></a></li>
    <li class="sidebar-list-item"><a href="myOrder.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Orders</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
    <div class="container-fluid px-xl-5">
        <!--Search Section-->
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12" id="inner">
                    <h1 class="heading1">Choose your doctor & appointment time</h1>
                    <p class="heading2">search for a doctor or just choose one you've previously worked with</p>
                      <div class="error p-4 bg-danger text-center text-light rounded mb-4" id="alert" role="alert" style="display: none;"></div>
                       <div class="p-4 alert alert-success mb-4" role="alert" id="success" style="display: none;"></div>
                        
                </div>
            </div>
        </div>
        <div class="container search-body" style="margin-top: -12px;">
            <div class="row ng-scope">
                
                <div class="col-md-12 mb-lg-5" id="rowContainer">
                    <p class="search-results-count"></p>
                    
                    
                        <input type="hidden" name="rowcount" id="rowcount" />
                   
                </div>
            </div>
        </div>
        
        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100 d-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left text-primary">
                        <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
                    </div>
                    <div class="col-md-6 text-center text-md-right text-gray-400">
                        <p class="mb-0">Design by <a href="#" class="external text-gray-400" id="fname">Bootstrapious</a></p>
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
<script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
<script src="../js/lib/jquery.bootpag.min.js"></script>
<script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<!--  <script src="../lib/js/charts-home.js"></script>
<script src="../lib/js/front.js"></script> -->
<script src="../js/controllers/patient.js"></script>
 <script>
        // init bootpag
        // $('#pagination-result').bootpag({
        //     total: 5,
        //     href: "#pro-page-{{number}}",
        // }).on("page", function(event,  page number here  num){
        //       $("#pagesNumber").html("Page"+num); // some ajax content loading...
        //       $(this).bootpag({total: 5, maxVisible: 5});
        // });
    </script>
</body>
</html>
<div id="booknow" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header bg-primary y-jumbo">
        <h4 class="modal-title  text-light">Book Practioner</h4>
    </div>
    <div class="modal-body" align="center">
        <form>
            <!-- doctor infor from js -->
            <div class="doctorInfor">
                <div class="row d-none">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="doctor_id">Doctor Name</label>
                            <input type="hidden" id="doctor_id" class="form-control">
                            <input type="text" id="doc_name" class="form-control" placeholder="Doctor Name" disabled="disabled">
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="speciality">Speciality</label>
                            <input type="text" id="speciality" class="form-control" placeholder="Speciality" disabled="disabled">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end info -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" id="description" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label for="book_time">Booking Time</label>
                <input type="datetime-local"  id="book_time" class="form-control">
                <select class="form-control d-none" id="book_timed">
                    <option value="">--Select Appointment Time</option>
                    <option value="06:00 AM">0600hrs</option>
                    <option value="07:00 AM">0700hrs</option>
                    <option value="08:00 AM">0800hrs</option>
                    <option value="09:00 AM">0900hrs</option>
                    <option value="11:00 AM">1100hrs</option>
                    <option value="12:00 PM">1200hrs</option>
                    <option value="2:00 PM">1400hrs</option>
                    <option value="3:00 PM">1500hrs</option>
                    <option value="4:00 PM">1600hrs</option>
                    <option value="5:00 PM">1700hrs</option>
                    <option value="6:00 PM">1800hrs</option>
                    <option value="7:00 PM">1900hrs</option>
                    <option value="8:00 PM">2000hrs</option>
                    <option value="9:00 PM">2100hrs</option>
                    <option value="10:00 PM">2200hrs</option>
                    <option value="11:00 PM">2300hrs</option>
                    <option value="12:00 AM">0000hrs</option>
                </select>
            </div>
            <input type="hidden" id="client_id">
            <button class="btn btn-lg btn-danger" type="button" onclick="$('#logging_in').modal('show'),MakeAppointmentWithDoctor()" id="mybtn"><i class="glyphicon glyphicon-ok-sign"></i>Book Now</button>
        </form>
    </div>
    <div class="modal-footer">
    </div>
</div>
</div>
</div>
<div id="logging_in" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header bg-primary y-jumbo">
        <h4 class="modal-title  text-light">Please wait........ </h4>
    </div>
    <div class="modal-body" align="center">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only" >Loading</span>
        </div>
        <p id="pay_process_message">
            <img src="../img/loading.gif" class="img-fluid text-center">
        </p>
    </div>
    <div class="modal-footer">
    </div>
</div>
</div>
</div>
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
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Anywhere dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="no-index">
        
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/all.css">
         <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!-- Google fonts - Popppins for copy-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
        <!-- orion icons-->
        <link rel="stylesheet" href="../css/orionicons.css">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="../css/style.blue.css" id="theme-stylesheet">
        <!-- Favicon-->
        <link rel="shortcut icon" href="../img/favicon.png?3">
       
    </head>
    <body onload="homedocdetail(),getDoctorAppointments()">
        <!-- navbar-->
        <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">
        <img src="../img/ustawi_logo.png" style="border-radius: 0%;"></a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            <li class="nav-item">
                <form id="searchForm" class="ml-auto d-none d-lg-block">
                    <div class="form-group position-relative mb-0">
                        <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                        <input type="search" placeholder="Search on your dashboard..." class="form-control form-control-sm border-0 no-shadow pl-4">
                    </div>
                </form>
            </li>
           
        <li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar"></a>
        <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname"></strong><small id="speciality"></small></a>
        <div class="dropdown-divider"></div><a href="user-profile.php" class="dropdown-item">Profile</a>
        <div class="dropdown-divider"></div><a onclick="Logout()" class="dropdown-item">Logout</a>
    </div>
</li>
</ul>
</nav>
</header>
<div class="d-flex align-items-stretch">
<div id="sidebar" class="sidebar py-3">
<div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">ANYWHERE</div>
<ul class="sidebar-menu list-unstyled">
<li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted "><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
<li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted active"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>My Appointments</span></a></li>
 <li class="sidebar-list-item"><a href="doc-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
<li class="sidebar-list-item d-none"><a href="att-patients.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Attended Patients</span></a></li>
 <li class="sidebar-list-item"><a href="patient_history.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Patient History</span></a></li>
</ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
<div class="container">
<h2 class="heading1">Appointments</h2>
<p class="lead heading2">
    All your scheduled upcoming appointments in one place
</p>
<hr class="line-break" />

<div class="agenda">
    <div class="table-responsive">
        <input type="text" class="d-none" id="myInput" onkeyup="tableFilter()" placeholder="Search by appointment or date...">
        <table class="table table-condensed table-borderless" id="myTabjle">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Fullname</th>
                    <th>Event</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
                <tbody id="myevent">
                    
                </tbody>
                <div class="text-center" id="info"></div>
            </table>
        </div>
    </div>
</div>
<footer id="footer" class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-center text-md-left text-primary">
                <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
            </div>
            <div class="col-md-6 text-center text-md-right text-gray-400">
                <p class="mb-0">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a></p>
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
<script src="../lib/js/all.min.js"></script>
<script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="../lib/js/front.js"></script>
<script src="../js/controllers/doctor.js"></script>
<script src="../js/lib/jquery.dataTables.min.js"> </script>
<script>
        $('#myTable').DataTable( {
            fixedHeader: true
        } );

        function loc() {
            $("#modalprimaryr").modal("show")
          }
    </script>
</body>
</html>

<div class="modal fade" id="modalprimaryr">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #004085 !important; ">
                    <h4 style="color:#fff;" class="text-center">Reschedule Appointment</h4>
                </div>
                <div class="modal-body">
                    <form>
                       <div class="alert alert-danger text-center" role="alert" id="alert" style="display: none;"></div>
                        <div class="alert alert-success text-center" role="alert" id="success" style="display: none;"></div>
                        <div class="form-group">
                            <label for="title"><i class="fa fa-calendar"></i>  Scheduled Date</label>
                            <input type="datetime-local" id="dateAvailable" class="form-control rounded-0" placeholder="Next Date You Availabl">
                        </div>
                       
                        <div class="form-group">
                            <label for="description"><i class="fa fa-comments"></i> Message</label>
                            <textarea type="text" id="rmessage" class="form-control rounded-0" placeholder="Message"></textarea>
                        </div>
                    
                        <input type="hidden" id="cid">
                        <input type="hidden" id="email">
                        <input type="hidden" id="phoneNumber">
                        <button class="btn btn-warning btn-block rounded-0" onclick="canURescheduleAppointment()"  type="button"> Reschedule Appointment</button>
                    </form>

                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                </div>
                </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
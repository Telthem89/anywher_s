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
     $clientmy= base64_decode($_GET['q']);
     // $client_id = ;
     $prescript = new Prescription();
     $fullname = $prescript->getPatientName($clientmy);
     $patienthist = $prescript->getPatientPrecriptionHistory($clientmy);
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
        <link rel="stylesheet" href="../css/font-awesome.min.css">
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
        <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname">Dolby Bhora</strong><small id="speciality">Physician</small></a>
        <div class="dropdown-divider"></div><a href="doc-profile.php" class="dropdown-item">Profile</a>
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
<li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>My Appointments</span></a></li>
 <li class="sidebar-list-item"><a href="doc-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
<li class="sidebar-list-item d-none"><a href="att-patients.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Attended Patients</span></a></li>
 <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>Patient History</span></a></li>
</ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
    
        
   
<div class="container mb-lg-5">
    <?php foreach ($fullname  as $fullname ): ?>
        <div class="text-center mt-lg-3">
    <img src="./.././webservices/webservices/<?php echo $fullname['avatar']; ?>" class="img-fluid" width="120px">
</div>
        <h2 class="heading1 text-center p-2"><?php echo $fullname['fullname']; ?></h2>




<p class="text-center">Gender <?php echo $fullname['gender']; ?></p>
    <?php endforeach ?>
<div class="agenda card rounded-0 p-3 mt-lg-5">

    <div class="table-responsive">
     <table class="table table-bordered table-borderless table-hover" id="myTable">
         <thead>
             <tr>
                 <th class="text-center">[Prescription Number]</th>
                 <th >Drugs</th>
                 <th >Dosage</th>
                 <th class="text-center">Date Prescribed</th>
             </tr>
         </thead>
         <tbody>
            <?php foreach ($patienthist as $patienthists): ?>
             <tr>
                 <td class="text-center"><?php echo $patienthists['prescnumber'] ?></td>
                 <td><?php echo $patienthists['drugs'] ?></td>
                 <td><?php echo $patienthists['dusage'] ?></td>
                 <td class="text-center"><?php echo $patienthists['dateprescribe'] ?></td>
             </tr>
             <?php endforeach ?>
         </tbody>
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
                <p class="mb-0">Design by <a href="#" class="external text-gray-400">Sagehill Business Solutions</a></p>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- JavaScript files-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/popper.js/umd/popper.min.js"> </script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="../lib/js/front.js"></script>
<script src="../js/controllers/doctor.js"></script>
<script src="../js/lib/jquery.dataTables.min.js"> </script>
<script>
        $('#myTable').DataTable( {
            fixedHeader: true
        } );
    </script>
</body>
</html>


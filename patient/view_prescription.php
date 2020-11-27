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
            #section-divider {
                border: 2px solid #333;
                width: 100%;
            }
            .prescription-bottom {
                background-color: #555;
                width: 100%;
                margin-top: 10px;
                color: white;
                padding-top: 20px;
            }
        </style>
    </head>
    <body onload="homedocdetail(),getClientPrescriptions()">
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
             
               <li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                   <img src="../webservices/uploads/avatar/avatar.png" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1">
               </a>
                <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname"></strong></a>
                <div class="dropdown-divider"></div><a href="user-profile.php" class="dropdown-item">My Profile</a>
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
    <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Your Appointments</span></a></li>
    <li class="sidebar-list-item"><a href="doctors.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
    <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
    <li class="sidebar-list-item"><a href="shop.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Pharmacies</span></a></li>
    <li class="sidebar-list-item"><a href="myOrder.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Order</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
   
<div class="container-fluid px-xl-5" id="mainContainerdiv">
    
</div>
</div>
</div>

        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 text-center text-md-left text-primary">
                <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
              </div>
              <div class="col-md-6 text-center text-md-right text-gray-400">
                <p class="mb-0">Design by <a href="#" class="external text-gray-400">Sagehill <p class="d-none" id="fname"></p></a></p>
              </div>
            </div>
          </div>
        </footer>




    <!-- JavaScript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="../lib/js/charts-home.js"></script>
    <script src="../lib/js/front.js"></script>
    <script src="../js/controllers/patient.js"></script>


    <!-- <script>
      window.onload = function() {myFunction()};

      function myFunction(){
        document.getElementById("inbox").style.display = "none";
      }

      function inboxFunction(){
        document.getElementById("messagesTitle").innerHTML = "Inbox";
        document.getElementById("inbox").style.display = "block";
        document.getElementById("messages").style.display = "none";
      }
      function sentboxFunction(){
        document.getElementById("messagesTitle").innerHTML = "Sentbox";
      }
      function trashboxFunction(){
        document.getElementById("messagesTitle").innerHTML = "Deleted";
      }
      function draftboxFunction(){
        document.getElementById("messagesTitle").innerHTML = "Unsent";
      }

    </script> -->
    <script>  
         $(document).ready(function(){  
              var i=1;  
              $('#add').click(function(){  
                   i++;  
                   $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter Medication, Dosage, Consumption Time" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });   
         });  
    </script>
  </body>
</html>

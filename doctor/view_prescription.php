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
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base"><img src="../img/ustawi_logo.png" style="border-radius: 0%;"></a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item">
            <form id="searchForm" class="ml-auto d-none d-lg-block">
              <div class="form-group position-relative mb-0">
                <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                <input type="search" placeholder="Search on your dashboard..." class="form-control form-control-sm border-0 no-shadow pl-4">
              </div>
            </form>
          </li>
          <li class="nav-item dropdown mr-3"><a id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
            <div aria-labelledby="notifications" class="dropdown-menu"><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 2 doctor's appointments</p>
                  </div>
                </div></a><a href="#" class="dropdown-item"> 
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-blue text-white"><i class="fas fa-envelope"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 6 new messages</p>
                  </div>
                </div></a><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 2 checkup sessions</p>
                  </div>
                </div></a>
          </li>
          <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="../img/avatar-3.jpg" alt="Jason Doe" style="max-width: 2.5rem;" class="../img-fluid rounded-circle shadow"></a>
            <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" ><span id="flname"></span></strong><small>User</small></a>
              <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Profile</a><a href="#" class="dropdown-item">Activity log</a>
              <div class="dropdown-divider"></div><a onclick="Logout()" class="dropdown-item">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
          <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
          <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Your Appointments</span></a></li>
          <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
          <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Edit Profile</span></a></li>
          <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
        <h4 class="heading1 text-center">PATIENT PRESCRIPTION</h4>
        <section class="prescription-top">
            <div class="row">
                <div class="col-md-8 prescTopText">
                    <h1>Anywhere Healthcare</h1>
                    <p>Stay healthy on the go, anywhere anytime.</p>
                    <p>remotehealth.sagehillhost.com</p>
                </div>
                <div class="col-md-4 text-center">
                    <img class="prescription-logo" src="../img/afya_logo.png">
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <hr id="section-divider"><br>
                <div class="col-md-6 text-left">
                    <p class="text-blue">Dr. Mandi Gorah</p>
                    <p>[Psychologist]</p>
                    <p>[+263 773 426 317]</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>Prescription #: [27836]</p>
                    <p>Date: 13/10/2020</p>
                </div>
                <br><hr id="section-divider">
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-md-12 breather">
                    <h6">Patient Details:</h6>
                    <p>Methocotryxl, 500mg(1 Tablespoon) at a time, 3 times a day</p></br>
                    <p>Aderole, 2 pills at a time, 2 times a day</p></br>
                    <p>Comoxylene, 500mg(1 Tablespoon) at a time, 3 times a day</p></br>
                    <p>Ibrupfen, 1 pill at a time, 3 times a day</p></br>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-md-12 text-left">
                    <table>
                        <thead>
                            <h6 class="heading1">Patient Details:</h6>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>Mr/Mrs/Ms:</p>
                                </td>
                                <td>
                                    <p> [Patient's Name]</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Age:</p>
                                </td>
                                <td>
                                    <p> [21]</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Address:</p>
                                </td>
                                <td>
                                    <p> [2121 Person's Adress, Theirhome]</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Contact Num:</p>
                                </td>
                                <td>
                                    <p> [+263776789877]</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="prescription-bottom">
            <div class="row">
                <div class="col-md-3 text-center">
                    <p>+26384678378</p>
                </div>
                <div class="col-md-6 prescrFooter text-center">
                    <a href="../pharmacy/" class="btn btn-info">Visit Pharmacy</a>&emsp;
                    <a href="#" class="btn btn-info">Download as PDF</a>
                </div>
                <div class="col-md-3 text-center">
                    <p>doc'semail@email.com</p>
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
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="../lib/js/charts-home.js"></script>
    <script src="../lib/js/front.js"></script>
    <script src="../js/controllers/docdashController.js"></script>
    <script>
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
      function custDate(){
          var day = "";
          if(get){

          }
          var sortedDate = 
      }
    </script>
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

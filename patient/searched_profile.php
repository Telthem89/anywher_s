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
  </head>
  <body>
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
        <div class="dropdown-divider"></div><a href="../index.php" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
</header>
<div class="d-flex align-items-stretch">
<div id="sidebar" class="sidebar py-3">
  <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
  <ul class="sidebar-menu list-unstyled">
    <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Your Appointments</span></a></li>
    <li class="sidebar-list-item"><a href="search.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
    <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Edit Profile</span></a></li>
    <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
    <!--Back to Search button-->
    <div class="container">
      <div class="row align-items-left">
        <div class="col-lg-12">
          <a id="back_btn" class="btn btn-info" onclick="goBack()">
            <i class="fa fa-chevron-left"> Back</i>
          </a>
        </div>
      </div>
    </div>
    <!--Searched Profile Section-->
    <section class="section about-section gray-bg" id="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 text-center">
            <div class="about-avatar">
              <img src="../img/avatar-4.jpg" title="" alt="">
            </div>
          </div>
          <div class="col-lg-8 text-center">
            <div class="about-text go-to">
              <h3 class="dark-color">About Doctor Chibadura</h3>
              <h6 class="theme-color lead">A Lead Surgeon &amp; Optician at Parirenyatwa Hospital</h6>
              <p>
                Not just your doctor but something better. I am your friend
                with 10+ years experience in the medical field. After graduating
                from University of Zimbabwe I soured the world helping people and
                now I am here to help you.
              </p>
              <div class="row about-list">
                <div class="col-md-6 text-left">
                  <div class="media">
                    <label>Last Active: </label>
                    <p class="media-item">August 5, 2020</p>
                  </div>
                  <div class="media">
                    <label>Age: </label>
                    <p class="media-item">22 Yrs</p>
                  </div>
                  <div class="media">
                    <label>Residence: </label>
                    <p class="media-item">Zimbabwe</p>
                  </div>
                  <div class="media">
                    <label>City: </label>
                    <p class="media-item">Harare</p>
                  </div>
                </div>
                <div class="col-md-6 text-left">
                  <div class="media">
                    <label>E-mail: </label>
                    <p class="media-item">info@domain.com</p>
                  </div>
                  <div class="media">
                    <label>Phone: </label>
                    <p class="media-item">(+263)772-885-332</p>
                  </div>
                  <div class="media">
                    <label>Skype: </label>
                    <p class="media-item">skype.0404</p>
                  </div>
                  <div class="media">
                    <label>Availability: </label>
                    <p class="media-item">Online</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="counter">
          <div class="row">
            <div class="col-6 col-lg-3">
              <div class="count-data text-center">
                <h6 class="h2" data-to="50" data-speed="5">50</h6>
                <p class="m-0px font-w-600">Attended Patients</p>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="count-data text-center">
                <h6 class="h2" data-to="5" data-speed="1">5</h6>
                <p class="m-0px font-w-600">Reviews</p>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <a id="appoint-button" href="#appointment" data-toggle="modal">
                <div class="count-data text-center">
                  <i class="fa-3x fa fa-clipboard"></i>
                  <p class="m-0px font-w-600">Book Appointment</p>
                </div>
              </a>
            </div>
            <div class="col-6 col-lg-3">
              <a id="appoint-button" href="#">
                <div class="count-data text-center">
                  <i class="fa-3x fa fa-comments"></i>
                  <p class="m-0px font-w-600">Send Message</p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Book Appointment Modal -->
    <div id="appointment" class="modal fade">
      <div class="modal-dialog modal-login">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Book Appointment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" role="alert" id="alert" style="display: none;"></div>
            <div class="alert alert-success" role="alert" id="success" style="display: none;"></div>
            <div id="fb-root"></div>
            <div class="signup-form">
              <form>
                <p class="hint-text">Set your preferred appointment time and the reason you are setting this
                  appointment and I will get get back to you.
                </p>
                <p class="spacing-agent"> </p>
                <div class="form-group text-center">
                  <div class="row">
                    <div class="col">
                      <label class="form-label">Appointment Date:</label>
                      <input type="date" class="form-control appointDate" name="date" placeholder="date"
                      required="required" id="appointDate">
                    </div>
                    <div class="col">
                      <label class="form-label">Appointment Time:</label>
                      <input type="time" class="form-control appointTime" name="appointTime" placeholder=""
                      required="required" id="appointTime">
                    </div>
                  </div>
                </div>
                <div class="form-group text-center">
                  <label class="form-label">Appointment Reason:</label>
                  <textarea class="form-control" data-toggle="tooltip" title="make it short and snappy" name="appointReason" placeholder="Briefly tell me what is wrong with you? e.g backpain, chestpain, headache" required="required" rows="3" id="appointReason"></textarea>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-info btn-lg btn-block" onclick="bookAppoint()" id="bookNow">Book Now</button>
                </div>
              </form>
            </div>
          </div>
        </div>
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
<script src="../js/controllers/userdashController.js"></script>
</body>
</html>
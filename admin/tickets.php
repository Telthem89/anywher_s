<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['admin_id'])) { Redirect::to('index.php');}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Revenue Dashboard</title>
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
  <body onload="homeadmindetail(),totalDoctors(),totalClient()">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="Dashboard.php" class="navbar-brand font-weight-bold text-uppercase text-base"><img src="../img/ustawi_logo.png" style="border-radius: 0%;"></a>
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
        <div aria-labelledby="notifications" class="dropdown-menu">
        <a href="#" class="dropdown-item">
          <div class="d-flex align-items-center">
            <div class="icon icon-sm bg-violet text-white"><i class="fa fa-hands-helping"></i></div>
            <div class="text ml-2">
              <p class="mb-0">You have 2 new support tickets</p>
            </div>
          </div>
        </a>
        </li>
        <li class="nav-item dropdown ml-auto">
        <a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
          <img src="../img/avatar.png" alt="Profile Picture" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow">
        </a>
        <div aria-labelledby="userInfo" class="dropdown-menu">
          <a href="#" class="dropdown-item">
           <strong class="d-block text-uppercase headings-font-family" id="flname" ><span>User Name</span></strong>
            <small  >Administator</small>
          </a>
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
    <li class="sidebar-list-item"><a href="Dashboard.php" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="registrations.php" class="sidebar-link text-muted"><i class="o-clock-1 mr-3 text-gray"></i><span>Pending<br>Practioners</span></a></li>
     <li class="sidebar-list-item"><a href="pharmacist.php" class="sidebar-link text-muted"><i class="o-clock-1 mr-3 text-gray"></i><span>Pending<br>Pharmacists</span></a></li>
    <li class="sidebar-list-item"><a href="users.php" class="sidebar-link text-muted"><i class="o-user-1 mr-3 text-gray"></i><span>Patients</span></a></li>
    <li class="sidebar-list-item"><a href="practitioners.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Verified<br>Practioners</span></a></li>
    <li class="sidebar-list-item"><a href="admin-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Account</span></a></li>
    <li class="sidebar-list-item"><a href="tickets.php" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Support<br>Tickets</span></a></li>
    <li class="sidebar-list-item"><a href="user_activity.php" class="sidebar-link text-muted"><i class="o-statistic-1 mr-3 text-gray"></i><span>User<br>Activity</span></a></li>
    <li class="sidebar-list-item"><a href="admin_log.php" class="sidebar-link text-muted"><i class="o-repository-1 mr-3 text-gray"></i><span>Activity<br>Log</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
  <section class="py-5" id="adminBody">
      <div class="row">
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <button style="border:none; background-color:transparent; width: 100%;" id="pendingRegBtn" onclick="pendingReg()">
          <div class="bg-white shadow rounded-0 p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text text-center">
                <h6 class="mb-0">Total<br>Revenues</h6><span class="text-gray" id="totalDoctors">5</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-briefcase"></i></div>
          </div>
          </button>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <button style="border:none; background-color:transparent; width: 100%;" id="newTicketsBtn" onclick="newTickets()">
          <div class="bg-white shadow rounded-0 p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text text-center">
                <h6 class="mb-0">Verified<br>Practioners</h6><span class="text-gray">1</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="fa fa-check"></i></div>
          </div>
          </button>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <button style="border:none; background-color:transparent; width: 100%;" id="adminIssuesBtn" onclick="adminIssues()">
          <div class="bg-white shadow rounded-0 p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text text-center">
                <h6 class="mb-0">Verified<br>Pharmacists</h6><span class="text-gray">1</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-check"></i></div>
          </div>
          </button>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <button style="border:none; background-color:transparent; width: 100%;" id="usersInfoBtn" onclick="usersInfo()">
          <div class="bg-white shadow rounded-0 p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text-center">
                <h6 class="mb-0">Total<br>Patients</h6><span class="text-gray" id="totalClient">8</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="fas fa-user"></i></div>
          </div>
          </button>
        </div>
      </div>
    </section>
        
        <div class="container">
          <h2 class="heading1 text-center">Unattended Tickets</h2>
          <p class="lead heading2 text-center">All user issues raised not yet attended to</p> 
          <hr class="line-break" />
          <div class="row">
            <div class="col-lg-12">
              <p class="text-center text-mute">Tap or Click on a ticket to reply to it</p> 
            </div>
            <div class="col-lg-12">
              <a href="#replyMessage" data-toggle="modal" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
                <div class="row">
                  <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <strong class="h5 mb-0">22<sup class="smaller text-gray font-weight-normal">Nov</sup></strong>
                    <img src="../img/avatar.png" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                    <h6 class="mb-0">Jason Max</h6>
                  </div>
                  <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">emailing12after@gmail.com</div>
                    <p class="mb-0 mt-3 mt-lg-0">I am failing to register an account please what do I do? I tried registering twice but still failed to register and it keeps on saying the error cannot be resolved.</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-12">
              <a href="#replyMessage" data-toggle="modal" class="message card px-5 py-3 mb-4 bg-hover-gradient-primary no-anchor-style">
                <div class="row">
                  <div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <strong class="h5 mb-0">24<sup class="smaller text-gray font-weight-normal">Nov</sup></strong>
                    <img src="../img/avatar.png" alt="..." style="max-width: 3rem" class="rounded-circle mx-3 my-2 my-lg-0">
                    <h6 class="mb-0">Simende Jari</h6>
                  </div>
                  <div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="bg-gray-100 roundy px-4 py-1 mr-0 mr-lg-3 mt-2 mt-lg-0 text-dark exclode">simenjarinayesnaka@hotmail.com</div>
                    <p class="mb-0 mt-3 mt-lg-0">My account won't allow me to login</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
            
            <nav class="paging"aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                  </li>
              </ul>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="replyMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="text-left">REPLY</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
          </div>
          <div class="modal-body text-center">
            <h4 class="text-center">
              Replying to: 
            </h4>
            <span>Username<span> with email address: <span></span>

            <form>
              <textarea id="message" rows="5" class="form-control" placeholder="&#9;Type your reply here..."></textarea><br>
              <button class="btn btn-info" data-dismiss="modal" onclick="return sendReply()" value="SEND REPLY">SEND REPLY</button>
            <form>
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
<!-- <script src="../js/lib/charts-home.js"></script>
<script src="../js/lib/front.js"></script>
<script src="../js/controllers/patient.js"></script> -->
<!-- <script src="../js/controllers/userdashController.js"></script> -->
 <script src="../js/controllers/Administration.js"></script>
<script>
  function pendingReg(){
    window.location.href="registrations.php";
  }
  function adminIssues(){
    window.location.href="system_status.php";
  }
  function usersInfo(){
    window.location.href="users.php";
  }
</script>
</body>
</html>

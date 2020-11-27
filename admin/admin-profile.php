<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['admin_id'])) { Redirect::to('index.php');}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anwhere Dashboard</title>
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
  <body onload="homeadmindetail(),getProfile()">
    <!-- navbar-->
    <header class="header" id="myHeader">
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
    <li class="sidebar-list-item"><a href="Dashboard.php" class="sidebar-link text-muted "><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="registrations.php" class="sidebar-link text-muted"><i class="o-clock-1 mr-3 text-gray"></i><span>Pending<br>Practioners</span></a></li>
     <li class="sidebar-list-item"><a href="pharmacist.php" class="sidebar-link text-muted"><i class="o-clock-1 mr-3 text-gray"></i><span>Pending<br>Pharmacists</span></a></li>
    <li class="sidebar-list-item"><a href="users.php" class="sidebar-link text-muted"><i class="o-user-1 mr-3 text-gray"></i><span>Patients</span></a></li>
    <li class="sidebar-list-item"><a href="practitioners.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Verified<br>Practioners</span></a></li>
    <li class="sidebar-list-item"><a href="admin-profile.php" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>My Account</span></a></li>
     <li class="sidebar-list-item"><a href="revenues.php" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Revenues</span></a></li>
    <li class="sidebar-list-item d-none"><a href="user_activity.php" class="sidebar-link text-muted"><i class="o-statistic-1 mr-3 text-gray"></i><span>User<br>Activity</span></a></li>
    <li class="sidebar-list-item d-none"><a href="admin_log.php" class="sidebar-link text-muted"><i class="o-repository-1 mr-3 text-gray"></i><span>Activity<br>Log</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">

    <div class="container user-list">
    <div class="row flex-lg-nowrap">

      <div class="col">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item btn-group w-100">
              <button id="viewTitle" onclick="switchViewGrid()" class="nav-link view-switch active">
                <a href="#switchPoint" class="no-anchor-style">Grid View</a>
              </button>
              <button id="viewTitle" onclick="switchViewTable()" class="nav-link view-switch active">
                <a href="#switchPoint" class="no-anchor-style">Table View</a>
              </button>
            </li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                  <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#user-form-modal">Create Account</button>
                </div>
                <hr class="my-3">
                <div class="form-group text-center">
                  <label>Search By Name:<br>This feature only works in table view</label>
                  <div><input id="myInput" onkeyup="tableFilter()" class="form-control w-100" type="text" placeholder="Search Name"></div>
                </div>
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>All</span>&nbsp;<small>/&nbsp;31</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Active</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Unverified</span>&nbsp;<small>/&nbsp;15</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Filter users registered from:</label>
                    <div>
                      <input id="dateFrom" class="form-control" placeholder="01 Dec 17" type="date">
                    </div>
                    <label class="form-div">To:</label>
                    <div>
                      <input id="dateTo" class="form-control" placeholder="01 Jan 21" type="date">
                    </div>
                    <div>
                      <button class="btn btn-info btn-block searchBtn">Search</button>
                    </div>
                  </div>
                </div>
                <hr class="my-3">
                <div class="">
                  <label>Status:</label>
                  <div class="px-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" name="user-status" id="users-status-disabled">
                      <label class="custom-control-label" for="users-status-disabled">Unverified</label>
                    </div>
                  </div>
                  <div class="px-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" name="user-status" id="users-status-active">
                      <label class="custom-control-label" for="users-status-active">Active</label>
                    </div>
                  </div>
                  <div class="px-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" name="user-status" id="users-status-any" checked="">
                      <label class="custom-control-label" for="users-status-any">Any</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div id="switchPoint" class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                  <h6 class="mr-2"><span>Administrator Details</span><small class="px-1"></small></h6>
                </div>
                <div class="e-table">
                    <div class="container">
                        <div class="main-body">
                              <div class="row justify-content-center" id="mainConterPatient">
                                
                                <div class="col-md-8">
                                	<div class="card">
                                    <img src="../img/avatar-3.jpg" alt="Cover" class="card-img-top" id="avatartacover">
                                    <div class="card-body text-center">
                                      <img src="../img/avatar-3.jpg" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3" id="avatarta">
                                      <h5 class="card-title" id="f_name">Innocent Tauzeni</h5>
                                      <p class="heading2" id="email">innocent@gmail.com</p>
                                      <p class="text-secondary user-status mb-1">ACTIVE</p><br>
                                      <p class="heading2" id="phone">innocent@gmail.com</p>
                                    </div>
                                    <div class="card-footer text-center">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button class="buttn" data-toggle="modal" data-target="#user-form-modal" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                                          <button class="buttn" data-toggle="tooltip" title="verify" ><i class="fa fa-check-circle"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                
                              </div>
                            </div>
                           </div>
                         </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
</div>
        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create/Edit User</h5>
                <button  class="close" data-dismiss="modal">
                  <span aria-hidden="true">X</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form">
                    <div class="row">
                        <div class="col-md-6 form-div">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name"
                            required="required" id="fname">
                        </div>
                        <div class="col-md-6 form-div">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                            required="required" id="lname">
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-div">
                        <div class="form-group">
                          <label>Phone Number:</label>
                          <input type="text" class="form-control" name="phoneNumber" placeholder="Phone number" required="required" id="phoneNumber">
                        </div>
                      </div>
                      <div class="col-md-6 form-div">
                        <div class="form-group">
                          <label>Email:</label>
                          <input type="email" class="form-control" name="email" placeholder="Email" required="required" id="email">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-div">
                        <div class="form-group">
                          <label>New Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Password" required="required" id="pass">
                        </div>
                      </div>
                      <div class="col-md-6 form-div">
                        <div class="form-group">
                          <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                          <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"
                              required="required" id="passcom">
                        </div>
                      </div>
                    </div>
                    <div class="row text-center">
                      <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success btn-lg" onclick="registerClient()" id="clientreg" >Add Client</button>
                        <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
                      </div>
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
</body>
</html>

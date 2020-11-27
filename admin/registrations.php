<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['admin_id'])) { Redirect::to('index.php');}

$admin = new Administrator();
$doctors= $admin->getallDoctorswithPendingStatus()

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ustawi Dashboard</title>
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
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
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
    <li class="sidebar-list-item"><a href="Dashboard.php" class="sidebar-link text-muted "><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="registrations.php" class="sidebar-link text-muted active"><i class="o-clock-1 mr-3 text-gray"></i><span>Pending<br>Practioners</span></a></li>
     <li class="sidebar-list-item"><a href="pharmacist.php" class="sidebar-link text-muted"><i class="o-clock-1 mr-3 text-gray"></i><span>Pending<br>Pharmacists</span></a></li>
    <li class="sidebar-list-item"><a href="users.php" class="sidebar-link text-muted"><i class="o-user-1 mr-3 text-gray"></i><span>Patients</span></a></li>
    <li class="sidebar-list-item"><a href="practitioners.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Verified<br>Practioners</span></a></li>
    <li class="sidebar-list-item"><a href="admin-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Account</span></a></li>
    <li class="sidebar-list-item"><a href="revenues.php" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Revenues</span></a></li>
    <li class="sidebar-list-item d-none"><a href="user_activity.php" class="sidebar-link text-muted"><i class="o-statistic-1 mr-3 text-gray"></i><span>User<br>Activity</span></a></li>
    <li class="sidebar-list-item d-none"><a href="admin_log.php" class="sidebar-link text-muted"><i class="o-repository-1 mr-3 text-gray"></i><span>Activity<br>Log</span></a></li>
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
    <section>
       <div class="container">
        <h2 class="heading1 text-center">Unapproved Registrations</h2>
            <p class="lead heading2 text-center">
                All Medical Practioner Registrations Pending Verification
                <div class="alert alert-danger mt-2 text-center" role="alert" id="alert" style="display: none;"></div>
                <div class="alert alert-success mt-2 text-center" role="alert" id="success" style="display: none;"></div>
            </p>
            
            <hr class="line-break" />
        
            <div class="agenda">
                    <input type="text" class="d-none" id="myInput" onkeyup="tableFilter()" placeholder="Search by date or name...">
                    <table class="table table-condensed table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Speciality</th>
                                <th>Action</th>
                                <th colspan="3" class="text-center"> Status</th>
                            </tr>
                        </thead>
                        <tbody id="allDoctorsSector">
                        
                        <?php foreach ($doctors as $doctor):  ?> 
                        <tr>
                              
                              <td><?php echo $doctor['fullname']; ?></td>
                              <td><?php echo $doctor['datecreate']; ?></td>
                              <td><?php echo $doctor['speciality']; ?></td>
                              <td>
                              <a  onclick="$('#modalprimary').modal('show'),loadDoctorDetails(<?php echo $doctor['id']; ?>),event.preventDefault()" class="no-anchor-style text-blue"  href="#"> View Profile <i class="fa fa-info-circle"></i></a> 
                              <a  onclick="Approve(<?php echo $doctor['id']; ?>)" class="no-anchor-style text-green ml-4" href="#"> Approved <i class="fa fa-check-circle"></i></a>
                              <a  onclick="Reject(<?php echo $doctor['id']; ?>)" class="no-anchor-style text-red ml-4" href="#"> Reject <i class="fa fa-trash"></i></a>              
                              </td>
                              
                              <td><?php echo $doctor['adminstatus']; ?></td>
                        </tr>
                <?php endforeach ?> 
                            
                        </tbody>
                        <div class="text-center" id="info">
                        </div>
                    </table>
            </div>
           
        </div>
    </section>  
       

         <!-- User Form Modal -->
        

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
<script src="../js/all.min.js"></script>
<script src="../vendor/popper.js/umd/popper.min.js"> </script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="../js/lib/charts-home.js"></script>
<!-- <script src="../js/lib/front.js"></script>
<script src="../js/controllers/patient.js"></script> -->
<!-- <script src="../js/controllers/userdashController.js"></script> -->
 <script src="../js/controllers/Administration.js"></script>
 <script src="../js/lib/jquery.dataTables.min.js"> </script>
 <script src="../js/lib/jquery.dataTables.min.js"> </script>
 <script>
        $('#myTable').DataTable( {
            fixedHeader: true
        } );
    </script>


<script>
  function newTickets(){
    window.location.href="tickets.php";
  }
  function adminIssues(){
    window.location.href="system_status.php";
  }
  function usersInfo(){
    window.location.href="users.php";
  }

   function pendingReg(){
    window.location.href="registrations.php";
  }
</script>
</body>
</html>
<div class="modal fade" role="dialog" tabindex="-1" id="modalprimary">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button  class="close" data-dismiss="modal">
                  <span aria-hidden="true">X</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="py-1">
                  <form class="form">
                  <div class="row">
                        <div class="col-md-6 form-div">
                          <label>MDPCZ_ID</label>
                            <input type="text" class="form-control" name="MDPCZ_ID" id="MDPCZ_ID" readonly>
                        </div>
                        <div class="col-md-6 form-div">
                          <label>Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-div">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name"  id="fname" readonly>
                        </div>
                        <div class="col-md-6 form-div">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name"  id="lname" readonly>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-div">
                        <div class="form-group">
                          <label>Phone Number:</label>
                          <input type="text" class="form-control" name="phoneNumber"  id="phoneNumber" readonly>
                        </div>
                      </div>
                      <div class="col-md-6 form-div">
                        <div class="form-group">
                          <label>Email:</label>
                          <input type="email" class="form-control" name="email"  id="email" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-md-6 form-div">
                        <img src="../img/avatar-1.jpg" id="avatar_img">
                      </div>
                    </div>
               <br>
                    <div class="row text-center">
                      <div class="col-md-12 text-center">
                        <div class="row justify-content-center">
                          <div class="col-md-6">
                            <div class="container">
                              <div class="row">
                              <div class="col-md-6"><h5>Qualification: </h5></div>
                              <div class="col-md-6">PHD Medical health</div> 
                            </div>
                            <div class="row">
                              <div class="col-md-6"><h5>Specialist: </h5></div>
                              <div class="col-md-6">Family Doctor</div> 
                            </div>
                            <div class="row justify-content-center mb-4">
                              <div class="col-md-6">
                                <b>Verified <i class="fa fa-check-circle text-primary"></i></b>
                              </div> 
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-md-6">
                            <p class="badge-primary badge float-left p-3"><strong style="font-size: 23px; font-weight: bolder;">Total Revenues</strong> <span style="font-size: 23px; font-weight: bolder;">$20 903</span></p> 
                            Reviews: +23K
                            <i class="fa fa-star  text-warning"></i>
                            <i class="fa fa-star  text-warning"></i>
                            <i class="fa fa-star  text-warning"></i>
                            <i class="fa fa-star  text-warning"></i>
                            <i class="fa fa-star  text-warning"></i>
                            <i class="fa fa-star  text-warning"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

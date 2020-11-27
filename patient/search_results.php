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
    <li class="sidebar-list-item"><a href="shop.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Pharmacies</span></a></li>
    <li class="sidebar-list-item"><a href="user-log.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
    <div class="container-fluid px-xl-5">
        <!--Search Section-->
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12" id="inner">
                    <h1 class="heading1">You Searched for</h1>
                    <p class="heading2">Cardiologists in Harare</p>
                    <div class="search input-group md-form form-sm form-1 pl-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text lighten-2" id="basic-text1"><i class="fa fa-search text-white"
                                aria-hidden="true"></i>
                            </span>
                        </div>
                        <input class="form-control my-0 py-1" type="text" placeholder="Search for someone else" aria-label="Search">
                    </div>
                </div>
            </div>
        </div>
        <div class="container search-body">
            <div class="row ng-scope text-center">
                <div class="col-md-3 col-md-push-9">
                    <h4>Results <span class="fw-semi-bold">Filtering</span></h4>
                    <p class="text-muted fs-mini">You could also search using the following categories:</p>
                    <ul class="nav nav-pills nav-stacked search-result-categories mt text-left">
                        <li>
                            <a href="#">Popular</a>
                        </li>
                        <li>
                            <a href="#">Online</a>
                        </li>
                        <li>
                            <a href="#">Harare</a>
                        </li>
                        <li>
                            <a href="#">Swift Response</a>
                        </li>
                        <li>
                            <a href="#">Affordable</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-md-pull-3">
                    <p class="search-results-count">12 results match your search criteria</p>
                    <section class="search-result-item">
                        <a class="image-link" href="#"><img class="image" src="../img/avatar.png">
                        </a>
                        <div class="search-result-item-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="search-result-item-heading"><a href="#">Doctor John Chibadura</a></h4>
                                    <p class="info">Harare, Zimbabwe</p>
                                    <p class="description">
                                        Not just your doctor but something better. I am your friend
                                        with 10+ years experience in the medical field. After graduating
                                        from University of Zimbabwe I soured the world helping people and
                                        now I am here to help you.
                                    </p>
                                </div>
                                <div class="col-sm-3 text-align-center">
                                    <p class="value3 mt-sm">$97 rtgs</p>
                                    <p class="fs-mini text-muted">PER SESSION</p>
                                    <a class="btn btn-primary btn-info btn-sm" href="searched_profile.php">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="search-result-item">
                        <a class="image-link" href="#"><img class="image" src="../img/avatar.png">
                        </a>
                        <div class="search-result-item-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="search-result-item-heading"><a href="#">Doctor John Chibadura</a></h4>
                                    <p class="info">Harare, Zimbabwe</p>
                                    <p class="description">
                                        Not just your doctor but something better. I am your friend
                                        with 10+ years experience in the medical field. After graduating
                                        from University of Zimbabwe I soured the world helping people and
                                        now I am here to help you.
                                    </p>
                                </div>
                                <div class="col-sm-3 text-align-center">
                                    <p class="value3 mt-sm">$97 rtgs</p>
                                    <p class="fs-mini text-muted">PER SESSION</p>
                                    <a class="btn btn-primary btn-info btn-sm" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="search-result-item">
                        <a class="image-link" href="#"><img class="image" src="../img/avatar.png">
                        </a>
                        <div class="search-result-item-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="search-result-item-heading"><a href="#">Doctor John Chibadura</a></h4>
                                    <p class="info">Harare, Zimbabwe</p>
                                    <p class="description">
                                        Not just your doctor but something better. I am your friend
                                        with 10+ years experience in the medical field. After graduating
                                        from University of Zimbabwe I soured the world helping people and
                                        now I am here to help you.
                                    </p>
                                </div>
                                <div class="col-sm-3 text-align-center">
                                    <p class="value3 mt-sm">$97 rtgs</p>
                                    <p class="fs-mini text-muted">PER SESSION</p>
                                    <a class="btn btn-primary btn-info btn-sm" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="search-result-item">
                        <a class="image-link" href="#"><img class="image" src="../img/avatar.png">
                        </a>
                        <div class="search-result-item-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="search-result-item-heading"><a href="#">Doctor John Chibadura</a></h4>
                                    <p class="info">Harare, Zimbabwe</p>
                                    <p class="description">
                                        Not just your doctor but something better. I am your friend
                                        with 10+ years experience in the medical field. After graduating
                                        from University of Zimbabwe I soured the world helping people and
                                        now I am here to help you.
                                    </p>
                                </div>
                                <div class="col-sm-3 text-align-center">
                                    <p class="value3 mt-sm">$97 rtgs</p>
                                    <p class="fs-mini text-muted">PER SESSION</p>
                                    <a class="btn btn-primary btn-info btn-sm" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </section>
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
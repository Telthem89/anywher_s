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
		<!-- Favicon-->
		<link rel="shortcut icon" href="../img/favicon.png?3">
		<!-- Tweaks for older IEs--><!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/php5shiv/3.7.3/php5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	</head>
	<body id="pay-body" onload="homedocdetail(),getdoctorPaymentDetails()">
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
			<li class="nav-item dropdown mr-3"><a id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
			<div aria-labelledby="notifications" class="dropdown-menu">
				<a href="#" class="dropdown-item">
					<div class="d-flex align-items-center">
						<div class="icon icon-sm bg-blue text-white"><i class="fas fa-envelope"></i></div>
						<div class="text ml-2">
							<p class="mb-0">You have 6 new messages</p>
						</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="d-flex align-items-center">
						<div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
						<div class="text ml-2">
							<p class="mb-0">You have 1 checkup session</p>
						</div>
					</div>
				</a>
			</div>
		</li>
		<li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="../img/avatar-6.jpg" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1"></a>
		<div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname">User Name</strong><small>User</small></a>
		<div class="dropdown-divider"></div><a href="user-profile.php" class="dropdown-item">Profile</a><a href="patient-log.php" class="dropdown-item">Activity log</a>
		<div class="dropdown-divider"></div><a  class="dropdown-item" onclick="Logout()">Logout</a>
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
    <li class="sidebar-list-item"><a href="doctors.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
    <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
    <li class="sidebar-list-item"><a href="shop.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Pharmacies</span></a></li>
     <li class="sidebar-list-item"><a href="myOrder.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Orders</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
<div class="container-fluid px-0" id="bg-div">
<div class="row justify-content-center">
	<div class="col-lg-9 col-12">
		<div class="card card0">
			<p class="d-none" id="fname"></p>
			<div class="d-flex" id="wrapper">
				<!-- Sidebar -->
				<div class="bg-light border-right" id="sidebar-wrapper">
					<div class="sidebar-heading pt-5 pb-4"><strong>PAY WITH</strong></div>
					<div class="list-group list-group-flush">
						<a data-toggle="tab" href="#paynow" id="paynow-tab" class="tabs list-group-item bg-light">
							<div class="list-div my-2">
								<i class="fas fa-money-bill-wave"></i> &nbsp;&nbsp; PayNow
							</div>
						</a>
						<a data-toggle="tab" href="#paypal" id="paypal-tab" class="tabs list-group-item bg-light">
							<div class="list-div my-2">
								<i class="fab fa-paypal"></i> &nbsp;&nbsp; PayPal
							</div>
						</a>
						<a data-toggle="tab" href="#mastercard" id="mastercard-tab" class="tabs list-group-item bg-light">
							<div class="list-div my-2">
								<i class="fab fa-cc-mastercard"></i> &nbsp;&nbsp; Mastercard
							</div>
						</a>
						<a data-toggle="tab" href="#visa" id="visa-tab" class="tabs list-group-item bg-light">
							<div class="list-div my-2">
								<i class="fas fa-qrcode"></i> &nbsp;&nbsp;&nbsp; Visa QR <span id="new-label" >NEW</span>
							</div>
						</a>
					</div>
					</div> <!-- Page Content -->
					<div id="page-content-wrapper">
						<div class="row pt-3" id="border-btm">
							<div class="col-4"> <button class="btn btn-info mt-4 ml-3 mb-3" id="menu-toggle">
								<div class="bar4"></div>
								<div class="bar4"></div>
								<div class="bar4"></div>
								</button>
							</div>
							<div class="col-8">
								<div class="row justify-content-right">
									<div class="col-12">
										<p class="mb-0 mr-4 text-right">Paying <span class="top-highlight" id="priceperappoinrmnt">$ 100</span> </p>
									</div>
								</div>
								<div class="row justify-content-right">
									<div class="col-12">
										<p class="mb-0 mr-4 mt-4 text-right" >to: Dr. <b id="doctorName">John Chibadura</b></p>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-content">
							<div id="paynow" class="tab-pane in active">
								<div class="row justify-content-center">
									<div class="col-11">
										<div class="alert alert-danger text-center" role="alert" id="alert" style="display: none;"></div>
                        <div class="alert alert-success" role="alert" id="success" style="display: none;"></div>
										<h3 class="mt-0 mb-4 text-center">Pay using local currency</h3>
										<div class="row justify-content-center">
											<div class="text-center">
												You are about to pay <b id="doctorAmount">$800.00</b> to doctor <b id="doctorNameid">Innocent Tauzeni</b><br>
											</div>
											<div class="qr"> 


												<form>
													<input type="hidden" id="phoneNumber">
													<input type="hidden" id="myphoneNumber">
													<input type="hidden" id="amount">
													<button value="Pay Now" class="btn btn-info placeicon" type="button" onclick="$('#logging_in').modal('show'),event.preventDefault(),payDoctor()">PAY NOW</button>
												</form>
												 </div>
										</div>
									</div>
								</div>
							</div>
							<div id="paypal" class="tab-pane">
								<div class="row justify-content-center">
									<div class="col-11">
										<h3 class="mt-0 mb-4 text-center">Use your paypay account to pay</h3>
										<div class="row justify-content-center">
											<div class="qr"> 
												<form>
													
													<button value="Pay Now" class="btn btn-info placeicon" onclick="pay()">Pay Now</button> 
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="mastercard" class="tab-pane">
								<div class="row justify-content-center">
									<div class="col-11">
										<div class="form-card">
											<h3 class="mt-0 mb-4 text-center">Enter your card details to pay</h3>
											<form>
												<div class="row">
													<div class="col-12">
														<div class="input-group"> <input type="text" id="cr_no" placeholder="0000 0000 0000 0000" minlength="19" maxlength="19"> <label>CARD NUMBER</label> </div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="input-group"> <input type="text" name="exp" id="exp" placeholder="MM/YY" minlength="5" maxlength="5"> <label>CARD EXPIRY</label> </div>
													</div>
													<div class="col-6">
														<div class="input-group"> <input type="password" name="cvcpwd" placeholder="&#9679;&#9679;&#9679;" class="placeicon" minlength="3" maxlength="3"> <label>CVV</label> </div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12"> <input type="submit" value="Pay" class="btn btn-info placeicon"> </div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div id="visa" class="tab-pane">
								<div class="row justify-content-center">
									<div class="col-11">
										<h3 class="mt-0 mb-4 text-center">Use your visa app to scan the QR code to pay</h3>
										<div class="row justify-content-center">
											<div class="qr"> <img src="../img/testqr.png" width="200px" height="200px">
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
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/popper.js/umd/popper.min.js"> </script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="../js/controllers/patient.js"></script>
<script src="https://js.stripe.com/terminal/v1/"></script>
</body>
</html>

<div id="logging_in" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary y-jumbo">
        <h4 class="modal-title  text-light">Please Wait......</h4>
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
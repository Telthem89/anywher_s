<?php 
     require '../webservices/autoloader.php';
    
    if (isset($_SESSION['patient_id'])) {
     Redirect::to('../patient');
 }elseif (isset($_SESSION['doctor_id'])) {
     Redirect::to('../doctor');
 }elseif (isset($_SESSION['pharmacy_id'])) {
     Redirect::to('../pharmacy');
 } 


 ?>

<!-- //  <script> -->


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Anywhere Healthcare Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../css/animate.css">
	
	<link rel="stylesheet" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="../css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="../css/jquery.timepicker.css">
	<link rel="stylesheet" href="../css/fonts/flaticon/flaticon.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand bg-white p-3 " href="../index.php"><img src="../img/ustawi_logotry2.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
            <li class="nav-item">
                <a href="#supportModal" class="nav-link " data-toggle="modal">
                    Contact Support                   
                </a>
            </li>
            </ul>
        </div>
    </div>
</nav>
	<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container d-flex align-items-center">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span> Menu
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav m-auto">
					<li class="nav-item active"><a href="../index.php" class="nav-link"><img src="../img/ustawi_logotry2.png"></a></li>
					
				</ul>
				<ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Register</a></li>
                    <li class="nav-item">
					    <a href="#supportModal" class="nav-link " data-toggle="modal">
                            Contact Support                   
                        </a>
                    </li>
				
				</ul>
			</div>
		</div>
	</nav> -->
	<!-- END nav -->
	
        <!--LOGIN FORM-->
    </div>
    <div class="login-body">
    <div class="login-form">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="alert alert-danger" role="alert" id="alert" style="display: none;"></div>
                    <h4 class="text-center">Sign-in to your account</h4>
                    <p class="spacing-agent"> </p>
                    <div class="content-seperator"><i class="fa fa-circle-o"></i></div>
                    <div class="row omb_row-sm-offset-3 omb_socialButtons d-none">
                        <div class="col-lg-6 col-sm-3">
                            <a href="#" class="btn btn-lg btn-block omb_btn-google">
                                <i class="fa fa-google visible-xs"></i>
                                <span class="hidden-xs">Google</span>
                            </a>
                        </div>
                        <div class="col-lg-6 col-sm-3">
                            <a href="#" class="btn btn-lg btn-block omb_btn-facebook">
                                <i class="fa fa-facebook visible-xs"></i>
                                <span class="hidden-xs">Facebook</span>
                            </a>
                        </div>
                    </div>
                    <p class="spacing-agent"> </p>
                    <div class="content-seperator d-none"><i class="">OR</i></div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </span>
                            </div>
                            <select class="form-control" id="usertype">
                                <option value="" disabled selected>Login as:</option>
                                <option value="client">Patient</option>
                                <option value="doctor">Medical Practioner</option>
                                <option value="pharmacy">Pharmacist</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fa fa-envelope"></span>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="Username or email" required="required" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required" id="password">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <a onclick="showPass()" class="btn border-0">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center justify-content-center">
                        <button type="button" class="btn btn-primary login-btn btn-block" onclick="login()">Sign in</button>
                    </div>
                    <p class="spacing-agent"> </p>
                    <p class="text-center text-dark small">Don't have an account? <a href="register.php">Sign up here!</a></p>
                     <p class="spacing-agent"> </p>
                    <div class="clearfix">
                        <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                        <a href="forgot-password.php" class="float-right">Forgot Password?</a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="ftco-footer" id="basic-footer">
		<div class="container-fluid bg-primary py-5">
			<div class="row">
				<div class="col-md-12 text-center">
					
					<p class="mb-0">
						Copyright Sagehill Business Solutions &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
				    </p>
					</div>
				</div>
			</div>
		</footer>
		</div>
		
		<!--Supoort Modal-->
        <div id="supportModal" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                            <h3 class="text-center">
                                <p class="m-0">How can we be of assistance</p>
                            </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" id="alert" style="display: none;"></div>
                        <div class="alert alert-success" role="alert" id="success" style="display: none;"></div>
                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="semail" name="semail" placeholder="Email Adress e.g. ejemplo@gmail.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        <textarea class="form-control" placeholder="Your message goes here..." required></textarea>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="Submit" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            
    <script src="../js/lib/jquery-3.5.1.min.js"></script>
    <script src="../js/lib/popper.min.js"></script>
    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/controllers/loginController.js"></script>
    <script>
        function showPass(){
            var x = document.getElementById("password");
            if(x.type === "password"){
             x.type = "text";
            }else{
             x.type="password";
            }
        }
    </script>
    
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

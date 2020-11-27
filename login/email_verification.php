<?php 
     require '../webservices/autoloader.php';
    if (isset($_SESSION['patient_id'])) {
     Redirect::to('../patient');
 }elseif (isset($_SESSION['doctor_id'])) {
     Redirect::to('../doctor');
 } 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Anywhere Healthcare Verification</title>
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
  <p><br></p>
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-7">
                <div class="text-center mt-lg-5">
             <div class="alert alert-success" role="alert" id="success" style="display: none;"></div>
              <div class="alert alert-danger" role="alert" id="alert" style="display: none;"></div>

        <div class="card">
            <div class="card-header">E-mail Address Verification</div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                         <input type="number" id="emailCode" class="form-control" placeholder="Enter Code" maxlength="6" pattern="\d{6}" required>
                        
                    </div>
                    <button type="button" class="btn btn-success btn-block" onclick="ActivateMyAccount()">Submit Code</button>
                </form>
            </div>
        </div>
    </div>
           </div>
       </div>
   </div>
   <p class="mt-5">&emsp;</p>
    
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
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Adress e.g. ejemplo@gmail.com" required>
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
    <script src="../js/controllers/patient.js"></script>
</body>
</html>

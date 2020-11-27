
<?php

require '../webservices/autoloader.php';
$doctor       = new Doctor();
$client       = new Patient();
$pharmacy     = new Pharmacy();


if(isset($_POST['btnSubmit'])){
    // password
    // cpassword

    $email            = trim($_GET['email']);
    $password         = trim($_POST['password']);
    $cpassword        = trim($_POST['cpassword']);
    $role             = trim($_POST['role']);

    if($password !==$cpassword){
        echo '<script>alert("Passwords do no match")</script>';
        exist();
    }
    else{
        
     $url = 'sucess.php?success=yourAccountupdated&email='.$email;


    if($role  == "Doctor"){
        $response = $doctor->updateDoctorPassword($password,$email);
        if($response ==  true){
            header('Location: '.$url);
        }
              
    }
    elseif($role  =="client"){
        $response = $client->updateClientPassword($password,$email);
        if($response ==  true){
             header('Location: '.$url);    
        }
    }
    elseif($role  =="pharmacy"){
        $response = $pharmacy->updatePharmacyPassword($password,$email);
        if($response ==  true){
             header('Location: '.$url);
        } 
    }
    }

 
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Anywhere Healthcare -Reset Your Password</title>
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
	<!-- END nav -->

<!--FORGOT-PASSWORD FORM-->
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center main-div-forgot">
            <div class="col-md-5 shadow rounded-lg forgot-pass bg-white pt-5 pb-5 pr-2 pl-2 mb-5"><!--right col-->
               
            
                <div class="tab-content">
                    <div class="tab-pane active" id="reset">
                        <form class="form" onSubmit="validate()" method="POST">
                            <div class="form-group text-center">
                                <p class="line-break"></p><br>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Your Password</h2>
                                <p class="line-break"></p>
                                <div class="col-md-10 forgot-pass-field seperated">
                                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </span>
                            </div>
                            <select class="form-control" id="role" name="role">
                                <option value="" disabled selected>User role:</option>
                                <option value="client">Patient</option>
                                <option value="doctor">Medical Practioner</option>
                                <option value="pharmacy">Pharmacist</option>
                            </select>
                        </div>
                    </div>
                               <div class="form-group">
                                <input type="text" class="form-control" name="password" id="password" placeholder="Enter New Password" title="enter your email.">
                                </div>
                                <div class="form-group">
                                <input type="text" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Your Password" title="enter your email.">
                                </div>
                                    
                                </div>
                                <p class="line-break"></p>
                                <div class="col-md-10 forgot-pass-field seperated">
                                    <input type="submit" class="btn btn-info  btn-block" name="btnSubmit" value="Reset Password" >
                                </div>
                            </div>
                        </form>
                    </div><!--/tab-pane-->
                   
                </div>
            </div>
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
		
      
    
    <script src="../js/lib/jquery-3.5.1.min.js"></script>
    <script src="../js/lib/popper.min.js"></script>
    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/controllers/forgotpassController.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
    <script src="../js/lib/sweetalert.min.js"></script>	
</body>
</html>

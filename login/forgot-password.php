
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Anywhere Healthcare</title>
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
                <ul class="nav nav-tabs">
                    <li class="active tab-list first-tab"><a data-toggle="tab" href="#reset">Retrieve Password</a></li>
                    <li class="tab-list d-none"><a data-toggle="tab" href="#question">Security Question</a></li>
                </ul>
            
                <div class="tab-content">
                    <div class="tab-pane active" id="reset">
                        <form class="form">
                            <div class="form-group text-center">
                                <p class="line-break"></p><br>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can retrieve your password using your email.</p>
                                <p class="line-break"></p>
                                <div class="col-md-10 forgot-pass-field seperated">
                                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </span>
                            </div>
                            <select class="form-control" id="role">
                                <option value="" disabled selected>User role:</option>
                                <option value="client">Patient</option>
                                <option value="doctor">Medical Practioner</option>
                                <option value="pharmacy">Pharmacist</option>
                            </select>
                        </div>
                    </div>
                                    <input type="email" class="form-control" name="email" id="femail" placeholder="Enter your Email" title="enter your email.">
                                </div>
                                <p class="line-break"></p>
                                <div class="col-md-10 forgot-pass-field seperated">
                                    <input type="button" class="btn btn-info  btn-block" value="forgot" onclick="forgot()">
                                </div>
                            </div>
                        </form>
                    </div><!--/tab-pane-->
                    <div class="tab-pane" id="question">
                            <form class="form">
                                <div class="form-group text-center">
                                    <p class="line-break"></p><br>
                                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                                    <h2 class="text-center">Forgot Password?</h2>
                                    <p>If you have set a security question before,
                                        you can use it to get into your account.</p>
                                    <p class="line-break"></p>
                                    <div class="col-md-10 forgot-pass-field seperated">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" title="enter your email.">
                                    </div>
                                    <div class="col-md-10 forgot-pass-field seperated">
                                        <input type="text" class="form-control" name="sec-question" id="sec-question" placeholder="Your Security Question" title="your answer">
                                    </div>
                                    <div class="col-md-10 forgot-pass-field seperated">
                                        <input type="email" class="form-control" name="sec-answer" id="sec-answer" placeholder="Enter your answer" title="enter your answer.">
                                    </div>
                                    <div class="col-md-10 forgot-pass-field seperated">
                                        <input type="submit" class="btn btn-info " name="question">
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
    <script src="../js/controllers/forgotpassController.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
    <script src="../js/lib/sweetalert.min.js"></script>	
</body>
</html>

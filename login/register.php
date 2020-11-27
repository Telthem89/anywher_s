
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
<body id="body">
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
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
    </nav>
    <!-- END nav -->
    <div class="container-fluid register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3 class="text-white">Welcome</h3>
                        <p>You are 30 seconds away from experiencing unmatched convinience</p>
                        <a href="login.php" class="btn btn-info rounded-lg mb-5">LOGIN IF YOU ALREADY<br> HAVE AN ACCOUNT</a>
                    </div>
                    <div class="col-md-9 register-right">
                        
                        <ul class="nav nav-tabs nav-justified mt-1 ml-5 pl-5" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="patient-tab" data-toggle="tab" href="#patientTab" role="tab" aria-controls="patientTab" aria-selected="true">Patient</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="practitioner-tab" data-toggle="tab" href="#practitionerTab" role="tab" aria-controls="practitionerTab" aria-selected="false"> Practitioner</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="practitioner-tab" data-toggle="tab" href="#pharmacyTab" role="tab" aria-controls="pharmacyTab" aria-selected="false"> Pharmacy</a>
                            </li>
                        </ul><br>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="patientTab" role="tabpanel" aria-labelledby="patient-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="alert alert-danger text-center" role="alert" id="alert" style="display: none;"></div>
                                      <div class="alert alert-success text-center" role="alert" id="success" style="display: none;"></div>
                                    </div>
                                </div>
                                <h3 class="register-heading">Register as a patient</h3>

                                <div class="row register-form">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Full Name *" id="fullname" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" minlength="10" maxlength="15" name="txtEmpPhone" class="form-control" placeholder="Your Phone Number *" id="phoneNumber" />
                                        </div>
                                       

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email *" id="email" />
                                        </div>
                                         <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control" placeholder="Password *" value="" id="pass" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a onclick="showPass()" class="btn border-0">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       <!--  <div class="form-group">
                                            <input type="password" class="form-control"  placeholder="Confirm Password *" id="passcom" />
                                        </div> -->
                                        <div class="form-group">
                                            <label class="form-check-label"><input type="checkbox" required="required" id="tnc" > I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                                        </div>
                                        <input type="button" class="btnRegister" id="clientreg"  value="Register" onclick="event.preventDefault(),registerClient()" />
                                        


                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="practitionerTab" role="tabpanel" aria-labelledby="practitioner-tab">
                                 <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="alert alert-danger text-center" role="alert" id="alert1" style="display: none;"></div>
                                      <div class="alert alert-success text-center" role="alert" id="success1" style="display: none;"> </div>
                                    </div>
                                </div>
                                <h3  class="register-heading">Register as a medical practitioner</h3>
                                <div class="row register-form">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Full Name *" value=""id="dfullname"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Medical ID e.g ZIMA #, MDPCZID, etc *" value="" id="MDPCZ_ID" />
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" value="" id="emailAddress" />
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control" placeholder="Password *" value="" id="password" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a onclick="showPass()" class="btn border-0">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-check-label"><input id="tncdo" type="checkbox" required="required" > I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label> 
                                        </div>

                                        <input type="button" class="btnRegister" id="docreg"  value="Register" onclick="event.preventDefault(),registerDoc()" />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pharmacyTab" role="tabpanel" aria-labelledby="practitioner-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="alert alert-danger" role="alert" id="alert1" style="display: none;"></div>
                                      <div class="alert alert-success" role="alert" id="success1" style="display: none;"></div>
                                    </div>
                                </div>
                                <h3  class="register-heading">Register as a<br> Pharmacy/Pharmacist</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Full Name *" value="" id="pfullname" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" maxlength="15" minlength="10" class="form-control" placeholder="Phone *" value="" id="pphone1"/>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" value="" id="pemailAddress" />
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control" placeholder="Password *" value="" id="ppassword" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a onclick="showPass()" class="btn border-0">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">                            
                                
                                        <label class="form-check-label"><input id="ptncdo" type="checkbox" required="required" > I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>                    
                                    </div>
                                        <input type="button" class="btnRegister" id="pharmactreg"  value="Register" onclick="event.preventDefault(),registerPhamacistacc()" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<p class="spacing-agent"></p>
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
<script src="../js/lib/jquery-3.5.1.min.js"></script>
<!-- <script src="../jslib/jquery.mobilePhoneNumber.js"></script> -->
<script src="../js/lib/popper.min.js"></script>
<script src="../js/lib/bootstrap.min.js"></script>
<script src="../js/controllers/registerController.js"></script>
<script>
        function showPass(){
         var x = document.getElementById("pass");
         var y = document.getElementById("password");
         var z = document.getElementById("ppassword");
         if(x.type === "password"){
            x.type = "text";
         }else{
            x.type="password";
        }
        if(y.type === "password"){
            y.type = "text";
         }else{
            y.type="password";
        }
        if(z.type === "password"){
            z.type = "text";
         }else{
            z.type="password";
        }
    }
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.8.1/libphonenumber-js.min.js" integrity="sha512-OQntMwU8z05kGoiWfTRnVEyAOOd/X+mtaQEbOWQaGge3rtp0PRko2rcUHkrAkfSEw8CxPRcnQhqoOqFAicDHxg==" crossorigin="anonymous"></script> -->
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>
<!-- Load the JS SDK asynchronously -->
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script> -->
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

<script>
  // alert(new libphonenumber.AsYouType('ZW').input('+263774914150'))
</script>

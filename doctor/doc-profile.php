<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['doctor_id'])) { Redirect::to('../login/login.php');}
elseif (isset($_SESSION['adminstatus'])) {
     $status=$_SESSION['adminstatus'];
     if ($status =='Pending' || $status =='Rejected' ) {
         Redirect::to('../login/verification.php');
         unset($_SESSION['doctor_id']);
         session_destroy();
     }} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anywhere Dashboard-My profile</title>
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
    <!-- Custom stylesheet-->
    <link rel="stylesheet" href="../css/style.blue.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/favicon.png?3">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/php5shiv/3.7.3/php5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <style type="text/css">
      .me:hover {
      background-color: #1FB264;
      border: 4px dashed #ffffff;
    }
    </style>
  </head>
  <body onload="loadprofile(),loadSocialMeadia()">
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
    <li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="" alt="" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar"></a>
    <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="fname"></strong><small id="speciality"></small></a>
    <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Profile</a>
    <div class="dropdown-divider"></div><a onclick="Logout()" class="dropdown-item">Logout</a>
  </div>
</li>
</ul>
</nav>
</header>
<div class="d-flex align-items-stretch">
<div id="sidebar" class="sidebar py-3">
<div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">ANYWHERE</div>
<ul class="sidebar-menu list-unstyled">
<li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted "><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
<li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>My Appointments</span></a></li>
 <li class="sidebar-list-item"><a href="doc-profile.php" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
<li class="sidebar-list-item d-none"><a href="att-patients.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Attended Patients</span></a></li>
 <li class="sidebar-list-item"><a href="patient_history.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Patient History</span></a></li>
</ul>
</div>
<div class="container">
<div class="row">
  <div class="col-sm-12 heading1"><h1>My Profile</h1></div>
</div>
<div class="row">
  <div class="col-sm-3">
  <div class="text-center">
    <img src="#" class="avatar img-circle img-thumbnail" alt="avatar" id="avatar1">
    <h6>Upload a different photo...</h6>
    <form enctype="multipart/form-data" method="post">
      <div class="me" style="border: 4px dashed #1FB264;">
      <label class=""><i class="fa fa-camera fa-4x mt-3"></i>
      <input type="file" class="text-center center-block file-upload" id="myavatar" style="display: none"><br>
      Click icon to upload 
      </label>
    </div>
      <p><br></p>
      <button class="btn btn-success" type="button" onclick="updateFProfilePic()">Upload Picture</button>
    </form>
    <h4 class="username d-none"  id="fname"></h4>
    <p class="text-muted d-none" id="speciality"></p>
    <p class="text-muted d-none" id="zma"></p>
    <p class="text-muted d-none" id="joinedga"></p>
  </div><hr><br>
  </div><!--/left column-->
  <div class="col-sm-9"><!--right col-->
  <ul class="nav nav-tabs">
    <li class="active tab-list"><a data-toggle="tab" href="#personalDetails"><i class="fa fa-user"></i> Personal Details</a></li>
    <li class="tab-list"><a data-toggle="tab" href="#social"><i class="fa fa-comments"></i> Social Media</a></li>
    <li class="tab-list"><a data-toggle="tab" href="#security"><i class="fa fa-home"></i> Bank Details</a></li>
  </ul>
  
  <div class="tab-content">
    <div class="tab-pane active" id="personalDetails">
      <div class="error p-4 bg-danger text-center text-light rounded" id="alert" role="alert" style="display: none;"></div>
    <div class="alert alert-success" role="alert" id="success" style="display: none;"></div>
      <form class="form">
        <div class="form-group">
          <p class="line-break"></p>
          <div class="col-xs-6">
            <label for="first_name"><h4>First name</h4></label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name.">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="last_name"><h4>Last name</h4></label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name.">
          </div>
        </div>
        <div class="form-group ">
        
        <div class="col-xs-6">
          <label for="nationality"><h4>Date of Birth</h4></label>
          <input type="date" class="form-control" id="dob" placeholder="e.g Date of Birth" title="dob">
        </div>
      </div>

        <div class="form-group">
        
        <div class="col-xs-6">
          <label for="gender">Gender</label>
          <select class="form-control" id="gender" name="gender" required="required">
              <option value="Gender" disabled selected>Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
          </select>
        </div>
      </div>
        
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="phone"><h4>Phone Number</h4></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Include country code e.g +26377565..."
            title="enter your phone number">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="email"><h4>Email</h4></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="nationality"><h4>Country of Residence</h4></label>
            <input type="text" class="form-control" id="nationality" placeholder="e.g Zimbabwe" title="Your Nationality">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-6">
            <label for="city"><h4>City</h4></label>
            <input type="text" class="form-control" id="city" placeholder="e.g Harare" title="enter your city">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="work_address"><h4>Work Address</h4></label>
            <input type="text" class="form-control" id="work_address" placeholder="e.g 21 Gaka Road, Seke" title="enter your address">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="zima"><h4>ZIMA ID</h4></label>
            <input type="text" class="form-control" id="zima" placeholder="Your Zima ID" title="your ZIMA ID">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="bio"><h4>About(Mini-Biography)</h4></label>
            <input type="text" class="form-control" name="bio" id="bio" placeholder="  write about yourself">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="specialty"><h4>Specialty</h4></label>
            <input type="text" class="form-control" id="specialty" placeholder="e.g Bone Specialist">
          </div>
        </div>

        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="specialty"><h4>Qualification</h4></label>
            <input type="text" class="form-control" id="qualification" placeholder="e.g Qualification">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="experience"><h4>Experience</h4></label>
            <input type="text" class="form-control" id="experience" placeholder="e.g 5+ years in cardiology">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <br>
            <button class="btn btn-lg btn-info" type="button" id="btnUpdate" onclick="updateProfileDoctor()"><i class="glyphicon glyphicon-ok-sign"></i> Update Profile</button>
            <button class="btn btn-lg btn-warning d-none" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
          </div>
        </div>
      </form>
      
      </div><!--/tab-pane-->
      <div class="tab-pane" id="security">
        
        <h2></h2>
        <form class="form">
          <div class="form-group">
            <p class="line-break"></p>
            <div class="col-xs-6">
              <h6>Paynow Details [email Address] <code>Required</code></h6>
            </div>
            <div class="col-xs-6">
              <input class="form-control" type="email" id="emailpaypaynow" name="emailpaypaynow" placeholder="Paynow Details">
            </div>
          </div>
          <div class="form-group">
            
            <div class="col-xs-6">
              <label for="phone_verify"><h6>Phone Number:</h6></label>
              <input type="text" class="form-control" id="phone_verify" placeholder="Phone Number"
              title="This is number is used to send the Verfication code ">
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
                        <div class="row">
                          <div class="col-md-12"> <input type="submit" value="Save Changes" class="btn btn-info"> </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>




        </form>
        </div><!--/tab-pane-->
        <div class="tab-pane" id="social">
          
          <h2></h2>
        <form class="form"></form>
          <p class="line-break">Please provide your social meadia accounts to make it easier for patients to connect with you.</p>
        

        
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="facebook"><h4>State Your Price Per Appointment:</h4></label>
            <input type="text" class="form-control" id="appointPrice" placeholder="Price Per Appointment">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="facebook"><h4>Facebook:</h4></label>
            <input type="text" class="form-control" id="facebook" placeholder="Your Facebook username">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="youtube"><h4>Youtube Channel:</h4></label>
            <input type="text" class="form-control" id="youtube" placeholder="Youtube Channel">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-6">
            <label for="skype"><h4>Skype:</h4></label>
            <input type="text" class="form-control" id="skype" placeholder="Your Skype username">
          </div>
        </div>
         <div class="form-group">
          <div class="col-xs-6">
            <label for="twitter"><h4>Twitter:</h4></label>
            <input type="text" class="form-control" id="twitter" placeholder="Your twitter username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-6">
            <label for="instagram"><h4>Instagram:</h4></label>
            <input type="text" class="form-control" id="instagram" placeholder="Your instagram username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-6">
            <label for="twitter"><h4>Viber:</h4></label>
            <input type="text" class="form-control" id="viber" placeholder="Your Viber username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-6">
            <label for="twitter"><h4>Date Avaailable:</h4></label>
            <input type="text" class="form-control" name="dateAvailable[]" id="dateAvaiblabl" placeholder="Date Avaailable">
          </div>
        </div>
         <div class="form-group">
          <div class="col-xs-6">
            <label for="twitter"><h4>Time Avaailable:</h4></label>
            <input type="text" class="form-control" name="timAvailable[]" id="timeavailabe" placeholder="Time Avaailable">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <br>
            <button class="btn btn-lg btn-info" type="button" onclick="updateSocilMedia()"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
            <button class="btn btn-lg btn-warning d-none" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
          </div>
        </div>
      </form>
      </div><!--/tab-pane-->
      </div><!--/tab-pane-->
      </div><!--/tab-content-->
      </div><!--/col-9-->
      </div><!--/row-->
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
    
    <!-- JavaScript files-->
    </script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="../lib/js/charts-home.js"></script>
    <script src="../lib/js/front.js"></script>
    <script src="../js/controllers/doctor.js"></script>

    <script type="text/javascript">
      

      function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#avatar1').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#myavatar").change(function() {
      readURL(this);
    });
    </script>
  </body>
</html>
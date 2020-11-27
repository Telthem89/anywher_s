<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['pharmacy_id'])) { Redirect::to('../login/login.php');}
// elseif (isset($_SESSION['adminstatus'])) {
//      $status=$_SESSION['adminstatus'];
//      if ($status =='Pending' || $status =='Rejected' ) {
//          Redirect::to('../login/verification.php');
//          unset($_SESSION['doctor_id']);
//          session_destroy();
//      }}
      ?>
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
  </head>
  <!-- <body onload="LoadPharmacistFromLocalStorage_home()"> -->
  <body onload="LoadPharmacistFromLocalStorage_home(),loadPharmacistprofile()">
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
    
    <li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="../img/avatar-6.jpg" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1"></a>
    <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname"></strong><small id="speciality"></small></a>
    <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Profile</a><a href="doc-log.php" class="dropdown-item">Activity log       </a>
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
<li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
<li class="sidebar-list-item"><a href="category.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Categories</span></a></li>
<li class="sidebar-list-item"><a href="supplier.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Suppliers</span></a></li>
<li class="sidebar-list-item"><a href="medicine.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Inventory</span></a></li>
 <li class="sidebar-list-item"><a href="pharm-profile.php" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
 <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Orders</span></a></li>
 <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Expired Medicines</span></a></li>
  <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
</ul>
</div>
<div class="container">
<div class="row">
  <div class="col-sm-12 heading1"><h1>Edit Profile</h1></div>
</div>
<div class="row">
  <div class="col-sm-3"><!--left col-->
  <div class="text-center">
    <img src="../img/avatar.png" class="avatar img-circle img-thumbnail" alt="avatar" id="avatar">
    <h6>Upload a different photo...</h6>
    <form enctype="multipart/form-data" method="post">
      <input type="file" class="text-center center-block file-upload" id="myavatar">
      <p><br></p>
      <button class="btn btn-success" type="button" onclick="UpdatePharmacistProfilePicture()">Upload Picture</button>
    </form>
    <h4 class="username d-none" id="fname">Sudo User</h4>
    <p class="text-muted d-none" id="speciality">Heart Specialist</p>
    <p class="text-muted d-none" id="zma">ZIMA 86546435RF</p>
    <p class="text-muted d-none" id="joinedga">Joined on 01/08/2020</p>
  </div><hr><br>
  </div><!--/left column-->
  <div class="col-sm-9"><!--right col-->
  <ul class="nav nav-tabs">
    <li class="active tab-list"><a data-toggle="tab" href="#personalDetails">Personal Details</a></li>
    <li class="tab-list d-none"><a data-toggle="tab" href="#security">Security</a></li>
    <li class="tab-list"><a data-toggle="tab" href="#social">Social Media</a></li>
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
        <div class="form-group d-none">
          
          <div class="col-xs-6">
            <label for="dob"><h4>D.O.B</h4></label>
            <input type="text" class="form-control" id="dob" placeholder="Date of Birth" title="Date of Birth">
          </div>
        </div>
        <div class="form-group d-none">
          
          <div class="col-xs-6">
            <label for="bio"><h4>About(Mini-Biography)</h4></label>
            <input type="text" class="form-control" name="bio" id="bio" placeholder="  write about yourself">
          </div>
        </div>
        <div class="form-group d-none">
          
          <div class="col-xs-6">
            <label for="gender"><h4>Gender</h4></label>
            <input type="text" class="form-control" id="gender" placeholder="Gender">
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="qualification"><h4>Qualification</h4></label>
            <input type="text" class="form-control" id="qualification" placeholder="Qualification">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <br>
            <button class="btn btn-lg btn-info" type="button" onclick="UpdatePharmacistProfile()"><i class="glyphicon glyphicon-ok-sign"></i> Update Profile</button>
            <button class="btn btn-lg btn-warning d-none" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
          </div>
        </div>
      </form>
      
      </div><!--/tab-pane-->
      <div class="tab-pane d-none" id="security">
        
        <h2></h2>
        <form class="form">
          <div class="form-group">
            <p class="line-break"></p>
            <div class="col-xs-6">
              <h6>Enable Two factor Authentication?</h6>
            </div>
            <div class="col-xs-6">
              <label for="yesQuestion2fa">Yes</label>
              <input class="radio" type="radio" id="yesQuestion2fa" name="2fa" value="Yes">
              <label for="noQuestion2fa">No</label>
              <input class="radio" type="radio" id="noQuestion2fa" name="2fa" value="No">
            </div>
          </div>
          <div class="form-group">
            
            <div class="col-xs-6">
              <label for="phone_verify"><h6>Verfication Phone Number:</h6></label>
              <input type="text" class="form-control" id="phone_verify" placeholder="Enter the number where verification codes are sent"
              title="This is number is used to send the Verfication code ">
            </div>
          </div>
          <div class="form-group">
            <p class="line-break"></p>
            <div class="col-xs-6">
              <h6>Enable Security Question?</h6>
            </div>
            <div class="col-xs-6">
              <label for="yesQuestion">Yes</label>
              <input class="radio" type="radio" id="yesQuestion" name="secQuestion" value="Yes">
              <label for="noQuestion">No</label>
              <input class="radio" type="radio" id="noQuestion" name="secQuestion" value="No">
            </div>
          </div>
          <div class="form-group">
            
            <div class="col-xs-6">
              <label for="secQuestion"><h4>Security Question:</h4></label>
              <input type="text" class="form-control" id="secQuestion" placeholder="Create a security qusetion"
              title="This is used when you lose your password">
            </div>
          </div>
          <div class="form-group">
            
            <div class="col-xs-6">
              <label for="secAnswer"><h4>Security Question Answer:</h4></label>
              <input type="text" class="form-control" id="secAnswer" placeholder="Enter the answer to your security question"
              title="This is used when you lose your password">
            </div>
          </div>
          <div class="form-group">
            
            <div class="col-xs-6">
              <label for="password"><h4>Change Password</h4></label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password"
              title="enter your password.">
            </div>
          </div>
          <div class="form-group">
            
            <div class="col-xs-6">
              <label for="password2"><h4>Verify</h4></label>
              <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password"
              title="re-enter your password.">
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <br>
              <button class="btn btn-lg btn-info" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
              <button class="btn btn-lg btn-warning" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
            </div>
          </div>
        </form>
        </div><!--/tab-pane-->
        <div class="tab-pane" id="social">
          
          <h2></h2>
        <form class="form"></form>
          <p class="line-break">Please provide your social meadia accounts to make it easier for patients to connect with you.</p>
        

        
        <div class="form-group d-none">
          
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
          <div class="col-xs-12">
            <br>
            <button class="btn btn-lg btn-info" type="button" onclick="updatePharmacistSocialDetails()"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
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
    <script src="../js/lib/charts-home.js"></script>
    <script src="../js/lib/front.js"></script>
     <script src="../js/controllers/PharmacistController.js"></script>
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

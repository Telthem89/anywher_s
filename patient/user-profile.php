<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['patient_id'])) { Redirect::to('../login/login.php');} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anywhere Dashboard-edit profile</title>
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
  <body onload="loadprofile(),getMedicalHistoryById()" id="body">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="index.php" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">
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
     
    <li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="" alt="" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1"></a>
    <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname"></strong></a>
    <div class="dropdown-divider"></div><a href="user-profile.php" class="dropdown-item">Profile</a>
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
    <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted "><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Your Appointments</span></a></li>
    <li class="sidebar-list-item"><a href="doctors.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
    <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
    <li class="sidebar-list-item"><a href="shop.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Pharmacies</span></a></li>
    <li class="sidebar-list-item"><a href="myOrder.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Orders</span></a></li>
  </ul>
</div>
<div class="container">
<div class="row">
<div class="col-sm-12 heading1"><h1>My Profile</h1></div>
<div class="alert alert-success text-center" role="alert" id="success" style="display: none;"></div>
<div class="alert alert-success text-center" role="alert" id="alert" style="display: none;"></div>
</div>
<div class="row">
 
<div class="col-sm-3"><!--left col-->
<div class="text-center">
  <img src="../img/avatar-6.jpg" class="avatar img-circle img-thumbnail" alt="avatar" id="avatar">
  <h6>Update Your Profile Picture</h6>
  <form enctype="multipart/form-data" method="post">
    <div class="me" style="border: 4px dashed #1FB264;">
      <label class=""><i class="fa fa-camera fa-4x mt-3"></i>
    <input type="file" class="text-center center-block file-upload" id="useravatar" style="display: none"><br>
    Click icon to upload 
  </label>
</div>
    <p><br></p>
  <button class="btn btn-success" onclick="updateProfilePic()" type="button">Update Picture <i class="fa fa-camera"></i></button>
  </form>
  <h4 class="username d-none" id="fname"></h4>
  <p class="text-muted d-none" id="datejoined"></p>
</div><hr><br>
</div><!--/left column-->
<div class="col-sm-9"><!--right col-->
<ul class="nav nav-tabs">
  <li class="active tab-list"><a data-toggle="tab" href="#personalDetails"><i class="fa fa-user-md"></i> Personal Details</a></li>
  <li class="tab-list"><a data-toggle="tab" href="#security"><i class="fa fa-briefcase-medical"></i> Medical History</a></li>
  <li class="tab-list"><a data-toggle="tab" href="#history"><i class="fa fa-briefcase-medical"></i> View Medical History</a></li>
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
      <div class="form-group ">
        
        <div class="col-xs-6">
          <label for="nationality"><h4>Date of Birth</h4></label>
          <input type="date" class="form-control" id="dob" placeholder="e.g Date of Birth" title="dob">
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-6">
          <label for="city"><h4>Password [Optional]</h4></label>
          <input type="text" class="form-control" id="password" placeholder="e.g Password" title="Password">
        </div>
      </div>
      <div class="form-group">
        
        <div class="col-xs-6">
          <label for="address"><h4>Address</h4></label>
          <input type="text" class="form-control" id="address" placeholder="e.g 21 Gaka Road, Seke" title="enter your address">
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
        <div class="col-xs-12">
          <br>
          <button class="btn btn-lg btn-info" type="button" id="btnUpdateMyProfile" onclick="updateMyProfile()"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
          <button class="btn btn-lg btn-warning d-none" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
        </div>
      </div>
    </form>
    
    </div><!--/tab-pane-->
    <div class="tab-pane" id="security">
      
      <h2></h2>
      <form class="form" enctype="multipart/form-data">
        <div class="form-group">
          
          <div class="col-xs-6 mt-2">
            <label for="phone_verify"><h6>Drug Name:</h6></label>
            <input type="text" class="form-control" id="drugs" placeholder="Enter Drug Name"
            id="drug">
          </div>
        </div>
        <div class="form-group d-none">
          
          <div class="col-xs-6">
            <label for="secQuestion"><h4>Gender</h4></label>
            <select class="form-control" id="gender" name="gender" required="required">
              <option value=" " disabled selected>Gender</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
        </div>
        <div class="form-group d-none">
          
          <div class="col-xs-6">
            <label for="myaddress"><h4>Physical Address:</h4></label>
            <input type="text" class="form-control" id="myaddress" placeholder="Physical Address" autofocus>
          </div>
        </div>
        
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="allegicMedication"><h4>Tell Us if you are allegic</h4></label>
            <input type="text" class="form-control"  id="allegicMedication" placeholder="Tell Us if you are allegic" autofocus>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-6">
            <label for="otherdeases"><h4>Other Deseases:</h4></label>
            <input type="text" class="form-control" id="otherdeases"  placeholder="Other Deseases" autofocus>
          </div>
        </div>
        <div class="form-group">
          
          <div class="col-xs-6">
            <label for="med_doc"><h4>Upload Medical documents</h4></label>
            <input type="file" class="form-control"  id="med_doc" accept=".docx,.pptx,.jpeg,.png,.pdf">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <br>
            <button class="btn btn-lg btn-info" type="button" onclick="$('#logging_in').modal('show'),addMedicalHistory()" id="mybtn"><i class="fa fa-ok-sign"></i> Update Profile</button>
            
          </div>
        </div>
      </form>
      </div><!--/tab-pane-->
      <!--history tab-pane-->
      <div class="tab-pane pl-2" id="history">
        
        <div class="p-4" id="medicalhistoryContainer">
          
        </div>
      </div>
      <!--/end history tab-pane-->
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
    <script src="../js/controllers/patient.js"></script>
    <script src="https://kit.fontawesome.com/a2ca073996.js" crossorigin="anonymous"></script>


    <script type="text/javascript">
      

      function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#avatar').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#useravatar").change(function() {
      readURL(this);
    });
    </script>
  </body>
</html>
<div id="logging_in" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary y-jumbo">
        <h4 class="modal-title  text-light">Updating Your Medical History</h4>
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
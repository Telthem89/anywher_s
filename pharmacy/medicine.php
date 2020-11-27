<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['pharmacy_id'])) { Redirect::to('../login/login.php');}
// elseif (isset($_SESSION['adminstatus'])) {
//      $status=$_SESSION['adminstatus'];
//      // if ($status =='Pending' || $status =='Rejected' ) {
//      //     Redirect::to('../login/verification.php');
//      //     unset($_SESSION['doctor_id']);
//      //     session_destroy();
//      // }}

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Anywhere dashboard:Medicines</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="no-index">
        
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
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
       
    </head>
    <body onload="LoadPharmacistFromLocalStorage_home(),GetAllMedicines(),GetAllMediCategory(),getMedSupplier()">
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
<li class="sidebar-list-item"><a href="medicine.php" class="sidebar-link text-muted active"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Inventory</span></a></li>
 <li class="sidebar-list-item"><a href="pharm-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
 <li class="sidebar-list-item"><a href="myorder.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Orders</span></a></li>
 <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Expired Medicines</span></a></li>
  <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
</ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
<div class="container">
     <div class="error p-4 mt-3 bg-danger text-center text-light rounded" id="alert" role="alert" style="display: none;"></div>
    <div class="alert alert-success mt-3 p-4 text-center" role="alert" id="success" style="display: none;"></div>
<h2 class="heading1 text-xl-center mb-4">Medicine Panel</h2>
<p class="lead heading2 text-xl-center">
    <button class="btn-primary btn-lg" onclick="$('#modalprimary').modal('show'),event.preventDefault()">Medicine Entry</button>
</p>
<hr class="line-break" />

<div class="agenda">
    <div class="table-responsive">
        <table class="table table-condensed table-bordered" id="myTable">
            <thead>
                <tr>
                    <th class="text-center">serialNumber</th>
                    <th>Imageurl</th>
                    <th>Drug Name</th>
                    <th>quantity</th>
                    <th>usage</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Expiry Date</th>
                    <th class="text-center">Action</th>
                </tr>
                <tbody id="myMedicine">
                    
                </tbody>
                <div class="text-center" id="info"></div>
            </table>
        </div>
    </div>
</div>
<footer id="footer" class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-center text-md-left text-primary">
                <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
            </div>
            <div class="col-md-6 text-center text-md-right text-gray-400">
                <p class="mb-0 ">Design by <a href="#" class="external text-gray-400">Sagehill Team</a></p>
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
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="../js/lib/front.js"></script>
<script src="../js/controllers/PharmacistController.js"></script>
</body>
</html>

<div class="modal fade" id="modalprimary">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #004085 !important; ">
                    <h4 style="color:#fff;" class="text-center" id="ctname">Add Medicine</h4>
                </div>
                <div class="modal-body">
                    <form id="formReset">
                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Drug Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Drug Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Quantity</label>
                                    <input type="number" id="quantity" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Drug Usage</label>
                                    <input type="text" id="usage" class="form-control" placeholder="Drug Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Drug Side Effects</label>
                                    <input type="text" id="sideeffect" class="form-control" placeholder="Drug Side Effects">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Drug Precautions</label>
                                    <input type="text" id="precautions" class="form-control" placeholder="Drug Precautions">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Drug Interation</label>
                                    <input type="text" id="interation" class="form-control" placeholder="Drug Interation">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Overdose [Optional]</label>
                                    <input type="text" id="overdose" class="form-control" placeholder="Drug Precautions">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Upload Drug Image</label>
                                    <input type="file" id="imageurl" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Select Supplier</label>
                                    <select id="supplierId" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label for="title">Select Category</label>
                                    <select id="catID" class="form-control">
                                      
                                    </select>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="title">Expiry Date</label>
                            <input type="date" id="expiry_date" class="form-control">
                        </div>
                    
                        <input type="hidden" id="mid">
                        <input type="hidden" id="caid">
                        <input type="hidden" id="supid">
                        <button class="btn btn-success btn-block" onclick="AddMedicine(),event.preventDefault()"  type="button" id="btnAddMedicine"> Add Medicine</button>
                        <button class="btn btn-info btn-block" onclick="UpdateMedicineDetails(),event.preventDefault()"  type="button" id="btnUpdateMedicine" style="display: none;"> Update Medicine</button>
                    </form>

        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['pharmacy_id'])) { Redirect::to('../login/login.php');}
$drug = new Drugs();
$orders = $drug->getallMyOrdersForPharmacy($_SESSION['pharmacy_id']);
// $carts=$drug->getallMyCart($_SESSION['patient_id']);
$i =0;
$code ='PH-00';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anywhere My Orders</title>
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
    <!-- Custom stylesheet - for your changes-->
    <!-- <link rel="stylesheet" href="../css/custom.css"> -->
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/favicon.png?3">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/php5shiv/3.7.3/php5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
   <body onload="homedocdetail()">
    <!-- navbar-->
   <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">         <img src="../img/ustawi_logo.png" style="border-radius: 0%;"></a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
                
               
               <li class="nav-item dropdown ml-auto"><a id="userInfo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                   <img src="../webservices/uploads/avatar/avatar.png" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow" id="avatar1">
               </a>
                <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family" id="flname">Sudo User</strong></a>
                <div class="dropdown-divider"></div><a href="user-profile.php" class="dropdown-item">My Profile</a><a href="#" class="dropdown-item">Activity log</a>
                <div class="dropdown-divider"></div><a  class="dropdown-item" onclick="Logout()">Logout</a>
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
<li class="sidebar-list-item"><a href="category.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Categories</span></a></li>
<li class="sidebar-list-item"><a href="supplier.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Suppliers</span></a></li>
<li class="sidebar-list-item"><a href="medicine.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Inventory</span></a></li>
 <li class="sidebar-list-item"><a href="pharm-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
 <li class="sidebar-list-item"><a href="myorder.php" class="sidebar-link text-muted active"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Manage Orders</span></a></li>
 <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Expired Medicines</span></a></li>
  <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Activity Log</span></a></li>
</ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
    <section class="py-5">
    
    <div class="alert alert-danger text-center" role="alert" id="alert" style="display: none;"></div>
     <div class="alert alert-success text-center" role="alert" id="success" style="display: none;"> </div>
     <div id="succ_message" class="text-center mb-lg-1">
        <?php $sess = new Session(); echo $sess->successMessage(); ?>
      </div>
      <div id="err_message" class="text-center mb-lg-1">
        <?php $sess = new Session(); echo $sess->errorMessage(); ?>
      </div>
      <div class="card">
        <div class="card-header rounded-0"><h4 class="">My Orders</h4></div>
        <div class="card-body">
          <table class="table table-bordered" id="myTable">
            <thead>
              <tr>
                <th class="text-center">[Ref#]</th>
                <th class="text-center">Client Name</th>
                <th class="text-center">Total Amount</th>
                <th class="text-center">Order Status</th>
                <th class="text-center">Date Ordered</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $order): $i++;?>
                <tr>
                <td class="text-center"><?php echo $code.$i; ?></td>
                <td class="text-center"><?php echo $order['pharmName'] ?></td>
                <td class="text-center"><?php echo $order['total'] ?></td>
                <td class="text-center"><?php echo $order['status'] ?></td>
                <td class="text-center"><?php echo $order['dateorder'] ?></td>
                <td class="text-center"><a href="#" class="btn btn-success rounded-0 btn-sm" onclick="event.preventDefault(),viewMyOrder(<?php echo $order['client_id'] ?>),$('#modalOrder').modal('show')">Accept Order</a> | <a href="#" class="btn btn-info rounded-0 btn-sm" onclick="event.preventDefault(),viewMyOrder(<?php echo $order['client_id'] ?>),$('#modalOrder').modal('show')">View Orders</a></td>
              </tr>
              <?php endforeach ?>
              
            </tbody>
          </table>
        </div>
      </div> <!-- card.// -->
  
          </div>
          <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 text-center text-md-left text-primary">
                  <p class="mb-2 mb-md-0">Sagehill Business Solutions &copy; 2020</p>
                </div>
                <div class="col-md-6 text-center text-md-right text-gray-400">
                  <p class="mb-0">Design by <a href="#" class="external text-gray-400" id="fname"></a></p>
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
      <script src="../vendor/chart.js/Chart.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
     <script src="../js/lib/charts-home.js"></script>
      <script src="../js/lib/front.js"></script> -->
      <script src="../js/controllers/patient.js"></script>
      <!-- <script src="../js/controllers/userdashController.js"></script> -->
      <script src="../js/lib/jquery.dataTables.min.js"> </script>
      <script>
        $('#myTable').DataTable( {
            fixedHeader: true
        } );
    </script>
    </body>
  </html>


  <div class="modal fade" id="modalOrder">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">My Medication Order</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
        </div>
        <div class="modal-body">
           <table class="table table-inverse">
                          <thead>
                            <tr>
                              <th>[Ref#]</th>
                              <th>Drug Name</th>
                              <th>Price</th>
                              <th>Qnty</th>
                              <th>Totals</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($carts<0): ?>
                              <td colspan="4">no data</td>
                              <?php else: ?>
                              <?php foreach ($carts as $cart): $i++; ?>
                                <?php $qnty = $drug->getQuantity($cart['drug_id']);

                                 ?>
                              <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $cart['name']; ?></td>
                              <input type="hidden" id="ppid" value="<?php echo $cart['pid']; ?>">
                              <input type="hidden" id="client_id" value="<?php echo $cart['client_id']; ?>">
                              <td><?php echo $cart['price']; ?></td>
                              <td><?php echo $cart['quantity']; ?></td>
                              <td><?php echo $cart['total']; ?></td>
                              
                            </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                            
                          </tbody>
                        </table>
        </div>
        <div class="modal-footer">
          Anywhere Healthcare 
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

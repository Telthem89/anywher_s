<?php 
require '../webservices/autoloader.php'; 
if (!isset($_SESSION['patient_id'])) { Redirect::to('../login/login.php');} 
$drug = new Drugs();
$drugs = $drug->getallDrugs();
// echo json_encode($drugs,true);

$carts=$drug->getallMyCart($_SESSION['patient_id']);
$cartTotal=$drug->getTotals($_SESSION['patient_id']);
$i=0;


?>
<?php 
if (isset($_POST['btnAddTocart']))
{
  $drug_id                = htmlentities(trim($_POST['drug_id']));
  $client_id              = htmlentities(trim($_POST['client_id']));
  $quantity               = htmlentities(trim($_POST['quantity']));
  $pid                    = htmlentities(trim($_POST['pid']));
  $price                  = htmlentities(trim($_POST['price']));
  $updateDrugQuantity     = htmlentities(trim($_POST['medQuantity']));


    if (empty($quantity)){
         $_SESSION['err_message'] ="Please quantity is required";
    }

  else{
    $response= $drug->addTocart($drug_id,$client_id,$quantity,$pid,$price,$updateDrugQuantity);
    if($response == true){
      $_SESSION['succ_message'] ="Added";
      }
        else{
           $_SESSION['err_message'] ="Not saved";
          
        }
  }
}




 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anywhere Pharmacy</title>
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
                
                <li class="nav-item dropdown mr-3"><a id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1">My Cart <i class="fa fa-shopping-cart"></i> <span class="notification-icon"></span></a>
                <div aria-labelledby="notifications" class="dropdown-menu"><a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <table class="table table-inverse">
                          <thead>
                            <tr>
                              <th>[Ref#]</th>
                              <th>Drug Name</th>
                              <th>Price</th>
                              <th>Qnty</th>
                              <th>Remov</th>
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
                              <td><a href="#" onclick="event.preventDefault(),RemoveCart(<?php echo $cart['id']; ?>,<?php echo $cart['quantity']; ?>,<?php echo $qnty['quantity']; ?>,<?php echo $cart['drug_id']; ?>)">X</a></td>
                            </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                            
                          </tbody>
                        </table>

                        
                    </div>
                    <div class="row justify-content-end">
                          <div class="col-md-8 ">
                            <h6 class="text-success">Grand Total <span class="float-right">
                              <?php foreach ($cartTotal as $cartT): ?>
                                <b class="text-success"><?php echo "USD$".$cartT['totalA']; ?></b>
                                <input type="hidden" id="total" value="<?php echo $cartT['totalA']; ?>">
                              <?php endforeach ?>
                            </span></h6>
                          </div>
                        </div>

                        <a href="#" class="btn btn-block btn-danger rounded-0" onclick="event.preventDefault(),checkOut()">Checkout</a>

                  </a>
                </li>
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
    <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
    <li class="sidebar-list-item"><a href="calender.php" class="sidebar-link text-muted"><i class="o-medical-chart-1 mr-3 text-gray"></i><span>Your Appointments</span></a></li>
    <li class="sidebar-list-item"><a href="doctors.php" class="sidebar-link text-muted"><i class="o-user-details-1 mr-3 text-gray"></i><span>Schedule<br>Appointment</span></a></li>
    <li class="sidebar-list-item"><a href="user-profile.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Profile</span></a></li>
    <li class="sidebar-list-item "><a href="shop.php" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>Pharmacies</span></a></li>
    <li class="sidebar-list-item"><a href="myOrder.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>My Orders</span></a></li>
  </ul>
</div>
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
    <section class="py-5">
    <h4 class="text-center heading1">Pharmacy</h4>
    <div class="alert alert-danger text-center" role="alert" id="alert" style="display: none;"></div>
     <div class="alert alert-success text-center" role="alert" id="success" style="display: none;"> </div>
     <div id="succ_message" class="text-center mb-lg-1">
        <?php $sess = new Session(); echo $sess->successMessage(); ?>
      </div>
      <div id="err_message" class="text-center mb-lg-1">
        <?php $sess = new Session(); echo $sess->errorMessage(); ?>
      </div>
      <div class="card p-3">
        <table class="table table-hover shopping-cart-wrap" id="myTable">
          <thead class="text-muted">
            <tr>
              <th scope="col">Product</th>
              <th scope="col" width="120">Quantity</th>
              <th scope="col" width="120">Price</th>
              <th scope="col" width="200" class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($drugs as $drug):  ?> 
              <tr>
              <td>
            <figure class="media">
              <!-- ../..././../webservices/uploads/drugs/MTYwMjM2MzQzODQ5NjM=.jpg -->
              <div class="img-wrap"><img src="./.././webservices/webservices/<?php echo $drug['imageurl']; ?>" class="img-thumbnail img-sm"></div>
              <figcaption class="media-body">
                <h6 class="title text-truncate"><?php echo $drug['name']; ?></h6>
                <dl class="param param-inline small">
                  <dt>Quantity: <?php echo $drug['quantity']; ?>
                  <input type="hidden" name="stockValue" value="<?php echo $drug['quantity'] ?>">
                    
                  </dt>

                </dl>
                <dl class="param param-inline small">
                  <dt>Pharmacy:</dt>
                  <dd> <a href="" onclick="listAlldrugsBelongsToPharmacy(<?php echo $drug['pid']; ?>)"><?php echo $drug['fullname']; ?></a></dd>
                </dl>
              </figcaption>
            </figure> 
              </td>
              <form method="Post" >
              <td> 
                <input type="number" class="form-control" id="quantity" name="quantity" >
              </td>
              <td> 
                <div class="price-wrap"> 
                  <b class="price mt-lg-2" style="font-size: 14px!important">USD <?php echo $drug['price']; ?></b> 
                </div> <!-- price-wrap .// -->
              </td>
              <td class="text-right"> 
              
                <input type="hidden" name="drug_id" id="drug_id" value="<?php echo $drug['id']; ?>">
                <input type="hidden" name="client_id" id="client_id" value="<?php echo $_SESSION['patient_id']; ?>">
                <input type="hidden" name="pid" id="pid" value="<?php echo $drug['pid']; ?>">
                <input type="hidden" name="price" id="price" value="<?php echo $drug['price']; ?>">
                <input type="hidden" name="medQuantity" id="medQuantity" value="<?php echo $drug['quantity']; ?>">
                <button type ="submit" class="btn btn-outline-danger" name="btnAddTocart" id="btnAddTocart"> + Cart</button>
              </form>
              </td>
            </tr>
            <?php endforeach ?> 
            </tbody>
            </table>
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
      <script src="../vendor/chart.js/Chart.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
      <script src="../js/lib/charts-home.js"></script>
      <script src="../js/lib/front.js"></script> -->
      <script src="../js/controllers/patient.js"></script>
      <script src="../js/lib/jquery.dataTables.min.js"> </script>
      <script>
        $('#myTable').DataTable( {
            fixedHeader: true
        } );
    </script>
      <!-- <script src="../js/controllers/userdashController.js"></script> -->
    </body>
  </html>

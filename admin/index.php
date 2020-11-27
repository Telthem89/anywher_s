<?php 
     require '../webservices/autoloader.php'; 
    if (isset($_SESSION['admin_id'])) { Redirect::to('Dashboard.php');}
 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Anywhere Administrator</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <!--NAV MENU-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="../index.php" class="navbar-brand"><b>Anywhere</b></a>
            
            <!--mobile menu button-->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
            </button>
            
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav ml-auto">
                    
                    <div class="nav-item">
                        
                        <a href="#" class="nav-item"><i class="fa fa-support"></i> Support</a>
                        &emsp;&emsp;&emsp;
                    </div>
                </div>
            </div>
        </nav>
        <!--LOGIN FORM-->
    </div>
    <div class="login-form">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="alert alert-danger" role="alert" id="alert" style="display: none;"></div>
                   <h3 class="text-center">Administrator</h3>
                    <p><br></p>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="required" id="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required" id="password">
                        </div>
                    </div>
                    <div class="form-group text-center justify-content-center">
                        <button type="button" class="btn btn-primary login-btn" onclick="admin_login()">Sign in</button>
                    </div>
                    <p class="spacing-agent"> </p>
                    <div class="clearfix">
                        <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                        <a href="#" class="float-right">Forgot Password?</a>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small pt-4">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 footer-styling">Copyright:
            <a href="https://sagehilltechnologies.com/"> Sagehill Business Solutions 2020©</a>
        </div>
        <!-- Copyright -->
        
    </footer>
    <script src="../js/lib/jquery-3.5.1.min.js"></script>
    <script src="../js/lib/popper.min.js"></script>
    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/controllers/Administration.js"></script>
</body>
</html>
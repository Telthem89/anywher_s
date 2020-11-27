<?php
class Session
{
	// private $signed_in = false;
	// public $user_id;
	// public $fullname;
	// function __construct()
	// {
	// 	session_start();
	// 	$this->check_the_login();
	// }
	// private function check_the_login()
	// {
	// 	if (isset($_SESSION['user_id'])) {
	// 		$this->user_id=$_SESSION['user_id'];
	// 		$this->signed_in=true;
	// 	}
	// 	else{
	// 		unset($this->user_id);
	// 		$this->signed_in=false;
	// 	}
	// }
	// public function is_signed_in()
	// {
	// 	return $this->signed_in;
	// }
	// public function signinapp($user_app)
	// {
	// 	if ($user_app) {
	// 		$this->user_id=$_SESSION['user_id']=$user_app->id;
	// 	    $this->signed_in=true;
	// 	}
	// }
 //    public function logout()
 //    {
 //        unset($this->user_id);
 //        unset($_SESSION['user_id']);
 //        $this->signed_in = false;
 //        session_destroy();
 //    }


      function errorMessage()
    {
       
      if (isset($_SESSION['err_message'])) {
        $output = '<div class="alert alert-danger text-center alert-dismissible" role="alert">
                    <strong>Error Message!</strong>';
        $output  .= $_SESSION['err_message'];  
        $output  .= '<i class="fa fa-flag"></i>
                    <span class="close" data-dismiss="alert">&times;</span>
                    </div>';
         $_SESSION['err_message'] = null;
         return $output;                  
      }
    }

 function successMessage()
    {
      if (isset( $_SESSION['succ_message'])) {

        $output = '<div class="alert alert-success text-center alert-dismissible" role="alert">
                    <strong>success Message!</strong>';
        $output  .= $_SESSION['succ_message'];  
        $output  .= '<i class="fa fa-flag"></i>
                    <span class="close" data-dismiss="alert">&times;</span>
                    </div>';
         $_SESSION['succ_message'] = null;
         return $output; 
      }
}
}
// $sessionapp = new Session();

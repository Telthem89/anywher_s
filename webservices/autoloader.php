<?php 

    /**
     * Display a listing of the classes
     *
     * you will include this file in every you will create
     */ 

   	/*this function will start the session*/

  session_start();
 

  require 'src/Exception.php';
  require 'src/PHPMailer.php';
  require 'src/SMTP.php';
   
	spl_autoload_register(function($class) {
     
	    require_once 'classes/' . $class . '.php';
	});

 ?>
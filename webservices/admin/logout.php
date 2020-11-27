<?php
require '../autoloader.php'; 
$administrator = new Administrator();
$id = $_GET['id'];
$logout = $administrator->logout($id);
  

  if ($logout) {
  	echo "logout";
  }else{
  	echo "error";
  }
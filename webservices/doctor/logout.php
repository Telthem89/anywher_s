<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

require '../autoloader.php';

$doctor = new Doctor();
$id = $_GET['id'];
$logout = $doctor->logout($id);
  
  if ($logout) {
  	echo "logout";
  }else{
  	echo "error";
  }
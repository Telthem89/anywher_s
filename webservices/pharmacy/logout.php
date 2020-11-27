<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

require '../autoloader.php';

$pharmacy = new Pharmacy();
$id = $_GET['id'];
$logout = $pharmacy->logout($id);
  
  if ($logout) {
  	echo "logout";
  }else{
  	echo "error";
  }
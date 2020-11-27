<?php
require '../autoloader.php'; 
$client = new Patient();
$id = $_GET['id'];
$logout = $client->logout($id);
  

  if ($logout) {
  	echo "logout";
  }else{
  	echo "error";
  }
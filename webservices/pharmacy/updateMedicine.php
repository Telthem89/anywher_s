<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

require '../autoloader.php'; 
$pharmacy = new Pharmacy();


   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';



if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['usage']) && isset($_POST['sideeffect']) && isset($_POST['precautions']))
 {
 	


	  $mid                 =htmlentities(trim($_POST['id']));
	  // $serialNumber        =htmlentities(trim($_POST['serialNumber']));
    $name                =htmlentities(trim($_POST['name']));
    $quantity            =htmlentities(trim($_POST['quantity']));
    $usage               =htmlentities(trim($_POST['usage']));
    $sideeffect          =htmlentities(trim($_POST['sideeffect']));
    $precautions         =htmlentities(trim($_POST['precautions']));
    $interation          =htmlentities(trim($_POST['interation']));
    $overdose            =htmlentities(trim($_POST['overdose']));
    // $imageurl            =htmlentities(trim($_POST['imageurl']));
    $supplierId          =htmlentities(trim($_POST['supplierId']));
    $catID               =htmlentities(trim($_POST['catID']));
    // $manufacturer        =htmlentities(trim($_POST['manufacturer']));
    $expiry_date         =htmlentities(trim($_POST['expiry_date']));


	$response= $pharmacy->UpdateMedicineDetailsByID($name,$quantity,$usage,$sideeffect,$precautions,$interation,$overdose,$supplierId,$catID,$expiry_date,$mid);
	if ($response == true) {
             $final_reply['response'] = true;
		     $final_reply['data'] = "Updated";
             echo json_encode($final_reply);
	}
	else{
		     $final_reply['data'] = "Something went wrong!!";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
	}

 }

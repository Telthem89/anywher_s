<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

require '../autoloader.php'; 
$pharmacy = new Pharmacy();


   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';



if (isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['dob']) &&  isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['qualification']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['country']) && isset($_POST['city']))
 {
 	


	$phid =htmlentities(trim($_POST['id']));
  	$firstname =htmlentities(trim($_POST['firstname']));
	$lastname =htmlentities(trim($_POST['lastname']));
	$dob     =htmlentities(trim($_POST['dob']));
	$gender   =htmlentities(trim($_POST['gender']));
	$address =htmlentities(trim($_POST['address']));
	$qualification =htmlentities(trim($_POST['qualification']));
	$phoneNumber =htmlentities(trim($_POST['phoneNumber']));
    $emailAddress =htmlentities(trim($_POST['email']));
    $nationality =htmlentities(trim($_POST['country']));
	$city =htmlentities(trim($_POST['city']));




	// $facebook =htmlentities(trim($_POST['facebook']));
	// $youtube =htmlentities(trim($_POST['youtube']));
	// $skype =htmlentities(trim($_POST['skype']));
	// $twitter =htmlentities(trim($_POST['twitter']));
	// $instagram =htmlentities(trim($_POST['instagram']));
	// $viber =htmlentities(trim($_POST['viber']));


	$response= $pharmacy->updatePharmacyDetails($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$nationality,$city,$phid);
	if ($response == true) {
             $final_reply['response'] = true;
		     $final_reply['data'] = "Pharmacy account has been updated successfully";
             echo json_encode($final_reply);
	}
	else{
		     $final_reply['data'] = "Something went wrong!!";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
	}

 }

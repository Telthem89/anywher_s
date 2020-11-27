<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

require '../autoloader.php'; 


   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';



if (isset($_POST['id']) && isset($_POST['MDPCZ_ID']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address']) && isset($_POST['speciality']) &&  isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['bio']))
 {
 	


	$did            =htmlentities(trim($_POST['id']));
 	$MDPCZ_ID       =htmlentities(trim($_POST['MDPCZ_ID']));
  	$firstname      =htmlentities(trim($_POST['firstname']));
	$lastname       =htmlentities(trim($_POST['lastname']));
	$address        =htmlentities(trim($_POST['address']));
	$speciality     =htmlentities(trim($_POST['speciality']));
	$phoneNumber    =htmlentities(trim($_POST['phoneNumber']));
    $emailAddress   =htmlentities(trim($_POST['email']));
    $nationality    =htmlentities(trim($_POST['country']));
	$city           =htmlentities(trim($_POST['city']));
	$bio            =htmlentities(trim($_POST['bio']));
	$qualification  =htmlentities(trim($_POST['qualification']));
	$experience  =htmlentities(trim($_POST['experience']));
	$dob            =htmlentities(trim($_POST['dob']));
	$gender         =htmlentities(trim($_POST['gender']));






$doctor = new Doctor();
	$response= $doctor->updateDoctorDetails($MDPCZ_ID,$firstname,$lastname,$dob,$gender,$address,$qualification,$speciality,$experience,$phoneNumber,$emailAddress,$nationality,$city,$bio,$did);
	if ($response == true) {
             $final_reply['response'] = true;
		     $final_reply['data'] = "Doctor account has been updated successfully";
             echo json_encode($final_reply);
	}
	else{
		     $final_reply['data'] = "Something went wrong!!";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
	}

 }

<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

 require '../autoloader.php';
 $admin = new Administrator();

 $response = array();
 $final_reply['response'] = false;
 $final_reply['data'] = '';

if (isset($_POST['id']) &&  isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['email']))
 {
  
  
    $firstname =htmlentities(trim($_POST['firstname']));
    $lastname =htmlentities(trim($_POST['lastname']));
    $dob =$_POST['dob'];
    $gender =$_POST['gender'];
    $address =htmlentities(trim($_POST['address']));
    $qualification =htmlentities(trim($_POST['qualification']));
    $phoneNumber =htmlentities(trim($_POST['phoneNumber']));
    $emailAddress =htmlentities(trim($_POST['email']));
    $phid =htmlentities(trim($_POST['id']));

   $response    =$admin->adminUpdatePharmacyDetails($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$phid);
   if($response ==  true)
   {
      $final_reply['data']  ="Updated"; 
      $final_reply['response'] = true;
      echo json_encode($final_reply);
   }
   else{
      $final_reply['data'] = "Failed to update client account something went wrong";
      $final_reply['response'] = false;
      echo json_encode($final_reply);
   }
                
 }
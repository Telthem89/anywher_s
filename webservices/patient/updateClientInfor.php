<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

 require '../autoloader.php';
 $client = new Patient();

 $response = array();
 $final_reply['response'] = false;
 $final_reply['data'] = '';

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['password']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['id']))
 {

   $firstname   =htmlentities(trim($_POST['firstname']));
   $lastname    =htmlentities(trim($_POST['lastname']));
   $email       =htmlentities(trim($_POST['email']));
   $phoneNumber =htmlentities(trim($_POST['phoneNumber']));
   $password    =htmlentities(trim($_POST['password']));
   $gender      =htmlentities(trim($_POST['gender']));
   $address     =htmlentities(trim($_POST['address']));
   $dob     =htmlentities(trim($_POST['dob']));
   $id          =htmlentities(trim($_POST['id']));

   $response    =$client->updateClientinfo($firstname,$lastname,$email,$phoneNumber,$password,$gender,$dob,$address,$id);
   if($response ==  true)
   {
      $final_reply['data']  ="Client information Updated successfully"; 
      $final_reply['response'] = true;
      echo json_encode($final_reply);
   }
   else{
      $final_reply['data'] = "Failed to update client account something went wrong";
      $final_reply['response'] = false;
      echo json_encode($final_reply);
   }
                
 }
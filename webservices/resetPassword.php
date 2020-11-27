<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');



require 'autoloader.php'; 
$doctor       = new Doctor();
$client       = new Patient();
$pharmacy     = new Pharmacy();


if(isset($_POST['email']) && isset($_POST['password'])){

    $email            = trim($_POST['email']);
    $password         = trim($_POST['role']);


    if($role  == "Doctor"){
        $response = $doctor->updateDoctorPassword($password,$email);
        if($response ==  true){
            $final_reply['data']  ="Updated"; 
           $final_reply['response'] = true;
           echo json_encode($final_reply);
           Email::SentMail($email,$url); 
        }
              
    }
    elseif($role  =="client"){
        $response = $client->updateClientPassword($password,$email);
        if($response ==  true){
            $final_reply['data']  ="Updated"; 
           $final_reply['response'] = true;
           echo json_encode($final_reply);
           Email::SentMail($email,$url);     
        }
    }
    elseif($role  =="pharmacy"){
        $response = $pharmacy->updatePharmacyPassword($password,$email);
        if($response ==  true){
            $final_reply['data']  ="Updated"; 
           $final_reply['response'] = true;
           echo json_encode($final_reply);
           Email::SentMail($email,$url);
        } 
    }
 
}




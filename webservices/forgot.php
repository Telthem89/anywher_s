<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');



require 'autoloader.php'; 
$doctor       = new Doctor();
$client       = new Patient();
$pharmacy     = new Pharmacy();


if(isset($_POST['email']) && isset($_POST['role'])){

    $email        = trim($_POST['email']);
    $role         = trim($_POST['role']);
    $url          ='https://remotehealth.sagehillhost.com/';

    if($role  == "Doctor"){
        $response = $doctor->checkDockExist($email);
        if($response ==  true){
            $final_reply['data']  ="Send"; 
           $final_reply['response'] = true;
           echo json_encode($final_reply);
           Email::SentMail($email,$url); 
        }
              
    }
    elseif($role  =="client"){
        $response = $client->checkClientExist($email);
        if($response ==  true){
            $final_reply['data']  ="Send"; 
           $final_reply['response'] = true;
           echo json_encode($final_reply);
           Email::SentMail($email,$url);     
        }
    }
    elseif($role  =="pharmacy"){
        $response = $pharmacy->checkpharmacyExist($email);
        if($response ==  true){
            $final_reply['data']  ="Send"; 
           $final_reply['response'] = true;
           echo json_encode($final_reply);
           Email::SentMail($email,$url);
        } 
    }
 
}




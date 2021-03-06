<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';

require '../autoloader.php'; 
$admin = new Administrator();
$pharmacy = new Pharmacy();
//$CorsAccess =  new CorsAccess();
$response = array();
$final_response['response'] = '';


if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['password']))
 {

    
    $firstname      =htmlentities(trim($_POST['firstname']));
    $lastname       =htmlentities(trim($_POST['lastname']));
    $dob            =$_POST['dob'];
    $gender         =$_POST['gender'];
    $address        =htmlentities(trim($_POST['address']));
    $qualification  =htmlentities(trim($_POST['qualification']));
    $phoneNumber    =htmlentities(trim($_POST['phoneNumber']));
    $emailAddress   =htmlentities(trim($_POST['email']));
    $password       =htmlentities(trim($_POST['password']));
    $generatedCode  =rand(0,999999);

    $pharmphone    =$pharmacy->pharmacycheckifPhoneNumberIsExist($phoneNumber);
    $pharmemail    =$pharmacy->checkpharmacyExist($emailAddress);

     

    if (empty($firstname)){
         $response['err_message'] ="Please surname is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
    elseif (empty($lastname)){
         $response['err_message'] ="Please surname is required";
          $final_response['response'] =$response;
          echo json_encode($final_response);
      
    }
  
     elseif (empty($dob)){
     $response['err_message'] ="Please Date of birth is required";
     $final_response['response'] =$response;
     echo json_encode($final_response);
     
    } 
     elseif (empty($emailAddress)){
     $response['err_message'] ="Please email address required";
     $final_response['response'] =$response;
        echo json_encode($final_response);
     
    }
      elseif (empty($gender)){
         $response['err_message'] ="Please choose gender";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
    elseif (empty($password)){
         $response['err_message'] ="Please Password is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }

     elseif ($pharmphone ==  true){
          $final_reply['data']  ="Phone is already exist"; 
          $final_reply['response'] = false;
          echo json_encode($final_reply);
          exit();
     } 

     elseif ($pharmemail == true){
          $final_reply['data']  ="E-mail Address is already exist";
          $final_reply['response'] = false;
          echo json_encode($final_reply);
          exit();
     } 
    else
    {

     $response = $admin->admincreatePharmAccount($firstname,$lastname,$dob,$gender,$address,$qualification,$phoneNumber,$emailAddress,$password,$generatedCode);
    if($response ==  true)
    {
          $final_reply['data']  ="Saved"; 
          $final_reply['response'] = true;
          echo json_encode($final_reply);
        }
        else{
          $final_reply['data']  ="Something went wrong"; 
          $final_reply['response'] = false;
          echo json_encode($final_reply);
        }
         
    }
    
}


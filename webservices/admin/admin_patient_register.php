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
// require '../vendor/autoload.php';
$client = new Patient();
$admin = new Administrator();

// $mail = new PHPMailer(true);

$response = array();
$final_reply['response'] = false;
$final_reply['data'] = '';
//firstname,lastname,email,phoneNumber,password
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['password']) && isset($_POST['gender']) && isset($_POST['address']))
 {

 	$firstname =htmlentities(trim($_POST['firstname']));
	$lastname =htmlentities(trim($_POST['lastname']));
	$email =$_POST['email'];
	$phoneNumber =htmlentities(trim($_POST['phoneNumber']));
	$password =htmlentities(trim($_POST['password']));
    $gender =htmlentities(trim($_POST['gender']));
    $address =htmlentities(trim($_POST['address']));
    $generatedCode = rand(0,999999);
    $phonegeneratedCode = rand(0,9999);
    $emailcheck = $client->checkClientExist($email);
    $phonenumber = $client->checkifPhoneNumberIsExist($phoneNumber);



    if (empty($firstname)){
         $response['err_message']="Please first name is required";
         $final_response['response'] =$response;
         echo json_encode($final_response);
    }
    elseif (empty($lastname)){
         $response['err_message'] ="Please surname is required";
         $final_response['response'] =$response;
         echo json_encode($final_response);
    }
    elseif (empty($email)){
         $response['err_message'] ="E-mail address is required";
         $final_response['response'] =$response;
         echo json_encode($final_response);
    }
    elseif (empty($phoneNumber)){
         $response['err_message'] ="Please Phone Number is required";
         $final_response['response'] =$response;
         die($final_response);
    }
	elseif (empty($password)){
	         $response['err_message'] ="Please Password is required";
	         $final_response['response'] =$response;
	        echo json_encode($final_response);
	    }
     elseif ($emailcheck ==  true){
          $final_reply['data']  ="E-mail Address is already exist please try another E-mail Address"; 
          $final_reply['response'] = false;
           echo json_encode($final_reply);

           exit();
     } 

     elseif ($phonenumber ==  true){
            $final_reply['data']  ="Phone is already exist please try another phone Number"; 
            $final_reply['response'] = false;
           echo json_encode($final_reply);
           exit();
     } 
        
         
        else{
             $response=$admin->admincreateClientAccount($firstname,$lastname,$email,$phoneNumber,$password,$gender,$address,$generatedCode,$phonegeneratedCode);

             if($response ==  true){
                $final_reply['data']  ="Client created successfully"; 
                $final_reply['response'] = true;
                echo json_encode($final_reply);
                         
            }
            else{
               $final_reply['data'] = "Failed to create your account something went wrong";
               $final_reply['response'] = false;
                echo json_encode($final_reply);
            }
           
        }
       
	}

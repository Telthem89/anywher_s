<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require '../autoloader.php'; 
$pharmacy = new Pharmacy();

$response = array();
$final_response['response'] = '';


if (isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['password']))
 {

    $firstname       =htmlentities(trim($_POST['firstname']));
    $lastname       =htmlentities(trim($_POST['lastname']));
    $phoneNumber       =htmlentities(trim($_POST['phoneNumber']));
    $emailAddress      =htmlentities(trim($_POST['email']));
    $password          =htmlentities(trim($_POST['password']));
    $generatedCode     =rand(0,999999);

    $pharmacyphone    =$pharmacy->pharmacycheckifPhoneNumberIsExist($phoneNumber);
    $pharmacyemail     =$pharmacy->checkpharmacyExist($emailAddress);

     

   if (empty($emailAddress)){
     $response['err_message'] ="Please email address required";
     $final_response['response'] =$response;
        echo json_encode($final_response);
     
    }
      elseif (empty($phoneNumber)){
         $response['err_message'] ="Please Phone Number is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }
    elseif (empty($password)){
         $response['err_message'] ="Please Password is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }

     elseif ($pharmacyphone ==  true){

          $final_reply['data']  ="Phone is already exist please try another phone Number"; 
          $final_reply['response'] = false;
           echo json_encode($final_reply);

           exit();
     } 

     elseif ($pharmacyemail == true){
            $final_reply['data']  ="E-mail Address is already exist please try another E-mail Address";
            $final_reply['response'] = false;
           echo json_encode($final_reply);
           exit();
     } 
    else
    {

         $response = $pharmacy->createPharmAccount($firstname,$lastname,$phoneNumber,$emailAddress,$password,$generatedCode);
          if($response ==  true)
          {
                $final_reply['data']  ="Account created successfully"; 
                $final_reply['response'] = true;
                echo json_encode($final_reply);

                 $mail = new PHPMailer;
                $mail->isSMTP(); 
                $mail->SMTPDebug = 0; 
                $mail->Host = "smtp.gmail.com"; 
                $mail->Port = 587; 
                $mail->SMTPSecure = 'tls'; // ssl is depracated
                $mail->SMTPAuth = true;

                $mail->Username = 'datatelthem@gmail.com';
                $mail->Password = 'brqzpibmtkcxadnx';

                $mail->setFrom('noreply@anywherehealthcare.com', 'Anywhere Healthcare');
                $mail->addAddress($emailAddress);
                $mail->Subject = 'Verify your email address';
                $mail->Body = 'Thank you '. $fullname .' for signing up to Anywhere Healthcare. To get access to your account please verify your email address by adding this code to the form  '.$generatedCode;
                    if(!$mail->send()){
                 echo "Mailer Error: " . $mail->ErrorInfo;
                }
              }
              else{
                $final_reply['data']  ="Something went wrong"; 
                $final_reply['response'] = false;
                echo json_encode($final_reply);
              }
         
    }
    
}


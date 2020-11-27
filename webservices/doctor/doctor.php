<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require '../autoloader.php'; 
$doctor = new Doctor();
//$CorsAccess =  new CorsAccess();
$response = array();
$final_response['response'] = '';


if (isset($_POST['MDPCZ_ID'])  && isset($_POST['email']) && isset($_POST['password']))
 {

    $MDPCZ_ID =htmlentities(trim($_POST['MDPCZ_ID']));
    $fullname =htmlentities(trim($_POST['fullname']));
    $emailAddress =htmlentities(trim($_POST['email']));
    $password =htmlentities(trim($_POST['password']));
    $generatedCode = rand(0,999999);
	
    $doctoremail = $doctor->checkDockExist($emailAddress);

     

    if (empty($MDPCZ_ID)){
         $response['err_message']="Please first MDPCZ ID  is required";
          $final_response['response'] =$response;
        echo json_encode($final_response);
       
    }


     elseif (empty($emailAddress)){
     $response['err_message'] ="Please email address required";
     $final_response['response'] =$response;
        echo json_encode($final_response);
     
    }

    elseif (empty($password)){
         $response['err_message'] ="Please Password is required";
         $final_response['response'] =$response;
        echo json_encode($final_response);
         
    }



     elseif ($doctoremail == true){
            $final_reply['data']  ="E-mail Address in use";
            $final_reply['response'] = false;
           echo json_encode($final_reply);
           exit();
     } 

    
    else
    {

         $response = $doctor->createDoctorAccount($MDPCZ_ID,$fullname,$emailAddress,$password,$generatedCode);
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
                $mail->Body = 'Thank you for signing up to Anywhere Healthcare. To get access to your account please verify your email address by adding this code to the form  '.$generatedCode;
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


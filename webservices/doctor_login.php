<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

 require 'autoloader.php';
   $doctor = new Doctor();
   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';

   if(isset($_POST['email'])  &&  isset($_POST['password'])){
       $email = $_POST['email'];
       $password    = $_POST['password'];

       $status =$doctor->checkifEmailActivation($email);
       if ($status == true) {
              $final_reply['data']               = "Email not Activated";
               $final_reply['response']           = false;
                echo json_encode($final_reply);
              session_destroy();
              exit();
       }
       else{
       $response =  $doctor->loginDoctor($email, $password);
       
       if ($response==true) {
        
          $final_reply['response']              = true;
           $user_profile                        = array();
           $user_profile['id']                  = $response['data']['id'];
           $user_profile['MDPCZ_ID']            = $response['data']['MDPCZ_ID'];
           $user_profile['fullname']            = $response['data']['fullname'];
           $user_profile['firstname']           = $response['data']['firstname'];
           $user_profile['lastname']            = $response['data']['lastname'];
           $user_profile['dob']                 = $response['data']['dob'];
           $user_profile['gender']              = $response['data']['gender'];
           $user_profile['address']             = $response['data']['address'];
           $user_profile['qualification']       = $response['data']['qualification'];
           $user_profile['speciality']          = $response['data']['speciality'];
           $user_profile['experience']          = $response['data']['experience'];
           $user_profile['phoneNumber']         = $response['data']['phoneNumber'];
           $user_profile['email']               = $response['data']['email'];
           $user_profile['avatar']              = $response['data']['avatar'];
           $user_profile['country']             = $response['data']['country'];
           $user_profile['city']                = $response['data']['city'];
           $user_profile['bio']                 = $response['data']['bio'];
           $user_profile['priceperappoinrmnt']  = $response['data']['priceperappoinrmnt'];
           $user_profile['facebook']            = $response['data']['facebook'];
           $user_profile['youtube']             = $response['data']['youtube'];
           $user_profile['skype']               = $response['data']['skype'];
           $user_profile['twitter']             = $response['data']['twitter'];
           $user_profile['instagram']           = $response['data']['instagram'];
           $user_profile['viber']               = $response['data']['viber'];
           $user_profile['dateAvaiblabl']       = $response['data']['dateAvaiblabl'];
           $user_profile['timeavailabe']        = $response['data']['timeavailabe'];
           $_SESSION['doctor_id']               = $response['data']['id'];
           $_SESSION['dstatus']                 = $response['data']['status'];
           $_SESSION['adminstatus']             = $response['data']['adminstatus'];
           $user_profile['response']            =true;
           echo json_encode($user_profile);

          

       }
       else{
             $final_reply['data']               = "Invalid details. Try again later";
             $final_reply['response']           = false;
              echo json_encode($final_reply);
       }
     }
   
 }

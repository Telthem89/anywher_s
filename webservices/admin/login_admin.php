<?php

    require '../autoloader.php'; 
    $administrator = new Administrator();
   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';

   if(isset($_POST['username'])  &&  isset($_POST['password'])){
       $username = $_POST['username'];
       $password    = $_POST['password'];

       $response =  $administrator->loginAdministrator($username, $password);
       
       if ($response == true) {
        
          $final_reply['response']= true;

           $user_profile = array();
           $user_profile['id'] = $response['data']['id'];
           $user_profile['username'] = $response['data']['username'];
           $user_profile['email'] = $response['data']['email'];
           $user_profile['photo'] = $response['data']['photo'];
           $user_profile['phone'] = $response['data']['phone'];
           $_SESSION['admin_id'] = $response['data']['id'];






           $user_profile['fullname'] = $response['data']['firstname']." ".$response['data']['lastname'];
            $user_profile['response']=true;
           echo json_encode($user_profile);
          

       }
       else{
             $final_reply['data'] = "Invalid details. Try again later";
             $final_reply['response'] = false;
              echo json_encode($final_reply);
              exit();
       }
   
 }

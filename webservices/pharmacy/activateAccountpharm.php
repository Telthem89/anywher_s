 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 

  $pharmacy = new Pharmacy();
  if(isset($_POST['generatedCode'])){
  $generatedCode =htmlentities(trim($_POST['generatedCode']));

  $response =$pharmacy->checkCodeEntered($generatedCode);

   if ($response ==  true) {
       $pharmacy->UpdateStatusForpharmacy($generatedCode);
       $final_reply['data'] = "Account activated successfully";
       $final_reply['response'] = true;
       echo json_encode($final_reply);
   }
   else{
     $final_reply['data'] = "Activation code is in correct please try again";
     $final_reply['response'] = false;
      echo json_encode($final_reply);
   }

}
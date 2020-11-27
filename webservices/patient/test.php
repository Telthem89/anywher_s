 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 
   $final_reply = array();
   $final_reply['response'] = false;
   $final_reply['data'] = '';

  $client = new Client();
  if(isset($_POST['generatedCode']) && isset($_POST['email'])){
  $generatedCode =htmlentities(trim($_POST['generatedCode']));
  $email =htmlentities(trim($_POST['email']));

  $response = $client->checkCodeEntered($generatedCode,$email);

   if ($response ==  true) {
        $client->UpdateStatusForClient($generatedCode);
        $final_reply['response']= true;
        $response['succ_message'] ="correct"; 
        $final_response['response'] =$response;
        echo json_encode($final_response);
       }
   else{
        $final_reply['response']= true;
        $response['succ_message'] ="Invalid Code"; 
        $final_response['response'] =$response;
   }
}
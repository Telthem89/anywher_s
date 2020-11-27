 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 

  $pharmacy = new Pharmacy();
  if(isset($_POST['category_name'])){
  $category_name =htmlentities(trim($_POST['category_name']));

  $response =$pharmacy->addCategory($category_name);

   if ($response ==  true) {
       $final_reply['data'] = "Saved";
       $final_reply['response'] = true;
       echo json_encode($final_reply);
   }
   else{
     $final_reply['data'] = "Not Saved error occurred";
     $final_reply['response'] = false;
      echo json_encode($final_reply);
   }

}
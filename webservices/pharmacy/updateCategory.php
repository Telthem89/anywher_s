 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 

  $pharmacy = new Pharmacy();
  if(isset($_POST['id']) && isset($_POST['category_name'])){
  $cid =htmlentities(trim($_POST['id']));
  $category_name =htmlentities(trim($_POST['category_name']));

  $response =$pharmacy->updateCategory($category_name,$cid);

   if ($response ==  true) {
       $final_reply['data'] = "Updated";
       $final_reply['response'] = true;
       echo json_encode($final_reply);
   }
   else{
     $final_reply['data'] = "Not Updated error occurred";
     $final_reply['response'] = false;
      echo json_encode($final_reply);
   }

}
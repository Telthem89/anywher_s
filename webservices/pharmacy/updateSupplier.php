 <?php  
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
  require '../autoloader.php'; 

  $pharmacy = new Pharmacy();
  if(isset($_POST['id']) && isset($_POST['comapany_name']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['email'])){

  $sid             =htmlentities(trim($_POST['id']));
  $comapany_name   =htmlentities(trim($_POST['comapany_name']));
  $country         =htmlentities(trim($_POST['country']));
  $city            =htmlentities(trim($_POST['city']));
  $address         =htmlentities(trim($_POST['address']));
  $phone           =htmlentities(trim($_POST['phone']));
  $email           =htmlentities(trim($_POST['email']));

  $response =$pharmacy->updateSupplier($comapany_name,$country,$city,$address,$phone,$email,$sid);

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
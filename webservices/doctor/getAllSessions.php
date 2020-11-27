 <?php
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');  
require '../autoloader.php'; 
$session = new Session();
 header('Content-Type: application/json');


$result_found= $session->getallSessionsBelongtoDoctor($client_id);
echo json_encode($result_found,true);
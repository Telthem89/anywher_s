 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$client = new Patient();
 //header('Content-Type: application/json');


$result_found= $client->getallClients();
echo json_encode($result_found,true);

 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$client = new Patient();
$patient_id = trim($_GET['patient_id']);
$result_found= $client->getmedicalhistory($patient_id);
echo json_encode($result_found,true);

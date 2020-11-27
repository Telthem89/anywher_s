 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$administrator = new Administrator();

$result_found= $administrator->totalPendingDoctors();
echo json_encode($result_found,true);
 


 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$doctor = new Doctor();
 //header('Content-Type: application/json');


$result_found= $doctor->getallDoctors();
echo json_encode($result_found,true);

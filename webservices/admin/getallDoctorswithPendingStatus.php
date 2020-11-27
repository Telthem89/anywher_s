 <?php 
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

require '../autoloader.php'; 
$admin = new Administrator();
$result_found= $admin->getallDoctorswithPendingStatus();
echo json_encode($result_found,true);

 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');  
require '../autoloader.php'; 
$pharmacy = new Pharmacy();
 header('Content-Type: application/json');

if (isset($_GET['id'])) {
	$cid = $_GET['id'];


	$result_found= $pharmacy->getCategoryByID($cid);
    echo json_encode($result_found,true);
}
 


 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$client = new Patient();

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$result_found= $client->getProfilePicture($id);
    echo json_encode($result_found,true);
}
 


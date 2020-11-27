 <?php  
require '../autoloader.php'; 
$drug = new Drugs();
 $response = array();
 $final_reply['response'] = false;
 $final_reply['data'] = '';
$final_response['response'] = '';
if (isset($_POST['cartid'])) {
$cartid    = $_POST['cartid'];
$cartQnty  = $_POST['cartQnty'];
$medqnty   = $_POST['medqnty'];
$drug_id   = $_POST['drug_id'];


	$response= $drug->RemoveCart($cartid,$cartQnty,$medqnty,$drug_id);
    if ($response == true) {
    	 $final_reply['data']  ="Deleted"; 
		   $final_reply['response'] = true;
       echo json_encode($final_reply);
    }
    else{
    	$final_reply['data'] = "Not deleted";
      $final_reply['response'] = false;
      echo json_encode($final_reply);
    }
        
}
 


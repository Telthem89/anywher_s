<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$drug = new Drugs();

$response = array();
$final_response['response'] = '';
$final_reply['response'] = false;
$final_reply['data'] = '';

if (isset($_POST['drug_id']) && isset($_POST['client_id']) && isset($_POST['quantity']) && isset($_POST['pid']))
{
	$drug_id                = htmlentities(trim($_POST['drug_id']));
	$client_id              = htmlentities(trim($_POST['client_id']));
	$quantity               = htmlentities(trim($_POST['quantity']));
	$pid                    = htmlentities(trim($_POST['pid']));
	$price                  = htmlentities(trim($_POST['price']));
	$updateDrugQuantity     = htmlentities(trim($_POST['medQuantity']));


    if (empty($quantity)){
         $final_reply['data'] ="Quantity";
         $final_reply['response'] =false;
         echo json_encode($final_reply);
    }

	else{
		$response= $drug->addTocart($drug_id,$client_id,$quantity,$pid,$price,$updateDrugQuantity);
		if($response == true){
			$final_reply['data']     ="Saved"; 
            $final_reply['response'] = true;
            echo json_encode($final_reply);
			}
		    else{
		    	$final_reply['data']     ="Something went wrong !!"; 
		        $final_reply['response'] = false;
		        echo json_encode($final_reply);
		    	
		    }
	}
}





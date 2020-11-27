<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$transact = new Transaction();

$response = array();
$final_response['response'] = '';

if (isset($_POST['description']) && isset($_POST['amount']) && isset($_POST['currency']) && isset($_POST['receiver']) && isset($_POST['client_id']))
{
	$description= htmlentities(trim($_POST['description']));
	$amount= htmlentities(trim($_POST['amount']));
	$currency= htmlentities(trim($_POST['currency']));
	$receiver= htmlentities(trim($_POST['receiver']));
	$senderNumber= htmlentities(trim($_POST['senderNumber']));
	$doctid= htmlentities(trim($_POST['doctor_id']));
	$client_id= htmlentities(trim($_POST['client_id']));



	$response = $transact->makePayment($description,$amount,$currency,$receiver,$doctid,$client_id,$senderNumber);


	if ($response ==  true) {
		 $query ="search=innocent.tauzeni@gmail.com&amount=".$amount."&reference=".$doctid."&l="."1";
         $payment_uri = 'https://www.paynow.co.zw/Payment/Link/?q='.base64_encode($query);
         $final_reply['data'] = $payment_uri;
         $final_reply['response'] = true;
          echo json_encode($final_reply);
	}
    else{
    	$final_reply['data'] = "Not Saved error occurred";
        $final_reply['response'] = false;
        echo json_encode($final_reply);
    }
}





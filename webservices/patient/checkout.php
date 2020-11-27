<?php
 header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8'); 

require '../autoloader.php'; 
$drugtransact = new Drugs();

$response = array();
$final_response['response'] = '';

if (isset($_POST['total']))
{
	$client_id   = $_POST['client_id'];
	$pid         = $_POST['pid'];
	$total       = $_POST['total'];



	$response = $drugtransact->checkout($client_id,$pid,$total);


	if ($response ==  true) {
		 $query ="search=innocent.tauzeni@gmail.com&amount=".$total."&reference=".$client_id."&l="."1";
         $myurl ='https://remotehealth.sagehillhost.com/patient/shop.php?cid='.$client_id;
         $payment_return_url = "&return?gateway=".$myurl;
         $payment_uri = 'https://www.paynow.co.zw/Payment/Link/?q='.base64_encode($query).$payment_return_url;
         $final_reply['data'] = $payment_uri;
         $final_reply['response'] = true;
          echo json_encode($final_reply);
	}
    else{
    	$final_reply['data'] = "Not Saved";
        $final_reply['response'] = false;
        echo json_encode($final_reply);
    }
}





<?php

header('Access-Control-Allow-Origin: *');
require_once('paynow/autoloader.php');

ini_set('max_execution_time', 120);
set_time_limit(120);

// $baseURL =$_POST['baseUrl'];
$bill_number=$_GET['phoneNumber'];
$amount=$_GET['amount'];
$description=$_GET['purpose'];
$userid=$_GET['stid'];
 $test="0771111111";

$updateURL="https://remotehealth.sagehillhost.com";

// var_dump($userid,$bill_number,$amount,$purpose,$amt_lef,$term);
$paynow = new Paynow\Payments\Paynow(
    '9298',
    '09d91b77-56fd-4271-aa68-cb7ef1be99f1',
    'https://remotehealth.sagehillhost.com',
  
    // 'http://locahost/'.$baseURL."sendrequest?type=".$vehicle_type."&&size=".$carrier_size."&&order=".$orderID."&&delivery_date=".$delivery_date."&&delivery_carge=".$amount,
    // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
    'http://example.com/return?gateway=paynow'
);


$payment = $paynow->createPayment('Purpose '.$description, 'innocent.tauzeni@gmail.com');

$payment->add('payments', $amount);

// Save the response from paynow in a variable
$response = $paynow->sendMobile($payment, $test, 'ecocash');

$updateResponse = new stdClass();
if($response->success()) {
    // Or if you prefer more control, get the link to redirect the user to, then use it as you see fit
    $link = $response->redirectUrl();

    $pollUrl = $response->pollUrl();


    // Check the status of the transaction
     sleep(30);
    $status = $paynow->pollTransaction($pollUrl);
   

    if ($status->paid()) {
     $updateResponse->success="paid";
      $updateResponse->url=$updateURL;
        print(json_encode($updateResponse));
    }
    else{

    $updateResponse->success="true";
    $updateResponse->url=$updateURL;

         print(json_encode($updateResponse));
    }
    
     

}
else{
    $updateResponse->success="false";

    print(json_encode($updateResponse));
}
?>
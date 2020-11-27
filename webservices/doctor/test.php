 <?php 
  header("Access-Control-Allow-Headers: Authorization, Content-Type");
  header("Access-Control-Allow-Origin: *");
  header('content-type: application/json; charset=utf-8'); 
 
require '../autoloader.php'; 
$doctor = new Doctor();
$response = array();
$final_response['response'] = '';
if (isset($_POST['email'])) {
	$email = $_POST['email'];


	$result_found= $doctor->checkUserExist($email);

	if ($result_found) {
		$response['succ_message'] ="Email Already exist please login"; 
		$final_response['response'] =$response;
	    echo json_encode($final_response);
	}
	else{
		$response['err_message'] ="Woooow good job!!!"; 
		$final_response['response'] =$response;
	     echo json_encode($result_found);
	}
   
}


//send email here .......
            $div = "<div align='center'><img src='yaita.co.zw/imgs/logo.png' width='300px'><br><p>Thank you for signing up!</p><br>
            <p>
                Thank you for joining Ustawi. Your account has been created this your code".$generatedCode."</p>";

           $msg =$div;
           Mail::send([],[],function ($message) use ($msg,$emailAddress)
            {
                $message->from('noreply@yaita.com')->to($emails)->subject('Thank you for joining Ustawi. Your account has been created this your code  '.$generatedCode)->setBody($msg, 'text/html');;
            });
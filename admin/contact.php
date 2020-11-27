<?php
// Check for empty fields
if(empty($_POST['message']))
   {
   echo "No message Provided!";
   return false;
   }
   
$name = "USTAWI Africa";
$email_address = "it@sagehilltechnologies.com";
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Create the email and send the message
$to = 'diwauripod@gmail.com'; //This is where the form will send a message to.
$email_subject = "USTAWI Ticket Reply";
$email_body = "$message";
$headers = "From: it@sagehilltechnologies.com\n"; // This is the email address the generated message will be said to be from.
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;         
?>

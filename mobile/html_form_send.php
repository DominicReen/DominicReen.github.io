<?php
		header( "refresh:2;url=https://bobbi.ivytech.edu/~dreen/WebProject/mobile/contactus.html" ); 
     $email;$comment;$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }if(isset($_POST['comment'])){
          $email=$_POST['comment'];
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h1>Please check the the captcha form.</h1>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LesgQoUAAAAAHlnVcuCB959d661M0zYj4Xetgjy&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h1>You are spammer!</h1>';
        }

if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "dreen@ivytech.edu";
	
	$email_subject = "Message from Reen Cinematography and VFX";
	
	
	function died($error) {
		// your error code can go here
		echo "We're sorry, but there are errors found with the form you submitted.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['address']) ||
		!isset($_POST['city']) ||
		!isset($_POST['state']) ||
		!isset($_POST['zip']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');		
	}
	
	$name = $_POST['name']; // not required
	$email_from = $_POST['email']; // required
	$address = $_POST['address']; // not required
	$city = $_POST['city']; // not required
	$state = $_POST['state']; // not required
	$zip = $_POST['zip']; // required
	$comments = $_POST['comments']; // not required
	
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
  	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Address: ".clean_string($address)."\n";
	$email_message .= "City: ".clean_string($city)."\n";
	$email_message .= "State: ".clean_string($state)."\n";
	$email_message .= "Zip: ".clean_string($zip)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
header( "refresh:3;url=https://bobbi.ivytech.edu/~dreen/WebProject/mobile/contactus.html" ); 

?>



<h1>Thank you for contacting us. We will be in touch with you very soon.</h1>

<?php
}
die();
?>
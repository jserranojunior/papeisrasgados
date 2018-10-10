<?php
if(!empty($_POST) && wp_verify_nonce( $_POST['_wpnonce'], 'apss-ajax-nonce')){
	$sender_name=$_POST['name'];
	$from=$_POST['from_email'];
	$to= $_POST['receiver_email'];

	 $headers 	= "X-Mailer: php\n";
	 $headers .= 'Content-type: text/html'."\r\n"."From: $sender_name <$from>"."\r\n" .
				'Reply-To: '.$from . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

	$subject = $_POST['email_subject'];

	$message= $_POST['email_message'];

	$response=wp_mail( $to, $subject, $message, $headers );

	if($response){
		die("success");
	}else{
		die('fail');
	}

}
?>
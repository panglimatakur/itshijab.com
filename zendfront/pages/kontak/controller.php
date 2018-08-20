<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$email_name 	= isset($_REQUEST['email_name'])		? $sanitize->str($_REQUEST['email_name']) 			:"";
$email_email 	= isset($_REQUEST['email_email'])		? $sanitize->email($_REQUEST['email_email']) 		:"";
$email_msg 		= isset($_REQUEST['email_msg'])			? $sanitize->str($_REQUEST['email_msg']) 			:"";
$email_subject 	= isset($_REQUEST['email_subject'])		? $sanitize->str($_REQUEST['email_subject']) 		:"";
	
	
if(!empty($direction) && $direction == "send"){
	if(!empty($email_name) && !empty($email_email) && !empty($email_subject) && !empty($email_msg)){
	
		$email_admin	= "thetakur@gmail.com";
		$type			= "html";
			
		$headers  		= 'MIME-Version: 1.0' . "\r\n";
		$headers 		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		$headers 		.= 'To: ALibaba <'.$email_admin.'>' . "\r\n";
		$headers 		.= 'From: '.$email_name.' <'.$email_email.'>' . "\r\n";
		
		mail($email_admin,$email_subject,$email_msg,$headers);
		redirect_page($lparam."&msg=1");
		//sendmail($email_admin_main,$subject,$msg,$email_msg,$type);
	}else{
		$msg = 3;
	}	
}
?>

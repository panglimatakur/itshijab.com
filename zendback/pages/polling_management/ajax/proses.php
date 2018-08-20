<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ALIBABA',true); }
	include_once("../../../includes/config.php");
	include_once("../../../includes/classes.php");
	include_once("../../../includes/functions.php");
	include_once("../../../includes/declarations.php");
	$direction 		= isset($_REQUEST['direction']) 	? $_REQUEST['direction'] 		: "";
	$status 		= isset($_REQUEST['status']) 		? $_REQUEST['status'] 			: "";
	$id_polling 	= isset($_REQUEST['id_polling']) 	? $_REQUEST['id_polling'] 		: "";
	$id_option 		= isset($_REQUEST['id_option']) 	? $_REQUEST['id_option'] 		: "";

	if(!empty($direction) && $direction == "delete_option"){
		$db->delete($tpref."polling_options"," WHERE ID_POLLING_OPTION='".$id_option."'");
	}
	if(!empty($direction) && $direction == "delete"){
		$db->delete($tpref."polling_options"," WHERE ID_POLLING='".$id_polling."'");
		$db->delete($tpref."polling"," WHERE ID_POLLING='".$id_polling."'");
	}
	
	if(!empty($direction) && $direction == "set_status"){
		$rejection		= isset($_REQUEST['rejection']) ? $_REQUEST['rejection'] : "";
		$rejection_cond	= "";
		if(!empty($rejection)){ $rejection_cond = ",REJECTION_REASON = '".$rejection."'"; }
		
		$db->query("UPDATE ".$tpref."guest_book SET STATUS = '".$status."' ".@$rejection_cond." WHERE ID_GUEST_BOOK='".$id_guest_book."'");
		
		$q_db 			= $db->query("SELECT * FROM ".$tpref."guest_book WHERE ID_GUEST_BOOK='".$id_guest_book."'");
		$dt_gb 			= $db->fetchNextObject($q_db);
		
		$to_email		= $dt_gb->GUEST_EMAIL;
		$subject 		= "Konfirmasi Status Jadwal Pertemuan \"".$dt_gb->SUBJECT." \"";
		$type			= "html";
			
		$headers  		= 'MIME-Version: 1.0' . "\r\n";
		$headers 		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers 		.= 'To: '.$dt_gb->GUEST_NAME.' <'.$to_email.'>' . "\r\n";
		$headers 		.= 'From: Pemkab Bangka Tengah <admin@bangkatengahkab.go.id>' . "\r\n";
		
			$email_msg		= "
			Dear ".$dt_gb->GUEST_NAME."<br><br>
			
			Diberitahukan bahwa jadwal pertemuan anda dengan pemkab Bangka Tengah pada <br><br>
			
			Tanggal : ".$dtime->now2indodate2($dt_gb->START_DATE)." <br><br>
			Sampai Dengan<br><br>
			Tanggal : ".$dtime->now2indodate2($dt_gb->END_DATE)." <br><br>";
		
		if($status == 1){
			$email_msg		.= " sedang dipertimbangkan, silahkan menunggu dengan sabar";
		}
		if($status == 2){
			$email_msg		.= " sudah di setujui, silahkan datang tepat waktu.";
		}
		if($status == 3){
			$email_msg		.= " untuk saat ini ditolak, dikarenakan ".@$rejection;
		}
		mail($email_admin,$subject,$email_msg,$headers);
	}
}
?>
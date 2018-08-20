<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ALIBABA',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	$direction 	= isset($_REQUEST['direction']) 	? $_REQUEST['direction'] : "";
	$no 		= isset($_REQUEST['no']) 			? $_REQUEST['no'] : "";
	
	if(!empty($direction) && $direction == "del_pic"){
		$q_ori		= $db->query("SELECT * FROM system_users_client WHERE ID_USER='".$no."'");
		$dt_ori		= $db->fetchNextObject($q_ori);
		$photori 	= $dt_ori->USER_PHOTO;
		if(is_file($basepath."/files/images/users/".$photori)){
			unlink($basepath."/files/images/users/".$photori);
			unlink($basepath."/files/images/users/big/".$photori);
		}
		$db->query("UPDATE system_users_client SET USER_PHOTO = '' WHERE ID_USER='".$no."'");
	}
	if($direction == "delete"){
		$db->delete($tpref."partners"," WHERE ID_PARTNER='".$no."'");
	}
}
?>
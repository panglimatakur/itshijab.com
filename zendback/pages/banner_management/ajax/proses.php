<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ALIBABA',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 	= isset($_REQUEST['direction']) 	? $_REQUEST['direction'] 	: "";
	$no 		= isset($_REQUEST['no']) 			? $_REQUEST['no'] 			: "";

	if(!empty($direction) && $direction == "delete"){
		$q_photos 	= $db->query("SELECT * FROM ".$tpref."banner WHERE ID_BANNER = '".$no."'");
		while($dt_photos = $db->fetchNextObject($q_photos)){
			if(is_file($basepath."/files/images/banners/".$dt_photos->FILETARGET)){
				unlink($basepath."/files/images/banners/".$dt_photos->FILETARGET);
			}
		}
		$db->delete($tpref."banner"," WHERE ID_BANNER='".$no."'");
	}
}
?>
<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	define('mainload','ITSHIJAB',true);
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	
	$direction 	= isset($_POST['direction']) 	? $sanitize->str($_POST['direction']) 	: "";
	$no 		= isset($_POST['no']) 			? $sanitize->number($_POST['no']) 		: "";

	if(!empty($direction) && $direction == "delete"){ 
		$oldhalaman = $db->fob("ICON",$tpref."posts","WHERE ID_POST='".$no."'"); 
		if(is_dir($basepath."/files/images/".$oldhalaman)){ unlink($basepath."/files/images/".$oldhalaman); } 
		$db->delete($tpref."posts","WHERE ID_POST='".$no."'");
		echo msg("Data Berita Sudah Dihapus!!","true");
	}
}
else{  defined('mainload') or die('Restricted Access'); }
?>

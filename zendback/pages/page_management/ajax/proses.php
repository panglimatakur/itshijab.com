<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	define('mainload','ITSHIJAB',true);
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	
	$direction 	= isset($_POST['direction']) 	? $sanitize->str($_POST['direction']) 	: "";
	$no 		= isset($_POST['no']) 			? $sanitize->number($_POST['no']) 		: "";

	if(!empty($direction) && $direction == "delete"){ 
		$q_halaman 	= $db->query("SELECT PAGE,ID_MODULE FROM system_pages_client WHERE ID_PAGE_CLIENT='".$no."'"); 
		$dt_halaman = $db->fetchNextObject($q_halaman); 
		$id_module  = $dt_halaman->ID_MODULE; 
		$oldhalaman = $dt_halaman->PAGE; 
		
		if($id_module == 2){ $pos = "zendback"; }else{ $pos = "zendfront"; } 
		if(is_dir($basepath."/".$pos."/pages/".$oldhalaman)){ rename($basepath."/".$pos."/pages/".$oldhalaman,$basepath."/".$pos."/pages/deleted-".$oldhalaman); } 
		$db->delete("system_pages_client_rightaccess","WHERE ID_PAGE_CLIENT='".$no."'");
		$db->delete("system_pages_client","WHERE ID_PAGE_CLIENT='".$no."'");
		$db->delete("system_pages_client","WHERE ID_PARENT='".$no."'");
		echo msg("Data Halaman Sudah Dihapus!!","true");
	}
}
else{  defined('mainload') or die('Restricted Access'); }
?>

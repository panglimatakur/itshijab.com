<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 		= isset($_REQUEST['direction']) 	? $_REQUEST['direction'] 		: "";
	$id_item 		= isset($_REQUEST['id_item']) 	? $_REQUEST['id_item'] 		: "";
	
	if(!empty($direction) && $direction == "delete"){
		if(empty($_SESSION['uidkey'])){
			echo "error";
		}else{
			$q_photos = $db->query("SELECT * FROM ".$tpref."products_photos WHERE ID_PRODUCT = '".$id_item."'");
			while($dt_photos = $db->fetchNextObject($q_photos)){
				if(is_file($basepath."/files/images/products/".$dt_photos->PHOTOS)){
					unlink($basepath."/files/images/products/".$dt_photos->PHOTOS);	
				}
			}
			$db->delete($tpref."products_photos"," WHERE ID_PRODUCT = '".$id_item."'");
			$db->delete($tpref."products"," WHERE ID_PRODUCT = '".$id_item."'");
		}
	}
}
?>
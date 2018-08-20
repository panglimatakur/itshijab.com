<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','SEMPOA',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 	= isset($_REQUEST['direction']) 	? $_REQUEST['direction'] 	: "";
	$no 		= isset($_REQUEST['no']) 			? $_REQUEST['no'] 			: "";
	$id_session = isset($_REQUEST['id_session']) 	? $_REQUEST['id_session'] 	: "";
	$id_picture = isset($_REQUEST['id_picture']) 	? $_REQUEST['id_picture'] 	: "";

	if(!empty($direction) && $direction == "set_status"){
		$id_status 	= isset($_REQUEST['id_status']) ? $_REQUEST['id_status'] 	: "";
		$db->query("UPDATE ".$tpref."products SET ID_STATUS = '".$id_status."' WHERE ID_PRODUCT = '".$no."'");
		
	}
	if(!empty($direction) && $direction == "delete"){
		$q_photos 	= $db->query("SELECT * FROM ".$tpref."products_photos WHERE ID_PRODUCT='".$no."'");
		while($dt_photos = $db->fetchNextObject($q_photos)){
			if(!empty($icon) || is_file($basepath."/files/images/products/".$dt_photos->PHOTOS)){
				unlink($basepath."/files/images/products/thumbnails/".$dt_photos->PHOTOS);
				unlink($basepath."/files/images/products/".$dt_photos->PHOTOS);
			}
		}
		$db->delete($tpref."products_photos"," WHERE ID_PRODUCT='".$no."'");
		$db->delete($tpref."products"," WHERE ID_PRODUCT ='".$no."'");
	}
	if(!empty($direction) && $direction == "check_code"){
		$id_kategori 	= isset($_REQUEST['id_kategori']) ? $_REQUEST['id_kategori'] : "";
		@$last_code 		= $db->fob("CODE",$tpref."products"," WHERE ID_PRODUCT_CATEGORY = '".$id_kategori."' ORDER BY ID_PRODUCT DESC");
		echo $last_code;	
	}
	if(!empty($direction) && $direction == "delete_pic"){
		$q_photos 	= $db->query("SELECT * FROM ".$tpref."products_photos WHERE ID_PRODUCT_PHOTO='".$id_picture."'");
		$dt_photos = $db->fetchNextObject($q_photos);
		if(is_file($basepath."/files/images/products/".$dt_photos->PHOTOS)){
			unlink($basepath."/files/images/products/thumbnails/".$dt_photos->PHOTOS);
			unlink($basepath."/files/images/products/".$dt_photos->PHOTOS);
			$db->delete($tpref."products_photos"," WHERE ID_PRODUCT_PHOTO='".$id_picture."'");
		}
	}
	
	if(!empty($direction) && $direction == "add_new_category"){
		$parent_id 		= isset($_REQUEST['parent_id']) 	? $_REQUEST['parent_id'] 	: "";
		$id_type 		= isset($_REQUEST['id_type']) 		? $_REQUEST['id_type'] 	: "";
		$nama_kategori 	= isset($_REQUEST['nama_kategori'])? $_REQUEST['nama_kategori'] 	: "";
		$halaman = permalink(strtolower($nama_kategori),"_");
		$tblnya 	= $tpref."products_categories";
		if(!empty($parent_id)){  $depth = $db->fob("SERI",$tblnya,"WHERE ID_PRODUCT_CATEGORY='".$parent_id."'")+1; }else{ $depth='1'; }
		
		$enc	= substr(md5(rand(0,100)),0,8);
		$seri 	= $db->last("SERI",$tblnya,"WHERE SERI='".$depth."'")+1;
		$content = array(1=>
					array("ID_PRODUCT_TYPE",$id_type),
					array("SERI",$seri),
					array("TITLE",ucwords($nama_kategori)),
					array("NAME",ucwords($nama_kategori)),
					array("PAGE",$halaman),
					array("ID_PARENT",@$parent_id),
					array("STATUS",@$status),
					array("BY_ID_USER",$_SESSION['uidkey']),
					array("TGLUPDATE",date("Y-m-d G:i:s")));
		$db->insert($tblnya,$content);
		$new_id_type 	= mysql_insert_id();
		$result['msg'] 	= "berhasil";
		$result['value']= $new_id_type;
		echo json_encode($result);
	}
}
?>
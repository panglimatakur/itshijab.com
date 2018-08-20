<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($direction) && $direction == "edit"){
		$qcont				=	$db->query("SELECT * FROM ".$tblnya." WHERE ID_PRODUCT_CATEGORY='".$no."' ");
		$dtedit				=	$db->fetchNextObject($qcont);
		$parent_id			=	$dtedit->ID_PARENT;
		$nama				=	$dtedit->NAME;
		$permalink  		= 	$dtedit->PAGE; 
		$judul 				= 	$dtedit->TITLE;
		$contenttype		= 	$dtedit->ID_PRODUCT_TYPE;
		$status				=	$dtedit->STATUS;
	}
	if(!empty($parent_id)){
		@$nama_parent		=	$db->fob("NAME",$tblnya,"WHERE ID_PRODUCT_CATEGORY='".$parent_id."'");
	}
?>

<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($direction) && $direction == "edit"){
		$qcont				=	$db->query("SELECT * FROM ".$tblnya." WHERE ID_PAGE_CLIENT='".$no."' ");
		$dtedit				=	$db->fetchNextObject($qcont);
		$parent_id			=	$dtedit->ID_PARENT;
		$nama				=	$dtedit->NAME;
		$permalink  		= 	$dtedit->PAGE; 
		$judul 				= 	$dtedit->TITLE;
		$edit_keywords  	= 	$dtedit->KEYWORDS;
		$edit_description  	= 	$dtedit->DESCRIPTION;
		$isi  				= 	$dtedit->CONTENT;		
		$posisi				= 	$dtedit->POSITION;
		$depth				= 	$dtedit->DEPTH;
		$contenttype		= 	$dtedit->TYPE;
		$depth				= 	$dtedit->DEPTH;
		$is_folder			= 	$dtedit->IS_FOLDER;
		$id_module			= 	$dtedit->ID_MODULE;
		$status				=	$dtedit->STATUS;
		$icon				=	$dtedit->ICON;
	}
	if(!empty($parent_id)){
		@$nama_parent		=	$db->fob("NAME",$tblnya,"WHERE ID_PAGE_CLIENT_CLIENT='".$parent_id."'");
	}
?>

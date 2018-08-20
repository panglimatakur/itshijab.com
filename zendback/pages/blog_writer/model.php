<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$q_category = $db->query("SELECT * FROM ".$tpref."posts_categories_master ORDER BY NAME ASC");
	if(!empty($direction) && $direction == "edit"){
		$qcont				=	$db->query("SELECT * FROM ".$tblnya." WHERE ID_POST='".$no."' ");
		$dtedit				=	$db->fetchNextObject($qcont);
		$news_cat  			= 	$dtedit->ID_POST_CATEGORY; 
		$permalink  		= 	$dtedit->PAGE; 
		$judul 				= 	$dtedit->TITLE;
		$edit_keywords  	= 	$dtedit->KEYWORDS;
		$edit_description  	= 	$dtedit->DESCRIPTION;
		$isi  				= 	$dtedit->CONTENT;		
		$status				=	$dtedit->STATUS;
		$icon				=	$dtedit->ICON;
	}
?>

<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$str_query 			= "SELECT * FROM ".$tpref."posts_categories_master WHERE ID_POST_CATEGORY IS NOT NULL";
	$link_str			= $lparam;
	$q_level 			= $db->query($str_query ." ".$limit);
	$num_level			= $db->numRows($q_level);
	
	if(!empty($direction) && $direction == "edit"){
		$q_level_edit 	= $db->query("SELECT * FROM ".$tpref."posts_categories_master WHERE ID_POST_CATEGORY ='".$no."'");
		$dt_level_edit	= $db->fetchNextObject($q_level_edit);
		$nama 			= $dt_level_edit->NAME; 		
	}
?>
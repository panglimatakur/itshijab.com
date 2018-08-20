<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$condition = "";
	if(!empty($filter_source)){ 
		$condition .= " AND SOURCE = '".$filter_source."'";
	}
	if(!empty($fbanner_type)){
			$condition .= " AND ID_BANNER_TYPE = '".$fbanner_type."'";
	}
	$query_str	= "SELECT * FROM ".$tpref."banner WHERE ID_BANNER IS NOT NULL ".$condition." ORDER BY ID_BANNER DESC ";
	//echo $query_str;
	$q_produk 	= $db->query($query_str);
	$num_produk	= $db->recount($query_str);
	
	$banner_str	= "SELECT * FROM ".$tpref."banner_type_master ORDER BY ID_BANNER_TYPE DESC ";
	$q_banner	= $db->query($banner_str);
	$q_fbanner	= $db->query($banner_str);
?>
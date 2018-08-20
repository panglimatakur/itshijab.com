<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$condition = "";
	if(!empty($parameters)){
		$par 		 = explode("/",$parameters);
		$id_product  = $par[0];
	}
	if(!empty($id_product)){
		$condition 		.= " AND ID_PRODUCT = '".$id_product."'";  
	}
	$q_str 		= "SELECT * FROM ".$tpref."products WHERE ID_PRODUCT IS NOT NULL ".$condition." ORDER BY ID_PRODUCT DESC LIMIT 0,24";
	$q_product 	= $db->query($q_str);
	$dt_product = $db->fetchNextObject($q_product);
	@$photo 	= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
	
	$q_str_sim 		= "SELECT * FROM ".$tpref."products WHERE ID_PRODUCT IS NOT NULL AND ID_PRODUCT_CATEGORY = '".$dt_product->ID_PRODUCT_CATEGORY."' ORDER BY ID_PRODUCT DESC LIMIT 0,12";
	$q_product_sim 	= $db->query($q_str_sim);
	
	$q_str_reco 	= "SELECT * FROM ".$tpref."products ORDER BY ID_PRODUCT DESC LIMIT 0,20";
	$q_product_reco = $db->query($q_str_reco);
?>

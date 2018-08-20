<?php defined('mainload') or die('Restricted Access'); ?>

<?php
	$condition = "";
	if(!empty($parameters)){
		$par 		 = explode("/",$parameters);
		$id_category = $par[0];
		$condition 		.= " AND ID_PRODUCT_CATEGORY = '".$id_category."'";  
	}
	$q_str 		 = "SELECT * FROM ".$tpref."products WHERE ID_PRODUCT IS NOT NULL ".$condition." ORDER BY ID_PRODUCT DESC LIMIT 0,24";
	$q_product 	 = $db->query($q_str);
	$num_product = $db->numRows($q_product);
?>

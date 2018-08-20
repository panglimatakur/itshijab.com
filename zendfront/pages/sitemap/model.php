<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$condition = "";
if(!empty($direction) && $direction == "search"){
	$condition = " AND a.ID_PRODUCT = '".$id_product."'";
}
if(!empty($parameter[1])){
	$condition = " AND a.ID_PRODUCT = '".$parameter[1]."'";	
}
if(!empty($parameter[0]) && substr_count($parameter[0],"cat-") > 0){
	$cat 		= explode("-",$parameter[0]);
	$condition  = " AND a.ID_PRODUCT_CATEGORY = '".$cat[1]."'";	
}

$product_string		= " SELECT * FROM ".$tpref."products a, ".$tpref."products_photos b WHERE a.ID_PRODUCT = b.ID_PRODUCT ".$condition." AND MOSTWANTED != 'promo' GROUP BY b.ID_PRODUCT ORDER BY a.ID_PRODUCT DESC";

//echo $product_string;
$q_product 	   		= $db->query($product_string." ".$limit);
$num_product 		= $db->numRows($q_product);
?>
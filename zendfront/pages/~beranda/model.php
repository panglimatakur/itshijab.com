<?php defined('mainload') or die('Restricted Access'); ?>

<?php
	$q_str 			= "SELECT * FROM ".$tpref."products ORDER BY ID_PRODUCT DESC LIMIT 0,12";
	$q_product 		= $db->query($q_str);
	
	$q_str_reco 	= "SELECT * FROM ".$tpref."products ORDER BY ID_PRODUCT DESC LIMIT 0,20";
	$q_product_reco = $db->query($q_str_reco);

?>

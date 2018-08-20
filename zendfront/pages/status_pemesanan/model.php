<?php defined('mainload') or die('Restricted Access'); ?>

<?php
	$q_str 		= "SELECT * FROM ".$tpref."products ORDER BY ID_PRODUCT DESC LIMIT 0,24";
	$q_product 	= $db->query($q_str);
?>

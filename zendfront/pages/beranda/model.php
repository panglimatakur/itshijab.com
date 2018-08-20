<?php defined('mainload') or die('Restricted Access'); ?>

<?php
$str_default_design = "SELECT * FROM ".$tpref."custom_designs_default ORDER BY ID_CUSTOM_DESIGN_DEFAULT DESC";
$q_default_design 	= $db->query($str_default_design);

$str_pattern = "SELECT * FROM ".$tpref."config WHERE PARAMETER = 'pattern' ORDER BY ID_CONFIG ASC";
$q_pattern 	= $db->query($str_pattern);

$str_textile = "SELECT * FROM ".$tpref."config WHERE PARAMETER = 'textile' ORDER BY ID_CONFIG ASC";
$q_textile 	= $db->query($str_textile);

$harga_design			= $db->fob("VALUE",$tpref."config"," WHERE ID_CONFIG = '4'");
$harga_design_service 	= $db->fob("VALUE",$tpref."config"," WHERE ID_CONFIG = '5'");
$harga_pashmina  		= $db->fob("VALUE",$tpref."config"," WHERE ID_CONFIG = '1'");
$harga_segiempat  		= $db->fob("VALUE",$tpref."config"," WHERE ID_CONFIG = '1'");

if(!empty($_SESSION['cidkey'])){ $id_login = $_SESSION['cidkey']; }
?>




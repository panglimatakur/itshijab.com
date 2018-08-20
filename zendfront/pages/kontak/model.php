<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$q_str 			= "SELECT * FROM system_client_info";
	$q_info 		= $db->query($q_str);
	$dt_info 		= $db->fetchNextObject($q_info);
	$client_name 	= $dt_info->CLIENT_NAME;
	$client_email 	= $dt_info->CLIENT_EMAIL;
	$client_phone 	= $dt_info->CLIENT_PHONE;
	$client_address = $dt_info->CLIENT_ADDRESS;
	$client_map 	= $dt_info->MAP_FRAME;
?>

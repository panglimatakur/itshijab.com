<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$condition = "";
	if(!empty($_REQUEST['rnama']))				{ $condition 	.= " AND USER_NAME 				LIKE '%".$rnama."%'"; 	}
	if(!empty($_REQUEST['rid_user_level']))		{ $condition 	.= " AND ID_CLIENT_USER_LEVEL 	= '".$rid_user_level."'"; 	}
	$str_query 			= "SELECT * FROM system_users_client WHERE ID_USER IS NOT NULL ".$condition."";
	$link_str			= $lparam;
	$q_partner 			= $db->query($str_query);
	$num_partner		= $db->numRows($q_partner);
	
	$q_client_level 	= $db->query("SELECT ID_CLIENT_USER_LEVEL,NAME FROM system_master_client_users_level ORDER BY ID_CLIENT_USER_LEVEL ASC");

	if(!empty($direction) && $direction == "edit"){
		$q_partner_edit = $db->query("SELECT * FROM system_users_client WHERE ID_USER='".$no."'");
		$dt_partner_edit= $db->fetchNextObject($q_partner_edit);
		
		$nama 			= $dt_partner_edit->USER_NAME; 	
		$tptlhr 		= $dt_partner_edit->BIRTH_PLACE; 	
		$tgllhr 		= $dtime->date2indodate($dt_partner_edit->BIRTH_DATE); 		
		$alamat 		= $dt_partner_edit->USER_ADDRESS; 		
		$tlp 			= $dt_partner_edit->USER_PHONE; 		
		$email 			= $dt_partner_edit->USER_EMAIL; 		
		$gender 		= $dt_partner_edit->USER_GENDER; 		
		$photo 			= $dt_partner_edit->USER_PHOTO; 	
		$id_user_level 	= $dt_partner_edit->ID_CLIENT_USER_LEVEL; 		
	}
?>
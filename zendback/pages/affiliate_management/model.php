<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$qedit 			= $db->query("SELECT API_KEY,ID_AFFILIATE FROM system_users_client WHERE ID_USER = '".$_SESSION['uidkey']."' ");
$dtedit 		= $db->fetchNextObject($qedit);
@$api_key 		= $dtedit->API_KEY;	
@$aff_id 		= $dtedit->ID_AFFILIATE;	
?>
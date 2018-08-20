<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	
$qedit 			= $db->query("SELECT * FROM system_users_client WHERE ID_USER = '".$_SESSION['uidkey']."' ");
$dtedit 		= $db->fetchNextObject($qedit);
$photo 			= $dtedit->USER_PHOTO;
$fname 			= $dtedit->USER_NAME;
$email 			= $dtedit->USER_EMAIL;
$phone 			= $dtedit->USER_PHONE;
$alamat 		= $dtedit->USER_ADDRESS;
$gender 		= $dtedit->USER_GENDER;
$tptlhr 		= $dtedit->BIRTH_PLACE;
$tgllhr 		= $dtime->date2indodate($dtedit->BIRTH_DATE); 		
?>
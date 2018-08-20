<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	
$qedit 			= $db->query("SELECT * FROM system_client_info");
$num_client		= $db->numRows($qedit);
if($num_client > 0){
	$dir_button 	= "save";
	$dtedit 		= $db->fetchNextObject($qedit);
	@$photo 		= $dtedit->CLIENT_LOGO;
	@$name 			= $dtedit->CLIENT_NAME;
	@$email 		= $dtedit->CLIENT_EMAIL;
	@$phone 		= $dtedit->CLIENT_PHONE;
	@$alamat 		= $dtedit->CLIENT_ADDRESS;
	@$bcarek		= $dtedit->REK_BCA_ACCOUNT;
	@$bcaname		= $dtedit->REK_BCA_NAME;
	@$mandirirek	= $dtedit->REK_MANDIRI_ACCOUNT;
	@$mandiriname	= $dtedit->REK_MANDIRI_NAME;
	@$additional 	= $dtedit->ADDITIONAL_INFO;
	@$peta 			= $dtedit->MAP_FRAME;
}else{
	$dir_button 	= "insert";
}
?>
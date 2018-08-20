<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if(!defined('mainload')) { define('mainload','Sicknest',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	$action 				= mysql_real_escape_string($_POST['action']); 
	$updateRecordsArray 	= $_POST['recordsArray'];
}else{
	defined('mainload') or die('Restricted Access');
}
?>
<?php 

if ($action == "updateRecordsListings"){
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE system_pages_client SET SERI = " . $listingCounter . " WHERE ID_PAGE_CLIENT = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
	
	echo '<pre>';
	print_r($updateRecordsArray);
	echo '</pre>';
	echo 'If you refresh the page, you will see that records will stay just as you modified.';
}
?>
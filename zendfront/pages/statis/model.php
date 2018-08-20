<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$q_halaman 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PAGE_CLIENT IS NOT NULL AND PAGE = '".$_REQUEST['parameters']."'");
	$dt_halaman	= $db->fetchNextObject($q_halaman);
?>
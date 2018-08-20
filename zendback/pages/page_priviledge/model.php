<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	$q_client_level 	= $db->query("SELECT ID_CLIENT_USER_LEVEL,NAME FROM system_master_client_users_level ORDER BY ID_CLIENT_USER_LEVEL ASC");
?>
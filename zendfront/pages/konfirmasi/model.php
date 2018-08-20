<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$str_bank 		= "SELECT * FROM system_master_bank_info ORDER BY BANK_NAME ASC";
$q_bank 		= $db->query($str_bank);
$q_bank_dest	= $db->query($str_bank);
?>
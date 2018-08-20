<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['condition']))	{ $condition = $sanitize->str($_REQUEST['condition']); 		}
	if(!empty($_REQUEST['value']))		{ $value = $sanitize->str($_REQUEST['value']); 		}
?>
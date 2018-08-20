<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['parameter']))		{ $parameter 	= $sanitize->str($_REQUEST['parameter']); 		}
	if(!empty($_REQUEST['id_category']))	{ $id_category 	= $sanitize->number($_REQUEST['id_category']); 		}
	if(!empty($_REQUEST['id_blog']))		{ $id_blog 	= $sanitize->number($_REQUEST['id_blog']); 		}
?>
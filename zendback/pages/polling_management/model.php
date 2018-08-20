<?php defined('mainload') or die('Restricted Access'); ?>
<?php

	$str_polling = "SELECT * FROM ".$tpref."polling WHERE ID_POLLING IS NOT NULL ORDER BY ID_POLLING DESC";
	$q_polling  = $db->query($str_polling);
	$num_polling = $db->numRows($q_polling);
	if(!empty($direction) && $direction == "edit"){
		$str_polling_edit = "SELECT * FROM ".$tpref."polling WHERE ID_POLLING = '".$id_polling."'";
		$q_polling_edit   = $db->query($str_polling_edit);
		$dt_polling_edit  = $db->fetchNextObject($q_polling_edit);
		$isi 			  = $dt_polling_edit->CONTENT;
		
		$q_option_edit 	  = $db->query("SELECT * FROM ".$tpref."polling_options WHERE ID_POLLING = '".$id_polling."'");
		$c = 0;
		while($dt_option_edit	  = $db->fetchNextObject($q_option_edit)){
			$c++;
			$option[$c] 	= $dt_option_edit->CAPTION;	
			$id_option[$c] 	= $dt_option_edit->ID_POLLING_OPTION;	
		}
		$options = $option;
		
	}
?>
<?php defined('mainload') or die('Restricted Access'); ?>
<?php 
$id_polling		= isset($_REQUEST['id_polling']) 	? $sanitize->number($_REQUEST['id_polling']) 	: "";
$isi			= isset($_REQUEST['isi']) 			? $sanitize->str($_REQUEST['isi']) 				: "";
$options 		= isset($_REQUEST['option']) 		? $_REQUEST['option'] 							: "";

if(!empty($direction) && $direction == "insert"){

	if(!empty($isi) && count($options) > 0){
		$content = array(1=>
					array("CONTENT",$isi),
					array("STATUS","3"),
					array("BY_ID_USER",@$_SESSION['uidkey']), 
					array("UPDATEDATE",$tglupdate));
		$db->insert($tpref."polling",$content);
		$id_polling = mysql_insert_id();
		
		foreach($options as &$option){
			if(!empty($option)){
				$content_option = array(1=>
									array("ID_POLLING",$id_polling),
									array("CAPTION",@$option));
				$db->insert($tpref."polling_options",$content_option);
			}	
		}
		redirect_page($lparam."&msg=1");
	}else{
		$msg = 2;	
	}
}

if(!empty($direction) && $direction == "save"){

	if(!empty($isi) && count($options) > 0){
		$content = array(1=>
					array("CONTENT",$isi),
					array("STATUS",@$status),
					array("BY_ID_USER",@$_SESSION['uidkey']), 
					array("UPDATEDATE",$tglupdate));
		$db->update($tpref."polling",$content," WHERE ID_POLLING = '".$id_polling."'");
		
		$db->delete($tpref."polling_options"," WHERE ID_POLLING = '".$id_polling."'");
		
		foreach($options as &$option){
			if(!empty($option)){
				$content_option = array(1=>
									array("ID_POLLING",$id_polling),
									array("CAPTION",@$option));
				$db->insert($tpref."polling_options",$content_option);
			}	
		}
		redirect_page($lparam."&msg=1");
	}else{
		$msg = 2;	
	}
}
?>

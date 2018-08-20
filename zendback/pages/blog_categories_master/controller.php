<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['nama']))		{ $nama 	= $sanitize->str($_REQUEST['nama']); 		}
	if(!empty($_REQUEST['ori_name']))	{ $ori_name = $sanitize->str($_REQUEST['ori_name']); 		}
	
	if(!empty($direction) && ($direction == "insert" || $direction == "save")){
		if(!empty($nama)){
			
			if(!empty($direction) && $direction == "insert"){ 
				$num_level = $db->recount("SELECT ID_POST_CATEGORY FROM ".$tpref."posts_categories_master WHERE NAME='".$nama."'"); 
				if($num_level == 0){
					$container = array(1=>
						array("NAME",$nama));
					$db->insert($tpref."posts_categories_master",$container);
					redirect_page($lparam."&msg=1");
				}else{
					$msg = 3;
				}
			}
			if(!empty($direction) && $direction == "save"){ 
				$num_level = $db->recount("SELECT ID_POST_CATEGORY FROM ".$tpref."posts_categories_master WHERE NAME='".$nama."'"); 
				if($num_level > 0 && ($ori_name == $nama) || $num_level == 0){
					$container = array(1=>
						array("NAME",$nama));
					$db->update($tpref."posts_categories_master",$container," WHERE ID_POST_CATEGORY='".$no."'");
					redirect_page($lparam."&msg=1");
				}else{
					$msg = 3;
				}
			}
		}else{
			$msg = 2;
		}
	}
?>
<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$single			   = isset($_REQUEST['single'])    ? $sanitize->str($_REQUEST['single']) 					: "";

if(!empty($_REQUEST['id_client_user_level'])) 	{ $id_client_user_level = $sanitize->number($_REQUEST['id_client_user_level']); }
if(!empty($_REQUEST['jmlpage'])) 				{ $jmlpage 				= $sanitize->number($_REQUEST['jmlpage']); 				}

//-----> PROSES INSERT

if(!empty($direction) && $direction == "insert"){
	if(!empty($id_client_user_level)){
		//echo $cid."<br>";
		$i = 0;
		$ori_page_id = $_REQUEST['ori_page_id'];
		foreach($ori_page_id as &$page){
			$i++;

			$chuser = $db->recount("SELECT * FROM system_pages_client_rightaccess WHERE ID_PAGE_CLIENT='".$page."' AND ID_CLIENT_USER_LEVEL='".$id_client_user_level."'");
			if($chuser == 0){
				if(isset($_REQUEST['id_halaman'][$i])){
					$container = array(1=>
						array("ID_PAGE_CLIENT",$_REQUEST['id_halaman'][$i]),
						array("ID_CLIENT_USER_LEVEL",$id_client_user_level));
					 $db->insert("system_pages_client_rightaccess",$container);
				}
			}
			if($chuser > 0){
				if(empty($_REQUEST['id_halaman'][$i])){
					$db->delete("system_pages_client_rightaccess","WHERE ID_PAGE_CLIENT='".$page."' AND ID_CLIENT_USER_LEVEL='".$id_client_user_level."'");
				}
			}
		}
		$msg = 1;
	}
	else{
		$msg = 2;
	}
}
?>
<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(count($parameter) > 0){
		$id_blog = $parameter[1];
	}
	$condition = "";
	if(!empty($id_blog)){
		$condition = " AND ID_POST = '".$id_blog."'";
	}
	if(!empty($id_category)){
		$condition = " AND ID_POST_CATEGORY = '".$id_category."' ORDER BY ID_POST DESC";
		$category 		= $db->fob("NAME",$tpref."posts_categories_master"," WHERE ID_POST_CATEGORY = '".$id_category."'");
	}
	$str_halaman 	= "SELECT * FROM ".$tpref."posts WHERE ID_POST IS NOT NULL ".$condition;
	//echo $str_halaman;
	$q_halaman 		= $db->query($str_halaman);
	
	if(!empty($id_blog)){
		$dt_halaman		= $db->fetchNextObject($q_halaman);
		$category 		= $db->fob("NAME",$tpref."posts_categories_master"," WHERE ID_POST_CATEGORY = '".$dt_halaman->ID_POST_CATEGORY."'");
		$update_time 	= explode("-",$dt_halaman->TGLUPDATE);
		$tgl 			= $update_time[2];
		$bln 			= $update_time[1];
		$thn			= $update_time[0];

		$q_contributor 	= $db->query("SELECT USER_REALNAME,USER_PHOTO from system_users_client WHERE ID_USER = '".$dt_halaman->ID_USER."'");
		$dt_contributor = $db->fetchNextObject($q_contributor);
		@$contributor 	= $dt_contributor->USER_REALNAME;
		@$photo			= $dt_contributor->USER_PHOTO;
		
		$q_previous_post  = $db->query("SELECT ID_POST, TITLE FROM ".$tpref."posts WHERE ID_POST < '".$id_blog."'");
		$dt_previous_post = $db->fetchNextObject($q_previous_post);
		@$id_previous_post= $dt_previous_post->ID_POST;
		@$previous_post	  = $dt_previous_post->TITLE;
	
	
		$q_next_post  	  = $db->query("SELECT ID_POST, TITLE FROM ".$tpref."posts WHERE ID_POST > '".$id_blog."'");
		$dt_next_post 	  = $db->fetchNextObject($q_next_post);
		@$id_next_post	  = $dt_next_post->ID_POST;
		@$next_post	  	  = $dt_next_post->TITLE;
	}
?>
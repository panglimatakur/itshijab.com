<?php
if(!empty($direction) && $direction == "login"){
	if(!empty($_REQUEST['username']))	{ $username = $sanitize->email($_REQUEST['username']); 	}
	if(!empty($_REQUEST['password']))	{ $password = $sanitize->str($_REQUEST['password']); 	}
	if(!empty($username) && !empty($password)){
		$query_str 						= "SELECT * FROM system_users_client WHERE USER_EMAIL = '".trim($username)."' AND USER_PASS ='".trim($password)."'";
		
		$query_login 					= $db->query($query_str);
		$num_login						= $db->numRows($query_login);
		if($num_login > 0){
			$data_login 				= $db->fetchNextObject($query_login);
			$_SESSION['uidkey']			= $data_login->ID_USER;
			$_SESSION['username']		= $data_login->USER_REALNAME;
			$_SESSION['loginname']		= $data_login->USER_EMAIL;
			$_SESSION['ulevelkey']		= $data_login->ID_CLIENT_USER_LEVEL;
			$_SESSION['uidaff']			= $data_login->ID_AFFILIATE;
			
		$query_cstr 					= "SELECT * FROM system_client_info";
		$query_client 					= $db->query($query_cstr);
		$data_client 					= $db->fetchNextObject($query_client);	
		$_SESSION['client_name']		= @$data_client->CLIENT_NAME;
			
			if(is_mod_rewrite_enabled()) {
				redirect_page($dirhost."/cpanel/home");
			}else{
				redirect_page($dirhost."/?module=cpanel&page=user_profile");
			}
		}else{
			//redirect_page($dirhost."/?page=login&msg=2");
		}
	}else{
		//redirect_page($dirhost."/?page=login&msg=3");
	}
}
if(!empty($_SESSION['uidkey'])){
	include $call->inc("zendback/templates/admin","index.php");
}else{
	include $call->inc("zendback/templates/admin","login.php");
}
?>

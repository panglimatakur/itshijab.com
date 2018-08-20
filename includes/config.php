<?php
date_default_timezone_set('Asia/Jakarta');
defined('mainload') or die('Restricted Access');
	$conf = 1;
	if($conf == 1){
		$db_host 		= 'localhost';
		$db_user 		= 'root';
		$db_password 	= '';
		$db_name 		= 'its_hijabdatabase';
		$dirhost		= "http://localhost/itshijab.com";
		$basepath 		= $_SERVER['DOCUMENT_ROOT']."/itshijab.com";
	}
	if($conf == 2){
		$db_host 		= 'localhost';
		$db_user 		= 'www_itshijab_casudab';
		$db_password 	= 'casudabe220889';
		$db_name 		= 'itshijab_its';
		$host 			= substr_count($_SERVER['HTTP_HOST'],"www.");
		if($host > 0){
			$dirhost		= "http://www.itshijab.com";
		}else{
			$dirhost		= "http://itshijab.com";
		}
		$basepath 		= $_SERVER['DOCUMENT_ROOT'];
	} 
	$website_name 	   = "Itshijab";
	$email_admin	   = "admin@itshijab.com";
	$web_template 	   = 'eshopper';
	$file_id 			= substr(md5(rand(0,100000)),0,5);

	$wktupdate		= date("H:i:s");
	$tglupdate 		= date("Y-m-d");
	
	$tpref 			= "cat_";
	$list_per_page 	= 30;
	$realtime		= 1;
	$permalink 		= 0;
	$fb_api			= "382155588789810";
	$fb_secret		= "1b5cbbdb076c0835d8ec980efec4d6fe";
	$user_token 	= "EAAFbkYgeZAjIBAH5BIXQ9txZC602ayjIjGYXifuZCTozVG2eebaAAZCM7m6j557lopLfdw25kgjaKS0CgDYH3iSDIIDeVoSUzSZA7yGBlZA2Tz5KmaTzc1kmNDgZBafMOuJkd2k2TI5PmCLW1izFOGjywXZBfbB4jx6SCPHKYRIkNQZDZD";
	$app_token 		= "382155588789810|77oV-j1qLPYqIY1Vy5G7snLJkbc";
	
	$ip_address 		= $_SERVER['REMOTE_ADDR'];
?>

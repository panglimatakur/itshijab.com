<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['nama']))		{ $nama 		= $sanitize->str($_REQUEST['nama']); 		}
	if(!empty($_REQUEST['namap']))		{ $namap 		= $sanitize->str($_REQUEST['namap']); 		}
	if(!empty($_REQUEST['alamat']))		{ $alamat 		= $sanitize->str($_REQUEST['alamat']); 		}
	if(!empty($_REQUEST['tlp']))		{ $tlp 			= $sanitize->str($_REQUEST['tlp']); 		}
	if(!empty($_REQUEST['tptlhr']))		{ $tptlhr 		= $sanitize->str($_REQUEST['tptlhr']); 		}
	if(!empty($_REQUEST['tgllhr']))		{ 
		$tgllhr 	= $sanitize->str($_REQUEST['tgllhr']); 
		$tgllhir	= $dtime->indodate2date($tgllhr);
	}
	if(!empty($_REQUEST['email']))		{ $email 		= $sanitize->email($_REQUEST['email']); 	}
	if(!empty($_REQUEST['upassword']))	{ $upassword 	= $_REQUEST['upassword']; 					}
	if(!empty($_REQUEST['kupassword']))	{ $kupassword 	= $_REQUEST['kupassword']; 					}
	if(!empty($_REQUEST['gender']))		{ $gender 		= $sanitize->str($_REQUEST['gender']); 		}
	if(!empty($_FILES['photo']['name'])){ $photo 		= $_FILES['photo']['name']; 												}
	
	if(!empty($_REQUEST['id_user_level'])){ $id_user_level 		= $sanitize->str($_REQUEST['id_user_level']); 	}
	
	if(!empty($direction) && ($direction == "insert" || $direction == "save")){
		if(!empty($nama) && !empty($tlp) && !empty($email) && !empty($gender) && !empty($upassword) && !empty($kupassword)){
				
			if(!empty($direction) && $direction == "insert"){
				if($upassword == $kupassword){ 
					$num_user = $db->recount("SELECT * FROM system_users_client WHERE USER_EMAIL = '".$email."'");
					if($num_user == 0){
						if(!empty($photo)){
							$filename = $file_id."-".$photo;
							$img 		= getimagesize($_FILES['photo']['tmp_name']);
							$img_width	= $img[0];
							move_uploaded_file($_FILES['photo']['tmp_name'],$basepath."/files/images/users/".$filename);
							copy($basepath."/files/images/users/".$filename,$basepath."/files/images/users/big/".$filename);
							if($img_width > 600){
								$cupload->resizeupload($basepath."/files/images/users/big/".$filename,$basepath."/files/images/users/big",400,$prefix = false);
							}
							$cupload->resizeupload($basepath."/files/images/users/".$filename,$basepath."/files/images/users",200,$prefix = false);
						}
						$last_id 		= $db->last("ID_USER","system_users_client","");
						$affilite_id 	= substr(strtolower($nama),0,6).".".sprintf("%03d",$last_id);	
						@$api_key		= sha1($email);
						$container = array(1=>
										array("ID_AFFILIATE",@$last_id),
										array("API_KEY",@$api_key),
										array("ID_CLIENT_USER_LEVEL","2"),
										array("USER_REALNAME",@$nama),
										array("USER_NICKNAME",@$namap),
										array("USER_PASS",@$upassword),
										array("USER_PHOTO",@$filename),
										array("USER_EMAIL",@$email),
										array("USER_PHONE",@$tlp),
										array("USER_ADDRESS",@$alamat),
										array("BIRTH_PLACE",@$tptlhr),
										array("BIRTH_DATE",@$tgllhir),
										array("USER_GENDER",@$gender),
										array("USER_STATUS","3"),
										array("UPDATEDATE",@$tglupdate),
										array("UPDATETIME",@$wktupdate));
						$db->insert("system_users_client",$container);
						redirect_page($lparam."&msg=1");
					}else{
						$msg = 4;	
					}
				}else{
					$msg = 3;	
				}
			}
			
		}else{
			$msg = 2;
		}
	}
?>
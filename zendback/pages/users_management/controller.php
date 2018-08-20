<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['nama']))		{ $nama 	= $sanitize->str($_REQUEST['nama']); 		}
	if(!empty($_REQUEST['namap']))		{ $namap 	= $sanitize->str($_REQUEST['namap']); 		}
	if(!empty($_REQUEST['alamat']))		{ $alamat 	= $sanitize->str($_REQUEST['alamat']); 		}
	if(!empty($_REQUEST['tlp']))		{ $tlp 		= $sanitize->str($_REQUEST['tlp']); 		}
	if(!empty($_REQUEST['tptlhr']))		{ $tptlhr 	= $sanitize->str($_REQUEST['tptlhr']); 		}
	if(!empty($_REQUEST['tgllhr']))		{ 
		$tgllhr 	= $sanitize->str($_REQUEST['tgllhr']); 
		$tgllhir	= $dtime->indodate2date($tgllhr);
	}
	if(!empty($_REQUEST['email']))		{ $email 	= $sanitize->email($_REQUEST['email']); 	}
	if(!empty($_REQUEST['upassword']))	{ $upassword = $sanitize->str($_REQUEST['upassword']); 		}
	if(!empty($_REQUEST['gender']))		{ $gender 	= $sanitize->str($_REQUEST['gender']); 	}
	if(!empty($_FILES['photo']['name'])){ $photo 	= $_FILES['photo']['name']; 												}
	
	if(!empty($_REQUEST['id_user_level'])){ $id_user_level 		= $sanitize->str($_REQUEST['id_user_level']); 	}
	
	if(!empty($direction) && ($direction == "insert" || $direction == "save")){
		if(!empty($nama) && !empty($namap) && !empty($alamat) && !empty($tlp) && !empty($tptlhr) 
			&& !empty($tgllhr) && !empty($email) && !empty($gender) && !empty($id_user_level)){
				
			if(!empty($direction) && $direction == "insert"){
				if(!empty($upassword)){ 
				
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
					
						$container = array(1=>
										array("ID_CLIENT_USER_LEVEL",@$id_user_level),
										array("USER_NAME",@$nama),
										array("USER_NICKNAME",@$namap),
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
					$msg = 2;	
				}
			}
			if(!empty($direction) && $direction == "save"){ 
				$q_ori		= $db->query("SELECT * FROM system_users_client WHERE ID_USER='".$no."'");
				$dt_ori		= $db->fetchNextObject($q_ori);
				$photori 	= $dt_ori->USER_PHOTO;
				$passori	= $dt_ori->USER_PASS;
				$emailori 	= $dt_ori->USER_EMAIL;
				
				$num_user = $db->recount("SELECT * FROM system_users_client WHERE EMAIL_USER = '".$email."'");
				if(($num_user > 0 && $emailori == $email) || ($num_user == 0 && $emailori != $email)){
					
					if(empty($upassword)){
						$upassword = $passori;	
					}
					if(!empty($photo)){
						if(is_file($basepath."/files/images/users/".$photori)){
							unlink($basepath."/files/images/users/".$photori);
							unlink($basepath."/files/images/users/big/".$photori);
						}
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
					else{ $filename = $photori; }
					
					$container = array(1=>
									array("ID_CLIENT_USER_LEVEL",@$id_user_level),
									array("USER_NAME",@$nama),
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
					$db->update("system_users_client",$container," WHERE ID_USER='".$no."' ");
					redirect_page($lparam."&msg=1");
					
					
				}else{
					$msg = 4;	
				}
				
			}
			
		}else{
			$msg = 2;
		}
	}
?>
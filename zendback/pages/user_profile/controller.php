<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['fname'])) 		{ $fname 		= $sanitize->str($_REQUEST['fname']); 			}
	if(!empty($_REQUEST['password'])) 	{ $password 	= $sanitize->str($_REQUEST['password']); 		}
	if(!empty($_REQUEST['email'])) 		{ $email 		= $sanitize->str($_REQUEST['email']); 			}
	if(!empty($_REQUEST['gender']))		{ $gender 		= $sanitize->str($_REQUEST['gender']); 			}
	if(!empty($_REQUEST['alamat'])) 	{ $alamat 		= $sanitize->str($_REQUEST['alamat']); 			}
	if(!empty($_REQUEST['phone'])) 		{ $phone 		= $sanitize->str($_REQUEST['phone']); 			}
		
	if(!empty($_REQUEST['tptlhr']))		{ $tptlhr 	= $sanitize->str($_REQUEST['tptlhr']); 		}
	if(!empty($_REQUEST['tgllhr']))		{ 
		$tgllhr 	= $sanitize->str($_REQUEST['tgllhr']); 
		$tgllhir	= $dtime->indodate2date($tgllhr);
	}
	if(!empty($_FILES['photo']['name'])){ $photo 		= $_FILES['photo']['name']; 					}

if(!empty($direction) && $direction == "save"){

		if(!empty($fname) && !empty($alamat) && !empty($phone) && !empty($tptlhr) 
			&& !empty($tgllhr) && !empty($email) && !empty($gender)){	
				$q_ori		= $db->query("SELECT * FROM system_users_client WHERE ID_USER='".$_SESSION['uidkey']."'");
				$dt_ori		= $db->fetchNextObject($q_ori);
				$photori 	= $dt_ori->USER_PHOTO;
				$passori	= $dt_ori->USER_PASS;
				$emailori	= $dt_ori->USER_EMAIL;
				
				$num_user = $db->recount("SELECT * FROM system_users_client WHERE USER_EMAIL = '".$email."'");
				if(($num_user > 0 && $emailori == $email) || ($num_user == 0 && $emailori != $email)){
				
					if(empty($password)){
						$password = $passori;	
					}
					if(!empty($photo)){
						unlink($basepath."/files/images/users/".$photori);
						unlink($basepath."/files/images/users/big/".$photori);
						$filename = $file_id."-".$photo;
						$img 		= getimagesize($_FILES['photo']['tmp_name']);
						$img_width	= $img[0];
						move_uploaded_file($_FILES['photo']['tmp_name'],$basepath."/files/images/users/".$filename);
						copy($basepath."/files/images/users/".$filename,$basepath."/files/images/users/big/".$filename);
						if($img_width > 400){
							$cupload->resizeupload($basepath."/files/images/users/big/".$filename,$basepath."/files/images/users/big",400,$prefix = false);
						}
						$cupload->resizeupload($basepath."/files/images/users/".$filename,$basepath."/files/images/users",70,$prefix = false);
					}
					else{ $filename = $photori; }
		
					$container = array(1=>
									array("USER_NAME",@$fname),
									array("USER_PASS",@$password),
									array("USER_PHOTO",@$filename),
									array("USER_EMAIL",@$email),
									array("USER_PHONE",@$phone),
									array("USER_GENDER",@$gender),
									array("USER_ADDRESS",@$alamat),
									array("BIRTH_PLACE",@$tptlhr),
									array("BIRTH_DATE",@$tgllhir));
					$db->update("system_users_client",$container," WHERE ID_USER='".$_SESSION['uidkey']."' ");
					//redirect_page($lparam."&msg=1");
				
				}else{
					$msg = 4;	
				}
		}else{
			$msg = 2;	
		}
	}
?>
<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['fname'])) 		{ $fname 		= $sanitize->str($_REQUEST['fname']); 			}
	if(!empty($_REQUEST['lname']))		{ $lname 		= $sanitize->str($_REQUEST['lname']); 			}
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
	if(!empty($_FILES['photo']['name'])){ $photo 		= $_FILES['photo']['name']; 												}

if(!empty($direction) && $direction == "insert"){

		if(!empty($fname) && !empty($lname) && !empty($alamat) && !empty($phone) && !empty($tptlhr) 
			&& !empty($tgllhr) && !empty($email) && !empty($gender)){	
				
				$num_user = $db->recount("SELECT * FROM system_users_client WHERE USER_EMAIL = '".$email."'");
				if($num_user == 0){
		
					$container = array(1=>
									array("USER_REALNAME",@$fname),
									array("USER_NICKNAME",@$lname),
									array("USER_PASS",@$password),
									array("USER_PHOTO",@$filename),
									array("USER_EMAIL",@$email),
									array("USER_PHONE",@$phone),
									array("USER_GENDER",@$gender),
									array("USER_ADDRESS",@$alamat),
									array("BIRTH_PLACE",@$tptlhr),
									array("BIRTH_DATE",@$tgllhir));
					$db->insert("system_users_client",$container);
					redirect_page($lparam."&msg=1");
				
				}else{
					$msg = 4;	
				}
		}else{
			$msg = 2;	
		}
	}
?>
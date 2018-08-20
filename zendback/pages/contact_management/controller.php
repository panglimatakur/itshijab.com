<?php defined('mainload') or die('Restricted Access'); ?>
<?php

if(!empty($_REQUEST['name'])) 		{ $name 		= $_REQUEST['name']; 		$name 		= $sanitize->str($name); 			}
if(!empty($_REQUEST['email'])) 		{ $email 		= $_REQUEST['email']; 		$email 		= $sanitize->str($email); 			}

if(!empty($_REQUEST['alamat'])) 	{ $alamat 		= $_REQUEST['alamat']; 		$alamat 	= $sanitize->str($alamat); 			}
if(!empty($_REQUEST['phone'])) 		{ $phone 		= $_REQUEST['phone']; 		$phone 		= $sanitize->str($phone); 			}
if(!empty($_REQUEST['additional'])) { $additional 	= $_REQUEST['additional']; 	}
if(!empty($_REQUEST['peta'])) 		{ $peta 		= $_REQUEST['peta']; 		}

if(!empty($_FILES['photo']['name'])){ $photo 		= $_FILES['photo']['name']; 												}

if(!empty($_REQUEST['bcarek'])) 		{ $bcarek 		= $sanitize->str($_REQUEST['bcarek']); 			}
if(!empty($_REQUEST['bcaname'])) 		{ $bcaname 		= $sanitize->str($_REQUEST['bcaname']); 		}
if(!empty($_REQUEST['mandirirek'])) 	{ $mandirirek 	= $sanitize->str($_REQUEST['mandirirek']); 		}
if(!empty($_REQUEST['mandiriname'])) 	{ $mandiriname 	= $sanitize->str($_REQUEST['mandiriname']); 	}

if(!empty($direction) ){
		if(!empty($name) && !empty($email) && !empty($phone) && !empty($alamat)){	
		
			if($direction == "save"){
				$q_ori		= $db->query("SELECT * FROM system_client_info");
				$dt_ori		= $db->fetchNextObject($q_ori);
				$photori 	= $dt_ori->CLIENT_LOGO;
				if(!empty($photo)){
					unlink($basepath."/files/images/users/".$photori);
					unlink($basepath."/files/images/".$photori);
					$filename = $file_id."-".$photo;
					move_uploaded_file($_FILES['photo']['tmp_name'],$basepath."/files/images/".$filename);
				}
				else{ $filename = $photori; }
	
				$container = array(1=>
								array("CLIENT_NAME",@$name),
								array("CLIENT_LOGO",@$filename),
								array("CLIENT_EMAIL",@$email),
								array("CLIENT_PHONE",@$phone),
								array("CLIENT_ADDRESS",@$alamat),
								array("REK_BCA_ACCOUNT",@$bcarek),
								array("REK_BCA_NAME",@$bcaname),
								array("REK_MANDIRI_ACCOUNT",@$mandirirek),
								array("REK_MANDIRI_NAME",@$mandiriname),
								array("MAP_FRAME",mysql_real_escape_string(@$peta)),
								array("ADDITIONAL_INFO",@$additional));
				$db->update("system_client_info",$container,"  ");
				redirect_page($lparam."&msg=1");
			}
			
			if($direction == "insert"){
				if(!empty($photo)){
					$filename = $file_id."-".$photo;
					move_uploaded_file($_FILES['photo']['tmp_name'],$basepath."/files/images/".$filename);
				}
				
	
				$container = array(1=>
								array("CLIENT_NAME",@$name),
								array("CLIENT_LOGO",@$filename),
								array("CLIENT_EMAIL",@$email),
								array("CLIENT_PHONE",@$phone),
								array("CLIENT_ADDRESS",@$alamat),
								array("REK_BCA_ACCOUNT",@$bcarek),
								array("REK_BCA_NAME",@$bcaname),
								array("REK_MANDIRI_ACCOUNT",@$mandirirek),
								array("REK_MANDIRI_NAME",@$mandiriname),
								array("MAP_FRAME",mysql_real_escape_string(@$peta)),
								array("ADDITIONAL_INFO",@$additional));
				$db->insert("system_client_info",$container);
				redirect_page($lparam."&msg=1");
			}
		}else{
			$msg = 2;	
		}
	}
?>
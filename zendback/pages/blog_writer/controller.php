<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$tblnya = "cat_blog";
$news_cat 			= isset($_REQUEST['news_cat']) 			? $sanitize->str($_REQUEST['news_cat'])			:""; 	
$judul 				= isset($_REQUEST['judul']) 			? $sanitize->str($_REQUEST['judul'])			:""; 	
$edit_keywords 		= isset($_REQUEST['edit_keywords']) 	? $sanitize->str($_REQUEST['edit_keywords'])	:""; 	
$edit_description 	= isset($_REQUEST['edit_description']) 	? $sanitize->str($_REQUEST['edit_description'])	:""; 	
$isi 				= isset($_REQUEST['isi']) 				? $_REQUEST['isi']								:""; 	
$halaman 			= isset($_REQUEST['halaman']) 			? $sanitize->str($_REQUEST['halaman'])			:""; 	
$status 			= isset($_REQUEST['status']) 			? $sanitize->str($_REQUEST['status'])			:""; 	
		
if(!empty($_FILES['icon']['tmp_name'])) { $icon 	= $_FILES['icon']['name']; 	}


if(!empty($direction) && ($direction == "save" || $direction == "insert")){
		
	if(!empty($isi) && !empty($judul)){
		$halaman = permalink($judul,"_");
		if($direction == "insert"){
			if(!empty($icon)){
				$filename = $file_id."-".$icon;
				move_uploaded_file($_FILES['icon']['tmp_name'],$basepath."/files/images/".$filename);	
			}else{
				$filename = "";
			}
			$content = array(1=>
						array("ID_POST_CATEGORY",$news_cat),
						array("TITLE",$judul),
						array("KEYWORDS",$edit_keywords),
						array("DESCRIPTION",$edit_description),
						array("CONTENT",mysql_real_escape_string($isi)),
						array("PAGE",$halaman),
						array("ICON",$filename),
						array("STATUS",@$status),
						array("ID_USER",@$_SESSION['uidkey']),
						array("TGLUPDATE",date("Y-m-d G:i:s")));
			$db->insert($tblnya,$content);
			redirect_page($lparam."&msg=1");
		}	
			

		if($direction == "save"){	
			$iconori = $db->fob("ICON",$tblnya,"WHERE ID_POST = '".$no."'");
			if(!empty($icon)){
				unlink($basepath."/files/images/blogs/".$iconori);
				$filename = $file_id."-".$icon;
				move_uploaded_file($_FILES['icon']['tmp_name'],$basepath."/files/images/".$filename);	
			}
			else{ $filename = $iconori; }
			
			$content = array(1=>
						array("ID_POST_CATEGORY",$news_cat),
						array("TITLE",$judul),
						array("KEYWORDS",$edit_keywords),
						array("DESCRIPTION",$edit_description),
						array("CONTENT",mysql_real_escape_string($isi)),
						array("PAGE",$halaman),
						array("ICON",$filename),
						array("STATUS",@$status),
						array("ID_USER",@$_SESSION['uidkey']),
						array("TGLUPDATE",date("Y-m-d G:i:s"))
					   );
			$db->update($tblnya,$content,"WHERE ID_POST='".$no."'");
			redirect_page($lparam."&msg=2");
		}
	}
	else{
		echo msg("Pengisian Form Belum Lengkap","error");	
	}
}

?>

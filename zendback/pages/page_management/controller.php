<?php defined('mainload') or die('Restricted Access'); ?>
<?php
$tblnya = "system_pages_client";
if(isset($_REQUEST['is_default'])) 			{ $is_default 		= $sanitize->str($_REQUEST['is_default']); 			}
if(isset($_REQUEST['parent_id'])) 			{ $parent_id 		= $sanitize->str($_REQUEST['parent_id']);	 		}
if(isset($_REQUEST['id_module'])) 			{ $id_module 		= $sanitize->str($_REQUEST['id_module']);	 		}
if(isset($_REQUEST['idhalaman'])) 			{ $idhalaman 		= $sanitize->str($_REQUEST['idhalaman']);			}

if(isset($_REQUEST['nama'])) 				{ $nama 			= $sanitize->str($_REQUEST['nama']);				}
if(isset($_REQUEST['judul'])) 				{ $judul 			= $sanitize->str($_REQUEST['judul']); 				}
if(isset($_REQUEST['edit_keywords'])) 		{ $edit_keywords 	= $sanitize->str($_REQUEST['edit_keywords']); 		}
if(isset($_REQUEST['edit_description'])) 	{ $edit_description	= $sanitize->str($_REQUEST['edit_description']); 	}
if(isset($_REQUEST['isi'])) 				{ $isi 				= $_REQUEST['isi']; 		}
if(isset($_REQUEST['halaman'])) 			{ $halaman 			= $sanitize->str($_REQUEST['halaman']); 			}
if(isset($_REQUEST['posisi'])) 				{ $posisi 			= $sanitize->str($_REQUEST['posisi']); 				}
if(isset($_REQUEST['is_folder'])) 			{ $is_folder 		= $sanitize->str($_REQUEST['is_folder']); 	 		}
if(isset($_REQUEST['contenttype'])) 		{ $contenttype 		= $sanitize->str($_REQUEST['contenttype']); 		}

if(isset($_REQUEST['status'])) 				{ $status 			= $sanitize->str($_REQUEST['status']); 				}
if(isset($_REQUEST['depth'])) 				{ $depth 			= $sanitize->str($_REQUEST['depth']); 				}
if(!empty($_FILES['icon']['tmp_name'])) 	{ $icon 			= $_FILES['icon']['name']; 							}


if(!empty($direction) && ($direction == "save" || $direction == "insert")){
		
	if(!empty($nama) && !empty($judul)){ // && !empty($posisi) && !empty($id_module)
		$halaman = permalink($nama,"_");
		if(!empty($parent_id)){  $depth = $db->fob("DEPTH",$tblnya," WHERE ID_PAGE_CLIENT = '".$parent_id."'")+1; }else{ $depth='1'; }
		if(empty($contenttype)){ $contenttype = "folder"; }
		$enc	= substr(md5(rand(0,100)),0,8);
		
		if($direction == "insert"){
			$seri 	= $db->last("SERI",$tblnya," WHERE DEPTH='".$depth."'")+1;
			if(!empty($icon)){
				$filename = $file_t."-".$icon;
				move_uploaded_file($_FILES['icon']['tmp_name'],$basepath."/files/images/icons/".$filename);	
			}else{
				$filename = "";
			}
			$content = array(1=>
						array("TYPE",$contenttype),
						array("SERI",$seri),
						array("POSITION",$posisi),
						array("DEPTH",$depth),
						array("NAME",$nama),
						array("TITLE",$judul),
						array("KEYWORDS",$edit_keywords),
						array("DESCRIPTION",$edit_description),
						array("CONTENT",mysql_real_escape_string($isi)),
						array("ID_MODULE",$id_module),
						array("PAGE",$halaman),
						array("ID_PARENT",@$parent_id),
						array("IS_FOLDER",$is_folder),
						array("ICON",@$filename),
						array("STATUS",@$status),
						array("TGLUPDATE",date("Y-m-d G:i:s")));
			$db->insert($tblnya,$content);
			if($id_module == 2){ $pos = "zendback"; }else{ $pos = "zendfront"; } 
			$mode = chmod($basepath."/".$pos."/pages/",0777);
			if($contenttype == "dinamis"){ 
				mkdir($basepath."/".$pos."/pages/".$halaman);
			}
			
			redirect_page($lparam."&msg=1");
		}	
			

		if($direction == "save"){	
			@$oldhalaman 	= $db->fob("PAGE",$tblnya,"where ID_PAGE_CLIENT = '".$no."'"); 
			if($id_module == 2){ $pos = "zendback"; }else{ $pos = "zendfront"; } 
			if($contenttype == "dinamis"){ 
				if(is_dir($basepath."/".$pos."/pages/".$oldhalaman)){
					rename($basepath."/".$pos."/pages/".$oldhalaman,$basepath."/".$pos."/pages/".$halaman); 
				}
			} 

			$iconori = $db->fob("ICON",$tblnya," WHERE ID_PAGE_CLIENT='".$no."'");
			if(!empty($icon)){
				unlink($basepath."/files/images/icons/".$iconori);
				$filename = $file_t."-".$icon;
				move_uploaded_file($_FILES['icon']['tmp_name'],$basepath."/files/images/icons/".$filename);	
			}
			else{ $filename = $iconori; }
			
			$content = array(1=>
						array("TYPE",@$contenttype),
						array("POSITION",@$posisi),
						array("DEPTH",@$depth),
						array("NAME",@$nama),
						array("TITLE",@$judul),
						array("KEYWORDS",$edit_keywords),
						array("DESCRIPTION",$edit_description),
						array("CONTENT",mysql_real_escape_string($isi)),
						array("ID_MODULE",@$id_module),
						array("PAGE",@$halaman),
						array("ID_PARENT",@$parent_id),
						array("IS_FOLDER",@$is_folder),
						array("ICON",@$filename),
						array("STATUS",@$status),
						array("TGLUPDATE",date("Y-m-d G:i:s"))
					   );
			$db->update($tblnya,$content,"WHERE ID_PAGE_CLIENT = '".$no."'");
			redirect_page($lparam."&msg=2");
		}
	}
	else{
		echo msg("Pengisian Form Belum Lengkap","error");	
	}
}

?>

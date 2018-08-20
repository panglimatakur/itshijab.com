<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['search'])) 		{ $search 			= $sanitize->str($_REQUEST['search']); 			}
	if(!empty($_REQUEST['source'])) 		{ $source 			= $sanitize->str($_REQUEST['source']); 			}
	if(!empty($_REQUEST['youtube']))	 	{ $youtube 			= $_REQUEST['youtube']; 						}
	if(!empty($_REQUEST['link']))    		{ $link    			= $sanitize->url($_REQUEST['link']); 			}
	if(!empty($_REQUEST['banner_type']))   	{ $banner_type 		= $sanitize->number($_REQUEST['banner_type']);	}
	if(!empty($_REQUEST['btitle']))  		{ $btitle 			= $sanitize->str($_REQUEST['btitle']);}
	if(!empty($_REQUEST['bdesc']))  		{ $bdesc 			= $sanitize->str($_REQUEST['bdesc']);}

	if(!empty($_REQUEST['filter_source']))  { $filter_source 	= $sanitize->str($_REQUEST['filter_source']); 	}
	if(!empty($_REQUEST['fbanner_type']))  	{ $fbanner_type 	= $sanitize->number($_REQUEST['fbanner_type']);}
	 
	
	if(!empty($direction) && $direction == "insert"){
		if(!empty($source) && !empty($banner_type)){
			$done = 0;
			if($source == "unggah"){
				$images = $_FILES['image']['name'];
				$filetarget = $file_id."-".$images;
			}
			if($source == "link"){
				if(!empty($link)){
					$filetarget = $link;
				}
			}
			
			if($source == "unggah" || $source == "link"){
				$ext		= pathinfo($filetarget);
				$extension 	= $ext['extension'];
				if($extension == "mp4"  ||
				   $extension == "MP4"  || 
				   $extension == "mpeg" ||
				   $extension == "MPEG" || 
				   $extension == "3gp"	||
				   $extension == "3GP"){
					$type = "video";
					$done = 1;
				}
				
				if($extension == "jpg"  ||
				   $extension == "JPG"  || 
				   $extension == "gif" ||
				   $extension == "GIF" || 
				   $extension == "png"	||
				   $extension == "PNG"){
					$type = "photo";
					$done = 1;
				}
			}
			
			if($source == "youtube"){
				if(!empty($youtube)){
					$html 		= htmlspecialchars($youtube);
					$fsize 		= array("560","315");
					$nfsize 	= array("100%","315");
					$newphrase 	= str_replace($fsize, $nfsize, $html);
					$filetarget = mysql_escape_string(htmlspecialchars_decode($newphrase));
					$type		= "video";
					$done = 1;
				}
			}
			if($done == 1){
				if($source == "unggah"){
					move_uploaded_file($_FILES['image']['tmp_name'],$basepath."/files/images/banners/".$filetarget); 
				}
				$image_content 	= array(1=>
								    array("SOURCE",$source),
									array("FILETARGET",$filetarget),
									array("ID_BANNER_TYPE",$banner_type),
									array("TITLE",@$title),
									array("DESCRIPTION",@$content),
									array("TYPE",$type));
				$db->insert($tpref."banner",$image_content);
				redirect_page($lparam."&msg=1");
			}else{
				$msg = 2;
			}
		}else{
			$msg = 2;
		}	
	}
	
		
	
?>
<?php
defined('mainload') or die('Restricted Access');
class templ{
	function top_menu($id_parent){
		global $dirhost;
		global $db;
		global $permalink;
			$q_top_menu 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PARENT='".$id_parent."' AND ID_PAGE_CLIENT != '1' AND ID_MODULE = '1' AND POSITION = 'top' ORDER BY ID_MODULE ASC, SERI ASC");
			$num_top_menu	= $db->numRows($q_top_menu);
			if($num_top_menu >0){
			?>
			<ul  class="mega-menu">
				<?php while($dt_top_menu = $db->fetchNextObject($q_top_menu)){ 
						if($dt_top_menu->IS_FOLDER == 1){ 
							$url_link = "javascript:void()";	
						}else{
							if(@$permalink == 1){
								if($dt_top_menu->TYPE == "statis"){
									$url_link = $dirhost."/statis/".$dt_top_menu->PAGE;	
								}else{
									$url_link = $dirhost."/".$dt_top_menu->PAGE;	 
								}
							}else{
								if($dt_top_menu->TYPE == "statis"){
									$url_link = $dirhost."?page=statis&parameters=".$dt_top_menu->PAGE;	
								}else{
									$url_link = $dirhost."?page=".$dt_top_menu->PAGE;	 
								}
							}
						}				
				?>
					<li class="sub-menu" style="padding:10px 10px 10px 20px ; margin:0">
						<ul>
                        	<li>
                                <a href="<?php echo $url_link; ?>">
                                    <?php echo strtoupper($dt_top_menu->NAME); ?>
                                </a>
                            </li>
                        </ul>
						<?php //echo $this->top_menu($dt_top_menu->ID_PAGE_CLIENT); ?>
					</li>
				<?php } ?>
			</ul>
		<?php 
			}
	}
	
	public function metatags($id_page){
		global $db;
		global $dirhost;
		global $website_name;

		global $spage;
		global $tgl_article;
		
		if(!empty($spage)){
			$id_page 	= $db->fob("No","system_pages_client_website"," WHERE HALAMAN='".trim($spage)."'");
		}
		$q_meta 	= "SELECT COVER,METATITLE,METAKEYWORDS,METADESCRIPTION FROM system_pages_client_website_content WHERE ID_PAGE_CLIENT = '".trim($id_page)."'";
		$qpage 		= $db->query($q_meta);
		$dtpage		= $db->fetchNextObject($qpage);
		?>
<title><?php echo @$dtpage->METATITLE; ?></title>
<meta name="keywords" content="<?php echo @$dtpage->METAKEYWORDS; ?>"/>
<meta name="description" content="<?php echo @$dtpage->METADESCRIPTION; ?>"/>
<meta property="og:title" content="<?php echo @$dtpage->METATITLE; ?>"/>
<?php if(!empty($dtpage->COVER) && is_file($basepath."/files/images/".$dtpage->COVER)){
	$og_image = $dirhost."/files/images/".$dtpage->COVER;
}else{
	$og_image = $dirhost."/files/images/recentnews_icon.png";
}?>
<meta property="og:image" content="<?php echo @$og_image; ?>"/> 
<meta property="og:site_name" content="<?php echo @$website_name; ?>"/>
<meta property="og:description" content="<?php echo @$dtpage->METADESCRIPTION; ?>"/>
<?php 
if(($spage == "blog" && empty($spage)) || ($spage == "blog" && !empty($tgl_blog))){
	$index 	= "NOINDEX";
	$follow = "FOLLOW";
}else{
	$index 	= "INDEX";
	$follow = "FOLLOW";
}
?>
<meta name="robots" content="<?php echo $index; ?>, <?php echo $follow; ?>">
		<?php
	}
	
	public function get_pageinfo($id_page){
		global $db;
		$qpage 			= $db->query("SELECT * FROM system_pages_client_user WHERE No = '".trim($id_page)."'");
		$dtpage			= $db->fetchNextObject($qpage);
		return json_encode($dtpage);
	}
	public function get_content($id_page){
		global $db;
		$qpage 		= $db->query("SELECT ISI FROM system_pages_client_user_sitecontent WHERE ID_PAGE_CLIENT = '".trim($id_page)."'");
		$dtpage		= $db->fetchNextObject($qpage);
		$content	= $dtpage->ISI;
		return $content;
	}
}

$tpl = new templ();
?>

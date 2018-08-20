<?php
if(!defined('mainload')) { define('mainload','SEMPOA',true); }
include_once('includes/config.php');
include_once('includes/classes.php');
include $call->inc("includes/classes","class.templates.php");
include_once('includes/functions.php');
include_once('includes/declarations.php');
header("Content-type: text/xml");
echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset
      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";

function top_menu($id_parent){
	global $dirhost;
	global $db;
	@$child = $db->fob("ID_PAGE_CLIENT","system_pages_client","WHERE ID_PARENT='".$id_parent."' AND STATUS='1'");
	if(!empty($child)){
		$qmenu 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PARENT = '".$id_parent."' AND STATUS='1' ORDER BY SERI ASC");
		while($dtmenu = $db->fetchNextObject($qmenu)){ 
			$lpage 	 = "";
			if($dtmenu->IS_FOLDER == 1){
				$url_link = "javascript:void()";	
			}else{
				if($dtmenu->TYPE == "statis"){ $lpage = "statis/"; }
				$url_link = $dirhost."/website/".@$lpage."".$dtmenu->PAGE;	
			}
			if($dtmenu->IS_FOLDER != 1){
echo "
<url>
  <loc>".$url_link."</loc>
  <lastmod>2017-05-29T16:24:35+00:00</lastmod>
  <changefreq>always</changefreq>
  <priority>0.80</priority>
</url>";
			}
echo top_menu($dtmenu->ID_PAGE_CLIENT);
		}
	}
}
?>

<?php
		$qtop_menu = $db->query("SELECT * FROM system_pages_client WHERE ID_PARENT = '0' AND ID_MODULE = '1' AND STATUS='1' ORDER BY SERI");
		while($dtop_menu = $db->fetchNextObject($qtop_menu)){
			$id_parent = "";
			$lpage 	 = "";
			$id_parent = $dtop_menu->ID_PAGE_CLIENT;
			if($dtop_menu->IS_FOLDER == 1){
				$url_link = "javascript:void()";	
			}else{
				if($dtop_menu->TYPE == "statis"){ $lpage = "statis/"; }
				$url_link = $dirhost."/website/".@$lpage."".$dtop_menu->PAGE;	
			}
			if($dtop_menu->IS_FOLDER != 1){
echo "
<url>
  <loc>".$url_link."</loc>
  <lastmod>2017-05-29T16:24:35+00:00</lastmod>
  <changefreq>always</changefreq>
  <priority>0.80</priority>
</url>";
			}
echo top_menu($id_parent);
		} ?>
<?php
		/*$str_product = " SELECT * FROM ".$tpref."products ORDER BY ID_PRODUCT";
		$q_product = $db->query($str_product);
		while($dt_product = $db->fetchNextObject($q_product)){
			$url_link = $dirhost."/detail/".$dt_product->ID_PRODUCT;	
echo "
<url>
  <loc>".$url_link."</loc>
  <lastmod>2017-05-29T16:24:35+00:00</lastmod>
  <changefreq>always</changefreq>
  <priority>0.80</priority>
</url>";
		}*/ ?>
<?php

echo "</urlset>";
?>
<?php defined("mainload") or die("Restricted Access"); ?>
<?php
function visitor_log($activity){
	global $db;
	global $tpref;
	global $wktupdate;
	global $tglupdate;
	global $ip_address; 
	global $file_id;
	$log_container	= array(1=>
						array("ACTIVITY",mysql_real_escape_string(@$activity)),
						array("IP_ADDRESS",@$ip_address),
						array("SESSION",@$file_id),
						array("UPDATEDATE",$tglupdate),
						array("UPDATETIME",$wktupdate));
	$db->insert($tpref."visitor_logs",$log_container);
}

function billing_support(){
	global $dirhost;
	echo '
	<fieldset style="margin-bottom:5px">
		<legend>Billing Support</legend>
		<div class="col-md-2 thumbnail">
			<img src="'.$dirhost.'/files/images/users/jhoty.jpg" width="100%">
		</div>
		<div class="col-md-10" style="text-align:justify">
			Hai, ketemu lagi dengan <b>Pita</b>, jika kamu ingin bertanya tentang hal-hal mengenai transaksi hingga pembayaran, untuk kenyamanan anda, silahkan jangan sungkan untuk menghubungi <b>Pita</b> ya, di <br />
			<img src="'.$dirhost.'/files/images/icons/whatsapp.png" width="28" /> <b>081288616068</b><br />
			<img src="'.$dirhost.'/files/images/icons/bbm.png"  width="28" /> <b>D0F544A9</b>
			<br /><br />
			<b>-Terimakasih-</b> 
		</div>
	</fieldset>';
}

//BAHASA NYA "CEK HAK AKSES $id_user DI $tbl_hakakses UNTUK MODULE $mod_akses HALAMAN $page PADA TABLE $tbl_page"//
function rightaccess($page){
	global $db;
	$id_page 		= $db->fob("ID_PAGE_CLIENT","system_pages_client","WHERE PAGE='".$page."'");
	if(!empty($_SESSION['ulevelkey'])){
		@$chright 		= $db->recount("SELECT * FROM system_pages_client_rightaccess WHERE ID_PAGE_CLIENT='".$id_page."' AND ID_CLIENT_USER_LEVEL='".$_SESSION['ulevelkey']."'");
	}else{
		$chright 		= 0;
	}
	return $chright;
}

function id_page($page,$tbl){
	global $db;
	$id_page = $db->fob("ID_PAGE_CLIENT",$tbl,"WHERE PAGE='".$page."'");
	return $id_page;
}
function get_page($field,$id_page){
	global $db;
	$content_page = $db->fob($field,"system_pages_client","WHERE ID_PAGE_CLIENT='".$id_page."'");
	return $content_page;
}

function tipe_page($id_page,$tbl){
	global $db;
	$tipe_page = $db->fob("TYPE",$tbl,"WHERE ID_PAGE_CLIENT='".$id_page."'");	
	return $tipe_page;

}
function getuserinfo($field,$id){
 global $db;
 $info 	= $db->fob($field,"system_users_client","WHERE ID_USER ='".$id."' ");
 return $info;
}

function get_product_info($id_product,$img_width = "90%"){
	global $dirhost;
	global $basepath;
	global $img_dir;
	global $tpref;
	global $db;
	$str_product	 				= "SELECT 
											a.NAME,a.DESCRIPTION,a.ADDITIONAL_PRODUCT,a.CODE,a.SALE_PRICE,
											a.DISCOUNT,a.ID_PRODUCT_UNIT,b.PHOTOS 
										FROM 
											".$tpref."products a, ".$tpref."products_photos b 
										WHERE 
											a.ID_PRODUCT = b.ID_PRODUCT AND a.ID_PRODUCT='".$id_product."' 
										GROUP BY b.ID_PRODUCT";
	$q_product 	     				= $db->query($str_product);
	$dt_product	    				= $db->fetchNextObject($q_product);
	$photo		   	 				= $dt_product->PHOTOS;
	$result['code']    				= $dt_product->CODE;
	$result['image']   				= $photo;
	$result['name']    				= $dt_product->NAME;
	$result['price']   				= $dt_product->SALE_PRICE;
	$result['add_product']   		= $dt_product->ADDITIONAL_PRODUCT;
	$result['description']   		= $dt_product->DESCRIPTION;
	@$result['unit']				= $db->fob("NAME",$tpref."products_units","WHERE ID_PRODUCT_UNIT = '".$dt_product->ID_PRODUCT_UNIT."'");
	if(!empty($photo) && is_file($basepath."/".$img_dir."/products/thumbnails/".$photo)){
		$result['photo'] = '
		<a href="'.$dirhost.'/'.$img_dir.'/products/thumbnails/'.$photo.'" class="fancybox">
			<img src="'.$dirhost.'/'.$img_dir.'/products/thumbnails/'.$photo.'" class="thumbnail" style="width:'.$img_width.'"/>
	</a>';
	}else{
		$result['photo'] = '<img src="'.$dirhost.'/files/images/no_image.jpg" class="thumbnail" style="width:'.$img_width.'"/>';
	}
	return $result;
}

?>
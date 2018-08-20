<?php
session_start();
if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
include_once("../../includes/config.php");
include_once("../../includes/classes.php");
include_once("../../includes/functions.php");
include_once("../../includes/declarations.php");


$direction		= isset($_REQUEST['direction']) ? $_REQUEST['direction'] 	: "";
$limit			= isset($_REQUEST['limit']) 	? $_REQUEST['limit'] 		: "";
$rownum			= isset($_REQUEST['rownum']) 	? $_REQUEST['rownum'] 		: "";
$key			= isset($_REQUEST['key']) 		? $_REQUEST['key'] 			: "";

$condition 		= "";
$query_str 		= "SELECT * FROM system_users WHERE API_KEY = '".trim($key)."'";
$query_key 		= $db->query($query_str);
$num_key		= $db->numRows($query_key);

if($num_key > 0){

	if(!empty($direction) && $direction == "search"){ 
	
			
			$nama			= isset($_REQUEST['nama']) 		? str_replace("+"," ",$_REQUEST['nama']) 		: "";
			$code			= isset($_REQUEST['code']) 		? $_REQUEST['code'] 							: "";
			$deskripsi		= isset($_REQUEST['deskripsi']) ? str_replace("+"," ",$_REQUEST['deskripsi']) 	: "";
			$harga			= isset($_REQUEST['harga']) 	? $_REQUEST['harga'] 							: "";
			$diskon			= isset($_REQUEST['diskon']) 	? $_REQUEST['diskon'] 							: "";
			
			if(!empty($nama))		{ $condition 	.= " AND NAME LIKE '%".$nama."%'"; 			}
			if(!empty($code))		{ $condition 	.= " AND CODE 		= '%".$code."'";			}
			if(!empty($deskripsi))	{ $condition 	.= " AND DESCRIPTION LIKE '%".$deskripsi."%'"; 	}
			if(!empty($harga))		{ $condition	.= " AND SALE_PRICE = '".$harga."'";	 		}
			if(!empty($diskon))		{ $condition 	.= " AND DISCOUNT 	= '".$diskon."'"; 			}
					
			if(!empty($limit))	{ 
				$limit 	  = explode(",",$limit);
				$limit 	  = " LIMIT ".$limit[0].",".$limit[1].""; 
			}
			$str_product			= " SELECT *
										FROM ".$tpref."products 
										WHERE ID_PRODUCT IS NOT NULL					
										".@$condition."
										ORDER BY ID_PRODUCT DESC ".@$limit;
										//echo $str_product."<br><br>";
			$num_product			= $db->recount($str_product);
			$q_product 				= $db->query($str_product);
			$r = 0;
			while($dt_product 		= $db->fetchNextObject($q_product)){
				$r++;
				$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
				if(is_file($basepath."/files/images/products/".$dt_product->ID_CLIENT."/thumbnail/".$photo)){ 
					$photo_path = $dirhost."/files/images/products/".$dt_product->ID_CLIENT."/thumbnail/".$photo;
				}else{
					$photo_path = "";
				}
				$datas[$r]  = array(
									"kode"		=>$dt_product->CODE,
									"nama"		=>$dt_product->NAME,
									"photo"		=>$photo_path,
									"type"		=>$dt_product->ID_PRODUCT_TYPE,
									"deskripsi"	=>$dt_product->DESCRIPTION,
									"harga"		=>$dt_product->SALE_PRICE,
									"diskon"	=>$dt_product->DISCOUNT,
									"kategori"	=>$dt_product->ID_PRODUCT_CATEGORY,
									"unit"		=>$dt_product->ID_PRODUCT_UNIT,
									"status"	=>$dt_product->ID_STATUS,
									"tglupdate"	=>$dt_product->TGLUPDATE);
				
			}
			$datas["msg"] = "succeed"; 
	}
	
	if(!empty($direction) && $direction == "view_category_product"){ 
		$str_product_category 	= " SELECT * FROM ".$tpref."products_categories_master ORDER BY NAME ASC ";
		$q_product_category 	= $db->query($str_product_category);
		$r = 0;
		while($dt_product_category = $db->fetchNextObject($q_product_category)){
			$r++;
			$datas[$r]	= array("id_category"=>$dt_product_category->ID_PRODUCT_CATEGORY,
								"nama"=>$dt_product_category->NAME);
		}
	}
	if(!empty($direction) && $direction == "view_unit_product"){ 
		$str_product_unit 	= " SELECT * FROM ".$tpref."products_units_master ORDER BY NAME ASC ";
		$q_product_unit		= $db->query($str_product_unit);
		$r = 0;
		while($dt_product_unit = $db->fetchNextObject($q_product_unit)){
			$r++;
			$datas[$r]	= array("id_unit"=>$dt_product_unit->ID_PRODUCT_UNIT,
								"nama"=>$dt_product_unit->NAME);
		}
	}
}else{
	$datas["msg"] = "failed"; 
}
echo json_encode($datas); 

?>


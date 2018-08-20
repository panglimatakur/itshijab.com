<?php
session_start();
if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
include_once("../../includes/config.php");
include_once("../../includes/classes.php");
include_once("../../includes/functions.php");
include_once("../../includes/declarations.php");


$direction			= isset($_REQUEST['direction']) 		? $_REQUEST['direction'] 							: "";
$limit				= isset($_REQUEST['limit']) 			? $_REQUEST['limit'] 								: "";
$rownum				= isset($_REQUEST['rownum']) 			? $_REQUEST['rownum'] 								: "";
$key				= isset($_REQUEST['key']) 				? $_REQUEST['key'] 									: "";

$id_product 		= isset($_REQUEST['id_product']) 		? $_REQUEST['id_product'] 							: "";
$cust_email			= isset($_REQUEST['cust_email']) 		? $sanitize->email($_REQUEST['cust_email'])			: "";
$cust_password		= isset($_REQUEST['cust_password']) 	? $_REQUEST['cust_password'] 						: "";
$id_products 		= isset($_REQUEST['id_products']) 		? $_REQUEST['id_products'] 							: "";
$quantities 		= isset($_REQUEST['quantities']) 		? $_REQUEST['quantities'] 							: "";
$name 				= isset($_REQUEST['name']) 				? $sanitize->str(strtoupper($_REQUEST['name']))		: "";
$delivery_type 		= isset($_REQUEST['delivery_type']) 	? $sanitize->str($_REQUEST['delivery_type']) 		: "";
$destination_code 	= isset($_REQUEST['destination_code']) 	? $sanitize->str($_REQUEST['destination_code'])		: "";
$alamat 			= isset($_REQUEST['alamat']) 			? $sanitize->str(strtoupper($_REQUEST['alamat'])) 	: "";
$cust_hp 			= isset($_REQUEST['cust_hp']) 			? $sanitize->number($_REQUEST['cust_hp'])			: "";
$keterangan 		= isset($_REQUEST['keterangan']) 		? $sanitize->str($_REQUEST['keterangan'])			: "";

$condition 		= "";
$query_str 		= "SELECT * FROM system_users_client WHERE API_KEY = '".trim($key)."'";
$query_key 		= $db->query($query_str);
$num_key		= $db->numRows($query_key);

if($num_key > 0){
	function checkout($id_customer,$quantities){
		global $db;
		global $tpref;
		global $tglupdate;
		global $wktupdate;
		global $delivery_type;
		global $destination_code;
		global $name;
		global $alamat;
		global $cust_hp;
		global $keterangan;
		
		$biaya_antar	= "";
		$q_deliver_fee 	= $db->query("SELECT REG_TARIF,OKE_TARIF,YES_TARIF FROM ".$tpref."tarif_jne_master WHERE DESTINATION_CODE = '".$destination_code."'");
		$dt_deliver_fee = $db->fetchNextObject($q_deliver_fee);
		switch($delivery_type){
			case "REG":
				$biaya_antar =  $dt_deliver_fee->REG_TARIF;
			break;	
			case "OKE":
				$biaya_antar =  $dt_deliver_fee->OKE_TARIF;
			break;	
			case "YES":
				$biaya_antar =  $dt_deliver_fee->YES_TARIF;
			break;	
		}
		$a 				= 0;
		$list_carts		= "";
		$total_bayar	= "";
		foreach(array_reverse($_SESSION['order_id_product']) as &$order_id_product){
			$q_product	  	 	= $db->query("SELECT * FROM ".$tpref."products WHERE ID_PRODUCT = '".$order_id_product."' ");
			$dt_product	 		= $db->fetchNextObject($q_product);
			$nm_product	 	 	= $dt_product->NAME;
			$pr_price	   	 	= $dt_product->SALE_PRICE;
			$discount 		 	= $dt_product->DISCOUNT;
			if(!empty($discount)){
				$disc_price	 	= ($pr_price/100)*$discount;
				$pr_price	 	= $pr_price-$disc_price;
			}
			@$ttl_price  	 	= $pr_price*@$quantities[$a];
			$container 			= array(1=>
									array("ID_PRODUCT",$order_id_product),
									array("ID_USER",$id_customer),
									array("AMOUNT",@$quantities[$a]),
									array("PRICE",@$pr_price),
									array("DISCOUNT",trim($discount)),
									array("TOTAL_PRICE",@$ttl_price),
									array("STATUS","0"),
									array("TGLUPDATE",$tglupdate." ".$wktupdate));
			$db->insert($tpref."customers_carts",$container);
			$id_cart	 		= mysql_insert_id();
			$list_carts 		.= $id_cart.",";	
			$total_bayar 	 	= $ttl_price + $total_bayar;
			$a++;
		}
		$jml_code 		 	= $db->recount("SELECT ID_PURCHASE FROM ".$tpref."customers_purchases WHERE PAID_STATUS = '0'");	
		if($jml_code < 999){
			$unique_code    = $db->last("UNIQUE_CODE",$tpref."customers_purchases"," WHERE PAID_STATUS = '0'");
			if(empty($unique_code)){ $unique_code = '100'; }else{ $unique_code = $unique_code+1; }
		}else{
			$unique_code    = $db->last("UNIQUE_CODE",$tpref."customers_purchases"," WHERE PAID_STATUS = '3' ");
		}
		$payment_rand	 	= rand(0,2000000);
		$payment_code    	= strtoupper(substr(str_shuffle(md5($payment_rand)),0,4)).$unique_code;
		$total_price 		= $total_bayar+$unique_code;
		$total_paid			= @$total_price + @$biaya_antar;
		$paid_status 		= '0'; 
		
		
		$str_purchase   	= "SELECT * FROM ".$tpref."customers_carts WHERE STATUS = 0 ORDER BY ID_PURCHASE ASC";
		$q_purchase 	 	= $db->query($str_purchase);
		$num_purchase	 	= $db->numRows($q_purchase);
			
		$paid_status 	= '0'; 
		$container 		= array(1=>
							array("ID_USER",$id_customer),
							array("ID_CARTS",",".@$list_carts),
							array("PAYMENT_CODE",@$payment_code),
							array("UNIQUE_CODE",@$unique_code),
							array("PAID",@$total_price),
							array("DELIVERY_FEE",@$biaya_antar),
							array("PAID_TOTAL",@$total_paid),
							array("PAID_STATUS","1"),
							array("RECIEVER_NAME",@$name),
							array("RECIEVER_CONTACT",@$cust_hp),
							array("DELIVERY_TYPE",@$delivery_type),
							array("DESTINATION_CODE",@$destination_code),
							array("TO_ADDRESS",@$alamat),
							array("ADDITIONAL_INFO",@$keterangan),
							array("TGLUPDATE",@$tglupdate." ".$wktupdate));
		$db->insert($tpref."customers_purchases",$container);
		$id_purchase	 = mysql_insert_id();
		$container 	   = array(1=>
							//array("DELIVERY_FLAG",@$is_deliver),
							array("STATUS","1"),
							array("ID_PURCHASE",$id_purchase));
		$db->update($tpref."customers_carts",$container," WHERE STATUS = '0'");				
		unset($_SESSION["order_id_product"]);
		cookie_destroy();
		echo "2";
	}


	if(!empty($direction) && $direction == "search"){ 
			$id_category	= isset($_REQUEST['id_category'])? $_REQUEST['id_category'] 					: "";
			$id_product		= isset($_REQUEST['id_product'])? $_REQUEST['id_product'] 						: "";
			$nama			= isset($_REQUEST['nama']) 		? str_replace("+"," ",$_REQUEST['nama']) 		: "";
			$code			= isset($_REQUEST['code']) 		? $_REQUEST['code'] 							: "";
			$deskripsi		= isset($_REQUEST['deskripsi']) ? str_replace("+"," ",$_REQUEST['deskripsi']) 	: "";
			$harga			= isset($_REQUEST['harga']) 	? $_REQUEST['harga'] 							: "";
			$diskon			= isset($_REQUEST['diskon']) 	? $_REQUEST['diskon'] 							: "";
			
			if(!empty($id_category)){ $condition 	.= " AND ID_PRODUCT_CATEGORY = '".$id_category."'"; 	}
			if(!empty($id_product))	{ $condition 	.= " AND ID_PRODUCT = '".$id_product."'"; 				}
			if(!empty($nama))		{ $condition 	.= " AND NAME LIKE '%".$nama."%'"; 						}
			if(!empty($code))		{ $condition 	.= " AND CODE 		= '".$code."'";						}
			if(!empty($deskripsi))	{ $condition 	.= " AND DESCRIPTION LIKE '%".$deskripsi."%'"; 			}
			if(!empty($harga))		{ $condition	.= " AND SALE_PRICE = '".$harga."'";	 				}
			if(!empty($diskon))		{ $condition 	.= " AND DISCOUNT 	= '".$diskon."'"; 					}
					
			if(!empty($limit))	{ 
				if(empty($rownum)){ $rownum = 0; } 
				$limit 	  = explode(",",$limit); 
				$limit 	  = " LIMIT ".$limit[0].",".$limit[1].""; 
			}
			$str_product			= " SELECT *
										FROM ".$tpref."products 
										WHERE ID_PRODUCT IS NOT NULL					
										".@$condition."
										ORDER BY ID_PRODUCT DESC ".@$limit;
			$num_product			= $db->recount($str_product);
			$q_product 				= $db->query($str_product);
			$r = 0;
			while($dt_product 		= $db->fetchNextObject($q_product)){
				$r++;
				$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
				if(is_file($basepath."/files/images/products/thumbnail/".$photo)){ 
					$photo_path = $dirhost."/files/images/products/thumbnail/".$photo;
				}else{
					$photo_path = $dirhost."/files/images/no_image.jpg";
				}
				$datas[$r]  = array(
									"id_product"	=>$dt_product->ID_PRODUCT,
									"code"			=>$dt_product->CODE,
									"nama"			=>$dt_product->NAME,
									"photo"			=>$photo_path,
									"type"			=>$dt_product->ID_PRODUCT_TYPE,
									"deskripsi"		=>$dt_product->DESCRIPTION,
									"harga"			=>$dt_product->SALE_PRICE,
									"diskon"		=>$dt_product->DISCOUNT,
									"kategori"		=>$dt_product->ID_PRODUCT_CATEGORY,
									"unit"			=>$dt_product->ID_PRODUCT_UNIT,
									"status"		=>$dt_product->ID_STATUS,
									"tglupdate"		=>$dt_product->TGLUPDATE);
				
			}
	}
	
	if(!empty($direction) && $direction == "view_category_product"){ 
		$str_product_category 	= " SELECT * FROM ".$tpref."products_categories WHERE ID_PARENT != '0' ORDER BY NAME ASC ";
		$q_product_category 	= $db->query($str_product_category);
		$r = 0;
		while($dt_product_category = $db->fetchNextObject($q_product_category)){
			$r++;
			$datas[$r]	= array("id_category"=>$dt_product_category->ID_PRODUCT_CATEGORY,
								"nama"=>$dt_product_category->NAME);
		}
	}
	if(!empty($direction) && $direction == "view_unit_product"){ 
		$str_product_unit 	= " SELECT * FROM ".$tpref."products_units ORDER BY NAME ASC ";
		$q_product_unit		= $db->query($str_product_unit);
		$r = 0;
		while($dt_product_unit = $db->fetchNextObject($q_product_unit)){
			$r++;
			$datas[$r]	= array("id_unit"=>$dt_product_unit->ID_PRODUCT_UNIT,
								"nama"=>$dt_product_unit->NAME);
		}
	}

	if(!empty($direction) && $direction == "view_customer"){
		$id_user	= isset($_REQUEST['id_user'])	? $_REQUEST['id_user'] 		: "";
		$nama		= isset($_REQUEST['nama']) 		? $_REQUEST['nama'] 		: "";
		$phone		= isset($_REQUEST['phone']) 	? $_REQUEST['phone'] 		: "";
		$email		= isset($_REQUEST['email']) 	? $_REQUEST['email'] 		: "";
		
		if(!empty($id_user))	{ $condition 	.= " AND ID_USER 		= '".$id_user."'"; 			}
		if(!empty($nama))		{ $condition 	.= " AND USER_NAME LIKE '%".$nama."%'"; 			}
		if(!empty($phone))		{ $condition 	.= " AND USER_PHONE 	= '".$phone."'";			}
		if(!empty($email))		{ $condition 	.= " AND USER_EMAIL  	= '".$email."'"; 			}
				
		if(!empty($limit))	{ 
			if(empty($rownum)){ $rownum = 0; } 
			$limit 	  = explode(",",$limit); 
			$limit 	  = " LIMIT ".$limit[0].",".$limit[1].""; 
		}
		$q_user 			= $db->query("SELECT * 
										  FROM 
											system_users_client 
										  WHERE 
											USER_EMAIL IS NOT NULL AND 
											USER_STATUS = '3' 
											".@$condition."
										  ORDER BY USER_NAME DESC ".@$limit." ");
		$num_user 			= $db->numRows($q_user);
		$datas['num_user']	= $num_user;
		if($num_user > 0){
			$r = 0;
			while($dt_user 	= $db->fetchNextObject($q_user)){
				$r++;
				$datas[$r]  = array("id_user"		=>$dt_user->ID_USER,
									"phone"			=>$dt_user->USER_PHONE,
									"nama"			=>$dt_user->USER_NAME,
									"email"			=>$dt_user->USER_EMAIL,
									"status"		=>$dt_user->USER_STATUS);
			}
		}
	}
}else{
	$datas["msg"] = "failed"; 
}
echo json_encode($datas); 

?>

<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 			= isset($_REQUEST['direction']) 		? $_REQUEST['direction'] 							: "";
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
	
	if(!empty($direction) && $direction == "delete_cart"){
		$key = array_search($id_product,$_SESSION["order_id_product"]);
		unset($_SESSION["order_id_product"][$key]);
		set_array_cookie("order_id_product",$_SESSION["order_id_product"]);
		setcookie("jumlah_order[".$id_product."]","", time()-3600);
		setcookie("ttl_price[".$id_product."]","", time()-3600);
	}
	if(!empty($direction) && $direction == "purchase_cart"){
		$id_products 	= $_REQUEST['id_products'];
		$quantities 	= $_REQUEST['quantities'];
		if(empty($_SESSION['cusidkey'])){
			include $call->inc($pos."/pages/cart/includes","login.php");
		 }else{
			$result = checkout($_SESSION['cusidkey'],$quantities);
			echo $result;
		}
		
	}
	
	if(!empty($direction) && $direction == "check_new_cust"){
		$plg			= isset($_REQUEST['plg']) ? $_REQUEST['plg'] 	: "";
		if($plg == "baru"){
			$q_user 	= $db->query("SELECT ID_USER FROM system_users_client WHERE USER_EMAIL = '".$cust_email."' AND USER_STATUS = '3' ");
			$num_user 	= $db->numRows($q_user);
			if($num_user == 0){
				echo "2";
			}else{
				echo "<div class='alert alert-danger'>Akun ".$cust_email." sudah terdaftar, silahkan pilih jenis \"Pelanggan Tetap\" atau <a href='#'>Lupa Password?</a>";	
			}
		}else{
			$q_user 	= $db->query("SELECT ID_USER FROM system_users_client WHERE USER_EMAIL = '".$cust_email."' AND USER_PASS = '".$cust_password."' AND USER_STATUS = '3' ");
			$dt_user 	= $db->fetchNextObject($q_user);
			$num_user 	= $db->numRows($q_user);
			if($num_user > 0){
				echo "2";
			}else{
				echo "<div class='alert alert-danger'>Maaf, akun ".$website_name." anda ini belum terdaftar, silahkan pilih jenis \"Pelanggan Baru\"";	
			}
		}
	}
	
	if(!empty($direction) && $direction == "checkout"){
		$plg			= isset($_REQUEST['plg']) ? $_REQUEST['plg'] 	: "";
		if($plg == "baru"){
			$cust_password 	= generate_password();
			@$new_str 		= preg_replace('~[\\\\/:*?"<>|]~','',@$name); 	
			@$last_id 		= $db->last("ID_USER","system_users_client","");
			@$affilite_id 	= substr(strtolower($new_str),0,6).".".sprintf("%03d",$last_id);
			@$api_key		= sha1($cust_email);
			$container = array(1=>
								array("ID_AFFILIATE",@$affilite_id),
								array("API_KEY",@$api_key),
								array("USER_REALNAME",@$name),
								array("USER_EMAIL",@$cust_email),
								array("USER_PASS",@$cust_password),
								array("USER_PHONE",@$cust_hp),
								array("USER_ADDRESS",@$alamat),
								array("ID_CLIENT_USER_LEVEL","2"),
								array("USER_STATUS","3"),
								array("UPDATEDATE",$tglupdate),
								array("UPDATETIME",$wktupdate));
			$db->insert("system_users_client",$container);
			$csuidkey 	= mysql_insert_id();
		}else{
			$csuidkey 	= $db->fob("ID_USER","system_users_client"," WHERE USER_EMAIL = '".$cust_email."' AND USER_PASS = '".$cust_password."' AND USER_STATUS = '3' ");
		}
		$_SESSION['cusidkey'] 	= $csuidkey;
		$result 				= checkout($csuidkey,$quantities);
		echo $result;
	}
}
?>
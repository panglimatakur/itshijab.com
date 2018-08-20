<?php
include("../../itshijab_api.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$direction 			= isset($_REQUEST['direction']) 		? $_REQUEST['direction'] 							: "";
	@$id_products 		= $_REQUEST['id_products'];
	@$quantities 		= $_REQUEST['quantities'];
	$id_product 		= isset($_REQUEST['id_product']) ? $_REQUEST['id_product'] : "";
	$itshijab 			= new api;
}

if(!empty($direction) && $direction == "delete_cart"){
	$key = array_search($id_product,$_SESSION["order_id_product"]);
	unset($_SESSION["order_id_product"][$key]);
	$itshijab->set_array_cookie("order_id_product",$_SESSION["order_id_product"]);
	setcookie("jumlah_order[".$id_product."]","", time()-3600);
	setcookie("ttl_price[".$id_product."]","", time()-3600);
}
if(!empty($direction) && $direction == "purchase_cart"){
	if(empty($_SESSION['cusidkey'])){
		$login_page = '1';
		include("view.php");
	 }else{
		session_start();
		$result = checkout($_SESSION['cusidkey'],$quantities);
		echo $result;
	}
}
if(!empty($direction) && $direction == "check_new_cust"){
	$plg				= isset($_REQUEST['plg']) 			? $_REQUEST['plg'] 				: "";
	$cust_email			= isset($_REQUEST['cust_email']) 	? $_REQUEST['cust_email']		: "";
	$cust_password		= isset($_REQUEST['cust_password']) ? $_REQUEST['cust_password'] 	: "";

	if($plg == "baru"){
		$data 		= array("email"=>$cust_email,"status"=>"3");
		$result 	= $itshijab->viewCustomer($data);
		$num_user 	= $result['num_user'];
		if($num_user == 0){
			echo "2";
		}else{
			echo "<div class='alert alert-danger'>Akun ".$cust_email." sudah terdaftar, silahkan pilih jenis \"Pelanggan Tetap\" atau <a href='#'>Lupa Password?</a>";	
		}
	}else{
		$data 		= array("email"=>$cust_email,"password"=>$cust_password,"status"=>"3");
		$result 	= $itshijab->viewCustomer($data);
		$num_user 	= $result['num_user'];
		if($num_user > 0){
			echo "2";
		}else{
			echo "<div class='alert alert-danger'>Maaf, akun ".$website_name." anda ini belum terdaftar, silahkan pilih jenis \"Pelanggan Baru\"";	
		}
	}
}
	

?>
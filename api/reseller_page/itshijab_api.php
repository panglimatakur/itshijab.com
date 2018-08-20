<?php
$curl 		= curl_init();
$host_url 	= "http://localhost/itshijab.com";
$api_url 	= $host_url."/api/v1/api.php";
class api {
	function money($cur,$str){
		$num = $cur."".str_replace(",",".",number_format($str));
		return $num;
	}
	function viewProduct($arrays = NULL){
		global $curl;
		global $api_url;
		global $api_key;
		$param = "&key=".$api_key;
			if(count($arrays) > 0){
			foreach($arrays  as $key=>$array){
				if($key == "id_category")	{ $param .= "&id_category=".$array; 					}
				if($key == "id_product")	{ $param .= "&id_product=".$array; 						}
				if($key == "nama")			{ $param .= "&nama=".str_replace(" ","+",$array); 		}
				if($key == "code")			{ $param .= "&code=".$array; 							}
				if($key == "deskripsi")		{ $param .= "&deskripsi=".str_replace(" ","+",$array); 	}
				if($key == "harga")			{ $param .= "&harga=".$array; 							}
				if($key == "diskon")		{ $param .= "&diskon=".$array; 							}
				if($key == "limit")			{ $param .= "&limit=".$array; 							}
			}
		}
		curl_setopt($curl, CURLOPT_URL, $api_url."?direction=search".$param);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		$result = json_decode($result,true);
		return $result;
	}
	function viewProductCategory($api_key = NULL){
		global $curl;
		global $api_url;
		global $api_key;
		curl_setopt($curl, CURLOPT_URL, $api_url."?direction=view_category_product&key=".$api_key);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		$result = json_decode($result,true);
		return $result;
	
	}
	function viewProductUnit($api_key = NULL){
		global $curl;
		global $api_url;
		global $api_key;
		curl_setopt($curl, CURLOPT_URL, $api_url."?direction=view_unit_product&key=".$api_key);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		$result = json_decode($result,true);
		return $result;
	
	}
	function viewCustomer($arrays = NULL){
		global $curl;
		global $api_url;
		global $api_key;
		$param = "&key=".$api_key;
		if(count($arrays) > 0){
			foreach($arrays  as $key=>$array){
				if($key == "id_user")		{ $param .= "&id_user=".$array; 	}
				if($key == "nama")			{ $param .= "&nama=".$array; 		}
				if($key == "phone")			{ $param .= "&phone=".$array; 		}
				if($key == "email")			{ $param .= "&email=".$array; 		}
				if($key == "limit")			{ $param .= "&limit=".$array; 		}
			}
		}
		curl_setopt($curl, CURLOPT_URL, $api_url."?direction=view_customer".$param);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		$result = json_decode($result,true);
		return $result;
	}
	
	function cookie_destroy(){
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name  = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}
	}
	function set_array_cookie($cookie_name,$cookie_array_value){
		setcookie($cookie_name,json_encode($cookie_array_value), time()+3600);
	}
	function get_array_cookie($cookie_name){
		$cookie 			= $_COOKIE[$cookie_name];
		$cookie 			= stripslashes($cookie);
		$decoded_cookie 	= json_decode($cookie, true);	
		return $decoded_cookie;
	}
}
$api_key 	= "4693f0128d26e6a8606e22d1be691e666e2a9b02";

?>
<?php
session_start();
//session_destroy();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 		= isset($_REQUEST['direction']) 	?	 $_REQUEST['direction'] 	: "";
	$tipe 			= isset($_REQUEST['tipe']) 			?	 $_REQUEST['tipe'] 			: "";
	$warna 			= isset($_REQUEST['warna']) 		?	 $_REQUEST['warna'] 		: "";
	$bottomtop 		= isset($_REQUEST['bottomtop']) 	?	 $_REQUEST['bottomtop'] 	: "";
	$leftright 		= isset($_REQUEST['leftright']) 	?	 $_REQUEST['leftright'] 	: "";
	$src			= isset($_REQUEST['src']) 			?	 $_REQUEST['src'] 			: "";
	$design_service = isset($_REQUEST['design_service'])?	 $_REQUEST['design_service']: "";
	$file_id 		= isset($_REQUEST['file_id']) 		?	 $_REQUEST['file_id'] 		: "";
	$fileraw	 	= isset($_REQUEST['fileraw'])		?	 $_REQUEST['fileraw']	: "";
	$fileimage 		= isset($_REQUEST['fileimage']) 	?	 $_REQUEST['fileimage'] 	: "";
	$ownership		= isset($_REQUEST['ownership']) 	?	 $_REQUEST['ownership'] 	: ""; 
	$screenshot		= isset($_REQUEST['screenshot'])	?	 $_REQUEST['screenshot'] 	: "";
	$harga_cetak	= isset($_REQUEST['harga_cetak']) 	?	 $_REQUEST['harga_cetak'] 	: ""; 
	$jumlah_cetak	= isset($_REQUEST['jumlah_cetak'])	?	 $_REQUEST['jumlah_cetak'] 	: "";
	$order_name 	= isset($_REQUEST['order_name']) 	?	 $_REQUEST['order_name'] 		: "";
	$order_hp		= isset($_REQUEST['order_hp']) 		?	 $_REQUEST['order_hp'] 			: ""; 
	$order_email 	= isset($_REQUEST['order_email']) 	?	 $_REQUEST['order_email'] 		: "";
	$order_password	= isset($_REQUEST['order_password'])?	 $_REQUEST['order_password'] 	: ""; 
	$order_address	= isset($_REQUEST['order_address']) ?	 $_REQUEST['order_address'] 	: "";
	$uploaddir 		= $basepath.'/files/images/designs/';
	$login_id		= isset($_REQUEST['login_id']) 		?	 $_REQUEST['login_id'] 	: "";




	if(!empty($direction) && $direction == "save_desain"){
		$next = "";
		if(!empty($tipe) && !empty($harga_cetak) && !empty($jumlah_cetak)){
			if(empty($src)){
				if(!empty($_FILES['file_image']['tmp_name'])){  

					move_uploaded_file(@$_FILES['file_image']['tmp_name'], $uploaddir .basename($file_id."_".@$_FILES['file_image']['name']));
					$fileimage 		= $file_id."_".@$_FILES['file_image']['name'];
					$next 			= "done";
				}else{
					$next 			= "";
					$result['io']	='1';	
					$result['msg']	= "Silahkan Masukan File *.jpg atau *.png desain anda pada \"Pratinjau Desain\" ";
				}

				if(empty($design_service) && $next == "done"){
					if(!empty($_FILES['file_raw']['tmp_name'])){  
						move_uploaded_file(@$_FILES['file_raw']['tmp_name'], $uploaddir .basename($file_id."_".@$_FILES['file_raw']['name']));

						$fileraw 		= $file_id."_".@$_FILES['file_raw']['name'];
						$next 			= "done";
					}else{
						$next 			= "";
						$result['io']	='1';
						$result['msg']	= "Silahkan Masukan File mentah berformat *.cdr atau *.ai";
					}
				}else{
					$next 		= "done";
				}
			}else{
				$fileimage 	= "";
				$fileraw 	= "";
				$next 		= "done";
			}
			if($next == "done"){
				$harga  			= $db->fob("VALUE",$tpref."config"," WHERE ID_CONFIG = '".$tipe."'");
				$image_content 		= array(1=>
										array("ID_CONFIG_PATTERN",@$tipe),
										array("COLOR",@$warna),
										array("FILE_IMAGE",@$fileimage),
										array("FILE_DESIGN",@$fileraw),
										array("DESIGN_SERVICE_FLAG",@$design_service),
										array("ID_CUSTOM_DESIGN_DEFAULT",@$src),
										array("DESIGN_BUY",@$ownership),
										array("PRICE",@$harga),
										array("QUANTITY",@$jumlah_cetak),
										array("TOTAL_PRICE",@$harga_cetak),
										array("IP_ADDRESS",@$ip_address),
										array("ID_CUSTOMER",@$_SESSION['cidkey']),
										array("ORDER_STATUS","1"),
										array("UPDATEDATE",@$tglupdate),
										array("UPDATETIME",@$wktupdate));
				$db->insert($tpref."custom_designs",$image_content);
				$id_design = mysql_insert_id();
				$direction = "view_desain";
				$result['io']			= 2;
				$result['id_design']	= $id_design;
			}
		}else{
			$result['msg'] 	= "Pengisian Form Belum Lengkap..";	
			$result['io']	= 1;
		}
	}

	if(!empty($direction) && $direction == "save_screenshot"){

		$id_design	= isset($_REQUEST['id_design']) 		?	 $_REQUEST['id_design'] 			: "";

		$file_id 	= substr(md5(rand(0,100000)),0,5);

		$data 		= str_replace('data:image/png;base64,', '', $screenshot);

		$data 		= str_replace(' ', '+', $data);

		$data 		= base64_decode($data); 

		$screenshot = "screenshot-".$file_id."_".uniqid().".png";

		$file 		= $uploaddir.$screenshot;

		$success 	= file_put_contents($file, $data);

		$db->query("UPDATE ".$tpref."custom_designs SET FILE_SCREENSHOT = '".$screenshot."' WHERE IP_ADDRESS = '".$ip_address."' AND ID_CUSTOM_DESIGN = '".$id_design."'");

		$direction = "view_desain";

		$result['io'] = '2';



	}

	if(!empty($direction) && $direction == "order_desain"){
		$str_design 		= "SELECT * FROM ".$tpref."custom_designs WHERE ID_CUSTOMER = '".$login_id."' AND ORDER_STATUS = '1' ORDER BY ID_CUSTOM_DESIGN DESC";

		$q_design			= $db->query($str_design);
		$to 			= $_SESSION['cidemail'];
		$from 			= "crew@itshijab.com";

		$subject 		= '[PENTING] Informasi Pemesanan Hijab Custom';
		$headers 		= "From: ItsHijab Crew <" . strip_tags($from) . ">\r\n";
		$headers 		.= "MIME-Version: 1.0\r\n";
		$headers 		.= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
		
		$result['content'] 	= "
		<div class='col-md-12'>
			<div class='col-md-6' style='height:400px; overflow:scroll'>";
		$content = '	
		<style type="text/css">
			.thumbnail{
				display: block;
				padding: 4px;
				margin-bottom: 20px;
				line-height: 1.428571429;
				background-color: #fff;
				border: 1px solid #ddd;
				border-radius: 4px;
				-webkit-transition: all .2s ease-in-out;
				transition: all .2s ease-in-out;
			}
			.table-item{
				width:100%;
				border:0;
			}
			.table-item .label-item{
				width:50%;	
			}
		</style>	
		<h3>Terimakasih, <b>'.$order_name.'</b></h3>
		<p class="lead">

			Terimakasih telah memberikan kepercayaan kepada itshijab.com, kami akan segera memproses pesanan anda dengan informasi seperti dibawah ini<br><br>

		</p>';

		$content .= '
		<table style="width:100%" class="table-item">';
		while($dt_design = $db->fetchNextObject($q_design)){
			$pola_hijab  		= $db->fob("NAME",$tpref."config"," WHERE ID_CONFIG = '".$dt_design->ID_CONFIG_PATTERN."'");
			$content .= "
			<tr>
				<td colspan='2' style='width:50px'>
					<img src='".@$dirhost.'/files/images/designs/'.@$dt_design->FILE_SCREENSHOT."' 
						 class='thumbnail' width='100%'>
				</td>
				<td valign-top='top' style='vertical-align:top'>";
				$content .= "
					<table style='width:100%; margin-top:58px;' class='table-item'>
						<tr>
							<td class='label-item' style='width:100px'><b>Pola Hijab</b></td>
							<td>".@$pola_hijab."</td>
						</tr>";
				if(!empty($dt_design->ID_CUSTOM_DESIGN_DEFAULT)){
					if($dt_design->DESIGN_BUY == 1)	{ $ownership_label = "Ya"; 		}
					else							{ $ownership_label = "Tidak"; 	}
				$content .= "
						<tr>
							<td class='label-item'><b>Beli Desain</b></label>
							<td>".$ownership_label."</td>
						</tr>";
				}

				if(empty($dt_design->ID_CUSTOM_DESIGN_DEFAULT)){
					if($dt_design->DESIGN_SERVICE_FLAG == 1)	{ $design_service_label = "Ya"; 		}
					else										{ $design_service_label = "Tidak"; 	}
				$content .= "
						<tr>
							<td class='label-item'><b>Jasa Desain</b></td>
							<td>".$design_service_label."</td>
						</tr>";
				}
				$content .= "
						<tr>
							<td class='label-item'><b>Jumlah Cetak</b></td>
							<td>".$dt_design->QUANTITY." Piece</td>
						</tr>
						<tr>
							<td class='label-item'><b>Total Harga</b></td>
							<td>".money("Rp.",$dt_design->TOTAL_PRICE).",00</td>
						</tr>
					</table>";
			$content .= "					
				</td>
			</tr>";
		}

		@$total_biaya 		= $db->sum("TOTAL_PRICE",$tpref."custom_designs"," 
									    WHERE ID_CUSTOMER = '".$_SESSION['cidkey']."' AND ORDER_STATUS = '1'");
		$percent_dp  		= $db->fob("VALUE",$tpref."config"," WHERE ID_CONFIG = '9'");
		$depe 				= ($percent_dp/100) * $total_biaya;
		$content .= '
				<tr>
					<td class="label-item"><b>Total Biaya Produksi</td>
					<td>'.money("Rp.",$total_biaya).',00</td>
				</tr>
		</table>';

		include($basepath."/files/email_templates/hero/view.php");
		mail($to, $subject, $message, $headers);
		
		$owner			= "thetakur@gmail.com,akunadz@gmail.com";
		$subject2owner	= "Pemesanan Custom Hijab ";
		mail($owner, $subject, $message, $headers);	
		
		$db->query("UPDATE ".$tpref."custom_designs SET ID_CUSTOMER = '".$_SESSION['cidkey']."', ORDER_STATUS = '2' WHERE ORDER_STATUS = '1'");
		$result['io'] = '2';
		$result['msg'] 	= "Terimakasih ".@$_SESSION['cidname'].", pesanan kamu sudah kami terima, silahkan lakukan pembayaran sebesar <b>".money("Rp.",$total_biaya).",00</b> ke informasi rekening yang kami kirim ke email kamu, agar  segera kami proses pesanan kamu...termakasih ".@$_SESSION['cidname'];	
	}

	if(!empty($direction) && $direction == "delete_design"){
		$id_design 			= isset($_REQUEST['id_design']) ?	 $_REQUEST['id_design'] 		: "";
		$str_design 		= "SELECT FILE_SCREENSHOT,FILE_DESIGN FROM ".$tpref."custom_designs WHERE ID_CUSTOM_DESIGN = '".$id_design."'";
		$q_design			= $db->query($str_design);
		$dt_design			= $db->fetchNextObject($q_design);
		if(is_file($basepath."/files/images/designs/".$dt_design->FILE_SCREENSHOT)){
			unlink($basepath."/files/images/designs/".$dt_design->FILE_SCREENSHOT);
		}
		if(is_file($basepath."/files/images/designs/".$dt_design->FILE_DESIGN)){
			unlink($basepath."/files/images/designs/".$dt_design->FILE_DESIGN);
		}
		$db->delete($tpref."custom_designs"," WHERE ID_CUSTOM_DESIGN = '".$id_design."'");
		$result['msg'] 	= "Data sudah di hapus";	
		$result['io']	= 1;
	}


	if(!empty($direction) && $direction == "view_desain"){

		@$total_biaya 		= $db->sum("TOTAL_PRICE",$tpref."custom_designs"," WHERE IP_ADDRESS = '".$ip_address."' AND ORDER_STATUS = '1' ORDER BY ID_CUSTOM_DESIGN DESC");
		$str_design 			= "SELECT * FROM ".$tpref."custom_designs WHERE IP_ADDRESS = '".$ip_address."' AND ORDER_STATUS = '1' ORDER BY ID_CUSTOM_DESIGN DESC";
		$q_design				= $db->query($str_design);
		$result['content'] 		= "
		<div class='col-md-12' style='padding:0'>
			<div class='col-md-6' style='height:500px; overflow:scroll' >";
		while($dt_design = $db->fetchNextObject($q_design)){
			$type_label = $db->fob("NAME",$tpref."config"," WHERE ID_CONFIG = '".$dt_design->ID_CONFIG_PATTERN."'");	
			$result['content'] 	.= "
				<div id='design_".$dt_design->ID_CUSTOM_DESIGN."'>";
					if(is_file($uploaddir.$dt_design->FILE_SCREENSHOT)){
				$result['content'] .= "
				<div  class='thumbnail' style='overflow:hidden'>
					<img src='".@$dirhost.'/files/images/designs/'.@$dt_design->FILE_SCREENSHOT."' 
						 width='100%'
						 style='margin-left:-15px;margin-top:-20px;'>
				</div>";
					}
				$result['content'] .= "
					<div class='form-group col-md-12 row' style='margin-bottom:0'>
						<label class='col-sm-5 col-form-label'>Pola Hijab</label>";
				$result['content'] .= "
						<div class='col-sm-7'>".$type_label."</div>
						<br><br>
					</div>";
				if(!empty($dt_design->ID_CUSTOM_DESIGN_DEFAULT)){
					if($dt_design->DESIGN_BUY == 1)	{ $ownership_label = "Ya"; 		}
					else							{ $ownership_label = "Tidak"; 	}
				$result['content'] .= "
					<div class='form-group col-md-12 row' style='margin-bottom:0'>
						<label class='col-sm-5 col-form-label'>Beli Desain</label>";
				$result['content'] .= "
						<div class='col-sm-7'>".$ownership_label."</div>
						<br><br>
					</div>";
				}

				if(empty($dt_design->ID_CUSTOM_DESIGN_DEFAULT)){
					if($dt_design->DESIGN_SERVICE_FLAG == 1)	{ $design_service_label = "Ya"; 		}
					else										{ $design_service_label = "Tidak"; 	}
				$result['content'] .= "
					<div class='form-group col-md-12 row' style='margin-bottom:0'>
						<label class='col-sm-5 col-form-label'>Jasa Desain</label>";
				$result['content'] .= "
						<div class='col-sm-7'>".$design_service_label."</div>
						<br><br>
					</div>";
				}

				$result['content'] .= "
					<div class='form-group col-md-12 row' style='margin-bottom:0'>
						<label class='col-sm-5 col-form-label'>Jumlah Cetak</label>";
				$result['content'] .= "
						<div class='col-sm-7'>".$dt_design->QUANTITY." Piece</div>
						<br><br>
					</div>";					

				$result['content'] .= "
					<div class='form-group col-md-12 row' style='margin-bottom:0'>
						<label class='col-sm-5 col-form-label'>Total Harga</label>";
				$result['content'] .= "
						<div class='col-sm-7'>".money("Rp.",$dt_design->TOTAL_PRICE).",00</div>
						<br><br>
					</div>";
				$result['content'] .= "
					<div class='form-group col-md-12'>
						<button type='button' class='btn btn-primary btn-block' onclick='delete_design(\"".$dt_design->ID_CUSTOM_DESIGN."\")'>
							<i class='fa fa-trash'></i> Hapus Desain
						</button>
					</div>
					<div class='clearfix'></div>
				</div>";
		}

		$result['content'] .= " 
			</div>
			<div class='col-md-6' >
			<div class = 'well' style='font-size:18px;color:#F45151'><b>Total Biaya : ".money("Rp.",$total_biaya)."</b></div>
			<span id='design_loader'></span>
			<span id='msg_register'></span>";

		if(empty($_SESSION['cidkey'])){
		$result['content'] .= "
				<div id='form_login' style='display:none'>
					<div class='form-group col-md-12'>
						<label class='req'>Email </label>
						<input type='email' id='cemail' class='form-control'>
					</div>

					<div class='form-group col-md-12'>
						<label class='req'>Password </label>
						<input type='password' id='cpassword' class='form-control'>
					</div>

					<div class='form-group col-md-12'>
						<button type='button' class='btn btn-primary' onclick='open_register()'>
							<i class='fa fa-user'></i> Belum Punya Akun ?
						</button>
						<button type='button' class='btn btn-primary' onclick='save_login()'>
							<i class='fa fa-key'></i> Login
						</button>
					</div>
				</div>

				<div id='form_register'>
					<div class='form-group col-md-6'>
						<label class='req'>Nama </label>
						<input type='text' id='order_name' class='form-control'>
					</div>
					<div class='form-group col-md-6'>
						<label class='req'>HP </label>
						<input type='number' id='order_hp' class='form-control'>
					</div>

					<div class='form-group col-md-12'>
						<label class='req'>Email </label>
						<input type='email' id='order_email' class='form-control'>
					</div>

					<div class='form-group col-md-6'>
						<label class='req'>Password </label>
						<input type='password' id='order_password' class='form-control'>
					</div>

					<div class='form-group col-md-6'>
						<label class='req'>Ulangi Password </label>
						<input type='password' id='order_kpassword' class='form-control'>
					</div>

					<div class='form-group col-md-12'>
						<label class='req'>Alamat Lengkap </label>
						<textarea type='alamat' id='order_address' class='form-control'></textarea>
					</div>

					<div class='form-group col-md-12'>
						<button type='button' class='btn btn-primary' onclick='save_customer()'>
							<i class='fa fa-check-square-o'></i> Simpan Data
						</button>
						<button type='button' class='btn btn-primary' onclick='open_login()'>
							<i class='fa fa-key'></i> Sudah Punya Akun ?
						</button>
					</div>
				</div>";
		}


		if(empty($_SESSION['cidkey'])){ $display = "style='display:none'";}
		else						  { 
			$display = ""; 
			$str_customer 			= "SELECT * FROM ".$tpref."customers WHERE ID_CUSTOMER = '".$_SESSION['cidkey']."'";
			$q_customer 			= $db->query($str_customer); 
			$dt_customer 			= $db->fetchNextObject($q_customer);
			$result['content'] 		.= '
			<div class="alert alert-info form-group col-md-12">
				Hi, <b>'.$dt_customer->CUSTOMER_NAME.'</b>, silahkan klik tombol <b>Pesan Desain Hijab</b> dibawah ini, atau silahkan lanjut berbelanja atau mendesain kembali, dengan menekan tombol <b>Lanjut Belanja</b> dibawah ini
			</div>';
		}

		$result['content'] .= '
			<div class="form-group col-md-12" '.@$display.' id="btn_order">
				<button type="button" class="btn btn-primary btn-block col-md-6" onclick="order_design()">
					<i class="fa fa-check-circle"></i> Pesan Desain Hijab
				</button>
				<div class="clearfix"></div>
			</div>';		
		$result['content'] .= "
				<div class='clearfix'></div>
			</div>
		</div>";
	}
	
	if(!empty($direction) && $direction == "save_customer"){
		$order_name 	= isset($_REQUEST['order_name']) 		?	 $_REQUEST['order_name'] 		: "";
		$order_hp		= isset($_REQUEST['order_hp']) 			?	 $_REQUEST['order_hp'] 			: ""; 
		$order_email 	= isset($_REQUEST['order_email']) 		?	 $_REQUEST['order_email'] 		: "";
		$order_password	= isset($_REQUEST['order_password']) 	?	 $_REQUEST['order_password'] 	: ""; 
		$order_address	= isset($_REQUEST['order_address']) 	?	 $_REQUEST['order_address'] 	: "";

		$str_customer 	= "SELECT CUSTOMER_EMAIL FROM ".$tpref."customers WHERE CUSTOMER_EMAIL = '".$order_email."'";
		$num_customer 	= $db->recount($str_customer); 
		if($num_customer == 0){
			$customer_content 	= array(1=>
				array("CUSTOMER_EMAIL",$order_email),
				array("CUSTOMER_PASS",$order_password),
				array("CUSTOMER_NAME",$order_name),
				array("CUSTOMER_PHONE",$order_hp),
				array("CUSTOMER_ADDRESS",$order_address),
				array("UPDATEDATE",$tglupdate));
			$db->insert($tpref."customers",$customer_content);
			$id_customer = mysql_insert_id();
			$_SESSION['cidname'] 	= $order_name;
			$_SESSION['cidkey'] 	= $id_customer;
			$_SESSION['cidemail']	= $order_email;
			$_SESSION['cidhp'] 		= $order_hp;
			$result['io'] = '2';
			$result['msg'] = '<div class="alert alert-success col-md-12">
								<small>
									Terimakasih <b>'.$order_name.'</b>, anda berhasil terdaftar sebagai anggota komunitas itshijab, periksa email anda, jika tidak terdapat di kotak masuk, silahkan periksa di kotak Spam..terimakasih.
								</small>
							  </div>';
			$to 			= $order_email;
			$from 			= "crew@itshijab.com";
			$subject 		= '[PENTING] Informasi Akun ItsHijab';
			$headers 		= "From: ItsHijab Crew <" . strip_tags($from) . ">\r\n";
			$headers 		.= "MIME-Version: 1.0\r\n";
			$headers 		.= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
			$content = '		
			<h3>Selamat Datang, <b>'.$order_name.'</b></h3>
			<p class="lead">Terimakasih telah menjadi anggota komunitas itshijab, anda menerima email ini karena anda baru saja menjadi anggota komunitas ItsHijab.com,dengan informasi akun dibawah ini  
			</p>
			<!--<p><img src="http://placehold.it/600x300" /></p> /hero -->
			<p class="callout">
				<label><b>Email<b></label>:<br>'.$order_email.'<br>
				<label><b>Password<b></label><br>'.$order_password.'<br>
				<!--<a href="#">Do it Now! &raquo;</a>-->
			</p>
			<p>Silahkan disimpan baik-baik, untuk dapat mendapatkan layanan-layanan menarik dari ItsHijab.com</p><br><br>
			<a href="'.$dirhost.'" target="_blank" class="btn">Click Me!</a>';
			include($basepath."/files/email_templates/hero/view.php");
			mail($to, $subject, $message, $headers);	
			$owner			= "thetakur@gmail.com,akunadz@gmail.com";
			$subject2owner	= "Pendaftaran Anggota Itshijab";
			$message2owner	= "Selamat ".$order_name." baru saja mendaftar sebagai anggota itshijab.com";
			mail($owner, $subject2owner, $message2owner, $headers);		  
		}else{
			$result['io'] = '1';
			$result['msg'] = '<div class="alert alert-success col-md-12">
								<small>
									Maaf, Akun email ini sudah terdaftar di itshijab, silahkan masuk menggunakan email ini, atau jika anda pemilik email ini, silahkan klik tombol <b>Lupa Password</b>
								</small>
							  </div>';
		}
	}


	if(!empty($direction) && $direction == "save_login"){
		$cemail 	= isset($_REQUEST['cemail']) 		?	 $sanitize->email($_REQUEST['cemail']) 	: "";
		$cpassword	= isset($_REQUEST['cpassword']) 	?	 $_REQUEST['cpassword'] 				: "";
		$str_customer 			= "SELECT * FROM ".$tpref."customers WHERE CUSTOMER_EMAIL = '".$cemail."' AND CUSTOMER_PASS='".$cpassword."'";
		$q_customer 			= $db->query($str_customer); 
		$dt_customer 			= $db->fetchNextObject($q_customer);
		$num_customer			= $db->numRows($q_customer);
		if($num_customer > 0){
			$_SESSION['cidkey'] 	= $dt_customer->ID_CUSTOMER;
			$_SESSION['cidname']	= $dt_customer->CUSTOMER_NAME;
			$_SESSION['cidemail']	= $dt_customer->CUSTOMER_EMAIL;
			$_SESSION['cidhp'] 		= $dt_customer->CUSTOMER_PHONE;
			$result['id_login'] 	= $dt_customer->ID_CUSTOMER;
			$result['io'] 			= '2';
			$result['msg'] 			= '';
		}else{
			$result['io'] 			= '1';
			$result['msg'] = '<div class="alert alert-success col-md-12">
								<small>
									Maaf, email atau password anda salah, silahkan ulangi atau silahkan klik tombol <b>Lupa Password</b>
								</small>
							  </div>';
		}
	}
	echo json_encode($result); 
}



?>
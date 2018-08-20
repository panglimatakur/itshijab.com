<?php defined('mainload') or die('Restricted Access'); ?>
<?php
	if(!empty($_REQUEST['noinvoice']))		{ $noinvoice 	= $sanitize->str(strtoupper($_REQUEST['noinvoice'])); 	}
	if(!empty($_REQUEST['nmbank']))			{ $nmbank 		= $sanitize->number($_REQUEST['nmbank']); 				}
	if(!empty($_REQUEST['nmrek']))			{ $nmrek 		= $sanitize->str(strtoupper($_REQUEST['nmrek'])); 		}
	if(!empty($_REQUEST['norek']))			{ $norek 		= $sanitize->number($_REQUEST['norek']); 				}
	if(!empty($_REQUEST['nmbank_dest']))	{ $nmbank_dest 	= $sanitize->number($_REQUEST['nmbank_dest']); 			}
	if(!empty($_REQUEST['jml_bayar']))		{ $jml_bayar 	= $sanitize->number($_REQUEST['jml_bayar']); 			}
	
	if(!empty($_REQUEST['nama_rec']))		{ $nama_rec 	= $sanitize->str($_REQUEST['nama_rec']); 				}
	if(!empty($_REQUEST['email_rec']))		{ $email_rec 	= $sanitize->email($_REQUEST['email_rec']); 			}
	if(!empty($direction) && $direction == "confirm"){
		
		if(!empty($noinvoice) && !empty($nmbank) && !empty($nmrek) && !empty($norek) && !empty($nmbank_dest) && 
		   !empty($jml_bayar)){
			$q_purchase 	= $db->query("SELECT ID_PURCHASE,RECIEVER_NAME,ID_USER FROM ".$tpref."customers_purchases 
										  WHERE PAYMENT_CODE = '".$noinvoice."'");
			$ch_invoice		= $db->numRows($q_purchase);
			if($ch_invoice > 0){
				$dt_purchase= $db->fetchNextObject($q_purchase);
				$nama_rec	= $dt_purchase->RECIEVER_NAME;
				$email_rec	= $db->fob("USER_EMAIL","system_users_client"," WHERE ID_USER = '".$dt_purchase->ID_USER."'");
				$container 	= array(1=>
								array("BANK_NAME",@$nmbank),
								array("BANK_ACCOUNT_NAME",@$nmrek),
								array("BANK_ACCOUNT_NUMBER",@$norek),
								array("TO_ID_BANK_ACCOUNT",@$nmbank),
								array("PAID_STATUS","2"),
								array("PAID_DATETIME",@$tglupdate));
				$db->update($tpref."customers_purchases",$container," WHERE PAYMENT_CODE = '".$noinvoice."'");
				
				$to 		= 'ITS Hijab Billing <billing@itshijab.com>, Nadia <akunadz@gmail.com>, Takur <thetakur@gmail.com>';
				$subject	= "[PENTING] Konfirmasi Pembayaran Invoice ".$noinvoice;
				$msg 		= "Segera Di proses <a href='".$dirhost."/?module=cpanel&page=products_orders'>Check Pemesanan</a>";
				$type 		= "html";
				sendmail($to,$subject,$msg,$from,$type);
				redirect_page($lparam."&msg=1&email_rec=".$email_rec."&nama_rec=".$nama_rec);
			}else{
				$msg = 3;
			}
		 }else{
			$msg = 2; 
		 }
	}
?>
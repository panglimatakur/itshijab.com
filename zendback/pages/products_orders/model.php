<?php defined('mainload') or die('Restricted Access'); ?>
<?php

$condition	= "";
if(!empty($statlun)){
	$condition .= " AND a.PAID_STATUS 	= '".$statlun."'";
}else{
	$condition .= " AND a.PAID_STATUS = '1'";	
}
$purchase_cust  = "SELECT 
						b.*,a.*
				   FROM 
						".$tpref."customers_purchases a,
						system_users_client b
				   WHERE 
						a.ID_USER = b.ID_USER 
						".$condition." 
				   GROUP BY 
						a.ID_USER 
				   ORDER BY 
						a.ID_PURCHASE ASC";
//echo $purchase_cust;
$q_purchase 	= $db->query($purchase_cust);
$num_purchase   = $db->numRows($q_purchase);

$q_product_status = $db->query("SELECT * FROM ".$tpref."transaction_status_master ORDER BY ID_TRANSACTION_STATUS");
?>
<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 		= isset($_REQUEST['direction']) ? $_REQUEST['direction'] 		: "";
	$id_bank 		= isset($_REQUEST['id_bank']) 	? $_REQUEST['id_bank'] 		: "";
	
	if(!empty($direction) && $direction == "get_info_bank"){
		$str_bank 		= "SELECT * FROM system_master_bank_info WHERE ID_BANK_ACCOUNT = '".$id_bank."' ORDER BY BANK_NAME ASC";
		$q_bank 		= $db->query($str_bank);
		$dt_bank		= $db->fetchNextObject($q_bank);
    ?>
    <fieldset style="margin-bottom:8px; border-bottom:1px solid #E8E8E8; padding-bottom:10px">
    	<legend>Informasi Bank</legend>
    
    	<b><?php echo $dt_bank->BANK_NAME;?></b><br>
    	a/n <?php echo $dt_bank->BANK_ACCOUNT_NAME;?><br>
    	<?php echo $dt_bank->BANK_ACCOUNT_NUMBER;?><br>
	</fieldset>
	<?php
    }
}
?>
<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 		= isset($_REQUEST['direction']) ? $_REQUEST['direction'] 	: "";
	$propinsi 		= isset($_REQUEST['propinsi']) 	? $_REQUEST['propinsi'] 	: "";
	$lokasi 		= isset($_REQUEST['lokasi']) 	? $_REQUEST['lokasi'] 	: "";
	if(!empty($direction) && $direction == "get_location"){
	$q_lokasi = $db->query("SELECT * FROM ".$tpref."tarif_jne_master WHERE PROVINCE = '".$propinsi."' ORDER BY DESTINATION ASC");
?>
        <select class="form-control" id="dest_code" name="lokasi" style="width:200px" onchange="get_package(this)">
            <option value="">-PILIH LOKASI--</option>
            <?php
            while($dt_lokasi = $db->fetchNextObject($q_lokasi)){?>
            <option value="<?php echo $dt_lokasi->DESTINATION_CODE; ?>">
				 <?php echo $dt_lokasi->DESTINATION; ?>
            </option>
            <?php } ?>
        </select>
<?php
	}	
	if(!empty($direction) && $direction == "get_package"){
		$q_rate 	= $db->query("SELECT * FROM ".$tpref."tarif_jne_master WHERE DESTINATION_CODE = '".$lokasi."' ORDER BY DESTINATION ASC");
		$dt_rate 	= $db->fetchNextObject($q_rate);
		@$reg_tarif = $dt_rate->REG_TARIF;
		@$reg_est 	= $dt_rate->REG_EST;
		@$ok_tarif 	= $dt_rate->OK_TARIF;
		@$ok_est 	= $dt_rate->OK_EST;
		@$yes_tarif = $dt_rate->YES_TARIF;
		@$yes_est 	= $dt_rate->YES_EST;
?>
        <label class="req">Paket Pengiriman</label><br />
        <select class="paket form-group" id="paket" onchange="add_tarif(this)">
        	<option value="" data-info="">-- PILIH PAKET --</option>
        <?php if($propinsi == "JAWA BARAT"){?>
        	<option value="COD" data-info="">COD</option>
        <?php } ?>
		<?php if(!empty($reg_tarif)){ ?>
        	<option value="REG" data-info="<?php echo $reg_tarif; ?>">
            REGULER - 
			<?php echo money("Rp.",$reg_tarif); ?> - <?php if(!empty($reg_est)){?>(<?php echo @$reg_est; ?> Hari)<?php } ?> 
            </option>
        <?php } ?>
		<?php if(!empty($ok_tarif)){ ?>
            <option value="OK" data-info="<?php echo @$ok_tarif; ?>">
            OK - 
			<?php echo money("Rp.",$ok_tarif); ?> - 
            <?php if(!empty($ok_est)){?>(<?php echo @$ok_est; ?> Hari)<?php } ?>
            </option>
        <?php } ?>
        <?php if(!empty($yes_tarif)){ ?>
            <option value="YES" data-info="<?php echo @$yes_tarif; ?>">
            YES - 
            <?php echo money("Rp.",$yes_tarif); ?> - 
            <?php if(!empty($yes_est)){?>(<?php echo @$yes_est; ?> Hari)<?php } ?>
            </option>
        <?php } ?>
        </select>

<?php
	}
}
?>
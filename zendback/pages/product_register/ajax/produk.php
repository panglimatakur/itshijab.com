<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ALIBABA',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$no 		= isset($_REQUEST['no']) ? $_REQUEST['no'] : "";
	$q_produk 	= $db->query("SELECT * FROM ".$tpref."products WHERE ID_PRODUCT='".$no."'");
	$dt_produk	= $db->fetchNextObject($q_produk);
?>
<div class="span6">
    <h3 class="w-box-header"><?php echo @$dt_produk->CODE; ?> : <?php echo $dt_produk->NAME; ?></h3>
        <?php
        $q_photos 	= $db->query("SELECT * FROM ".$tpref."products_photos WHERE ID_PRODUCT='".$no."'");
        while($dt_photos = $db->fetchNextObject($q_photos)){
            if(!empty($dt_photos->PHOTOS) || is_file($basepath."/files/images/products/".$id_client."/".$dt_photos->PHOTOS)){
        ?>
            <img src='<?php echo $dirhost; ?>/files/images/products/<?php echo $id_client; ?>/<?php echo $dt_photos->PHOTOS; ?>' class='photo' style='float:left; width:96%'/>
        <?php 
            }
        }
		@$satuan = $db->fob("NAMA",$tpref."products_units"," WHERE ID_PRODUCT_UNIT='".$dt_produk->ID_PRODUCT_UNIT."'")
        ?>
        <br clear="all" />
        <div style="margin-top:5px;">
            <?php if(!empty($dt_produk->DESCRIPTION)){?>
            <b>DESKRIPSI : </b><br />
            <?php echo @$dt_produk->DESCRIPTION; ?>
            <br />
            <?php } ?>
            
            <?php if(!empty($satuan)){?>
            <b>SATUAN : </b><?php  echo @$satuan; ?>
            <br />
            <?php } ?>
        </div>
</div>
<?php } ?>
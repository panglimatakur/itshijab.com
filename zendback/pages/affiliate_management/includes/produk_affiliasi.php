<?php defined('mainload') or die('Restricted Access'); ?>

<div class="col-md-12">
<div class="alert alert-warning">
	<b>Peringatan :</b> Informasi produk-produk dibawah ini, bisa saja berubah setiap saat, jika stock sudah habis
</div>
<?php
$q_product_affilateable = $db->query("SELECT * FROM ".$tpref."products WHERE AFFILIATEABLE_ID IS NOT NULL ORDER BY AFFILIATEABLE_ID ASC");
while($dt_product_affilateable = $db->fetchNextObject($q_product_affilateable)){
	@$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product_affilateable->ID_PRODUCT."'");
	@$unit		= $db->fob("NAME",$tpref."products_units"," WHERE ID_PRODUCT_UNIT = '".$dt_product_affilateable->ID_PRODUCT_UNIT."'");
	$img_able = "";
?>
		<div class="col-md-6">        
        <div class="thumbnail" style="height:400px; margin-top:5px; width:100%">
			<div class="col-md-2">
			<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){ $img_able = 1; ?>
            	<img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive" alt=""/>
            <?php }else{?>
            	<img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive" alt=""/>
            <?php } ?>
            </div>
            <div class="col-md-10">
            <h4><b><?php echo $dt_product_affilateable->NAME; ?></b></h4>
            <p><?php echo cutext($dt_product_affilateable->DESCRIPTION,100); ?></p>
            <p>
                <b>
                    Harga : <?php echo money("Rp.",$dt_product_affilateable->SALE_PRICE); ?><br />
                    Stock : <?php echo $dt_product_affilateable->STOCK; ?> <?php echo @$unit; ?>
                </b>
            </p>
            </div>
            <div class="col-md-12">
<fieldset>
	<legend>Copy & Paste Model Link Affiliasi Dibawah Ini</legend>
<pre>
&#60;a hre="<?php echo @$dirhost; ?>/me/<?php echo $aff_id; ?>/<?php echo $dt_product_affilateable->AFFILIATEABLE_ID; ?>&#62;
  <?php echo $dt_product_affilateable->NAME; ?>

&#60;/a&#62;
</pre>
<?php if(!empty($img_able)){?>
atau<br />
<pre style="margin-top:4px">
&#60;a hre="<?php echo @$dirhost; ?>/me/<?php echo $aff_id; ?>/<?php echo $dt_product_affilateable->AFFILIATEABLE_ID; ?>&#62;
  &#60;img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" width="20%" &#62
&#60;/a&#62;
</pre>
<?php } ?>
</fieldset>
            </div>
        </div>
        </div>
<?php } ?>
</div>
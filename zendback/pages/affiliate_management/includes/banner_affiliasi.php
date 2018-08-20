<?php defined('mainload') or die('Restricted Access'); ?>

<div class="col-md-12">
<?php
$q_banner_affilateable = $db->query("SELECT * FROM ".$tpref."banner WHERE ID_BANNER_TYPE = '3' ORDER BY ID_BANNER ASC");
while($dt_banner_affilateable = $db->fetchNextObject($q_banner_affilateable)){
	$photo = $dt_banner_affilateable->FILETARGET;
?>
		<div class="col-md-6">         
        <div class="thumbnail" style="height:400px; margin-top:5px; width:100%">
			<div class="col-md-12" style="text-align:center">
			<?php if(!empty($photo) && is_file($basepath."/files/images/banners/".$photo)){ ?>
            	<img src="<?php echo $dirhost; ?>/files/images/banners/<?php echo $photo; ?>" class="img-responsive" alt=""/>
            <?php }else{?>
            	<img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive" alt=""/>
            <?php } ?>
            </div>
            <div class="col-md-12">
<fieldset>
	<legend>Copy & Paste Model Link Affiliasi Dibawah Ini</legend>
<pre style="margin-top:4px">
&#60;a hre="<?php echo @$dirhost; ?>/me/<?php echo $aff_id; ?>/1&#62;
  &#60;img src="<?php echo $dirhost; ?>/files/images/banners/<?php echo $photo; ?>" width="20%" &#62
&#60;/a&#62;
</pre>
</fieldset>
            </div>
        </div>
        </div>
<?php } ?>
</div>
<?php defined('mainload') or die('Restricted Access'); ?>
<?php 
	if(!empty($msg)){
		switch ($msg){
			case "1":
				echo msg("Data Link Berhasil Disimpan","success");
			break;
			case "2":
				echo msg("Data Link Berhasil Disimpan dan Di Perbaiki","success");
			break;
			case "3":
				echo msg("Pengisian Form Belum Lengkap","error");
			break;
		}
	}
?>
<form  class="t-box shadow" id="formID" action="" method="POST" enctype="multipart/form-data">

<div class="col-md-6" style="max-height:800px; overflow:scroll; padding-left:10px" >
    <div class="x_panel">
        <?php include $call->inc($page_dir."/includes","list.php");  ?>
    </div>
</div>
<div class="col-md-6">
	<div class="x_panel">
		<?php include $call->inc($page_dir."/includes","form.php"); ?>
	</div>
</div>
</form>
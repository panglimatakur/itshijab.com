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
<div class="col-md-6" style="max-height:530px; overflow:scroll; padding-left:10px" >
    <div class="x_panel" style="height:530px;">
		<?php include $call->inc($page_dir."/includes","list.php");  ?>
    </div>
</div>
<div class="col-md-6">
	<div class="x_panel">
		<?php include $call->inc($page_dir."/includes","form.php"); ?>
	</div>
</div>

<div class="col-md-12">
	<div class="x_panel">
        <div class="form-group col-md-12">
            <label class='req'>Isi Berita</label>
            <section id="editor" style="padding:0; width:100%; margin:0">
              <textarea id='edit' class='editor' name="isi" style="margin:0; height:700px "><?php echo @$isi; ?></textarea>
            </section>  
            
            <script type="text/javascript">
                $(function(){ show_editor("#edit"); })
            </script>
        </div>
        <div class="form-group col-md-12">
        
            <?php
            if(empty($direction) || (!empty($direction) && ($direction == "insert" || $direction == 'delete'))){
                $directionvalue	= "insert";	
            }
            if(!empty($direction) && ($direction == "edit" || $direction == "save")){
                $directionvalue = "save";
                $addbutton = "
                    <a href='".$lparam."' >
                        <button class='btn btn-beoro-3' ttype='button'>Tambah Data</button>
                    </a>";
            ?>
            <input type='hidden' name='no' value='<?php echo $no; ?>'>
            <?php } ?>
            <input type='hidden' id='proses_page' value='<?php echo $ajax_dir; ?>/proses.php'>
            <button name="direction" id="direction" type="submit"  class="btn btn-primary" value="<?php echo $directionvalue; ?>" style="margin:0">Simpan Tulisan</button>
            <?php echo @$addbutton; ?>
        </div>
        <div class="clear"></div>
	</div>
</div>
</form>
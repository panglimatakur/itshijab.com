<?php defined('mainload') or die('Restricted Access'); ?>
<span id='divparent_id'>
    <?php if(!empty($parent_id)){ include $call->inc($ajax_dir,"parent.php"); } ?>
</span>
<div class="form-group col-md-6">
    <label>Tipe Kategori</label>
    <select name="contenttype" id="contenttype" class="form-control mousetrap">
        <option value=''>--TIPE KATEGORI--</option>
        <option value='1' <?php if(@$contenttype == "1"){ ?> selected <?php } ?>>Produk Barang</option>
        <option value='2' <?php if(@$contenttype == "2" ){ ?> selected <?php } ?>>Produk Jasa</option>
     </select>
</div>    
<div class="form-group col-md-6">
    <label class='req'>Nama Kategori</label>
    <input name="nama" id="nama" type="text" value="<?php echo @$nama; ?>" class="form-control mousetrap" style="text-transform:capitalize"/>
</div>
<div class="form-group col-md-6">
    <label class='req'>Judul Kategori</label>
    <input name="judul" id="judul" type="text"  value="<?php echo @$judul; ?>" class="form-control mousetrap" style="text-transform:capitalize"/>
</div>
<div class="form-group col-md-6">
    <label class='req'>Status Kategori</label><br />
    <input type="checkbox" id="sb_off" name='status' value='1' <?php if(!empty($status) && $status == 1){?> checked <?php } ?>/>
</div>
<div class="form-group col-md-12">
    <?php
    if(empty($direction) || (!empty($direction) && ($direction == "insert" || $direction == 'delete'))){
        $directionvalue	= "insert";	
    }
    if(!empty($direction) && ($direction == "edit" || $direction == "save")){
        $directionvalue = "save";
        $addbutton = "
            <a href='".$lparam."'>
                <input name='button' type='button' class='btn btn-beoro-3' value='Tambah Data'>
            </a>";
    ?>
    <input type='hidden' name='no' value='<?php echo $no; ?>'>
    <?php } ?>
    <input type='hidden' id='proses_page' value='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php'>
    <input type='hidden' id='parent_page' value='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/parent.php'>
    <button name="direction" type="submit"  class="btn btn-primary" value="<?php echo $directionvalue; ?>">Simpan Data</button>
    <?php echo @$addbutton; ?>
</div>

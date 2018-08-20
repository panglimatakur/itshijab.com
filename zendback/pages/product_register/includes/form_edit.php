<?php defined('mainload') or die('Restricted Access'); ?>
<div class=" col-md-6">
    <div class="form-group">
        <label class="req">Code</label>
        <div class="input-group">
        	<span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
        	<input type="text" name="code" value="<?php echo @$code; ?>" class="code form-control mousetrap">
        </div>
    </div>
    <div class="form-group">
       <label class="req">Nama</label>
      <input name="nama" type="text" id="nama" value="<?php echo @$nama; ?>" class="form-control mousetrap" />
    </div>
    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" class="form-control  mousetrap"><?php echo @$deskripsi; ?></textarea>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <div class="input-group">
            <span class="input-group-addon">Rp.</span>
            <input name="harga" type="text" id="harga" value="<?php echo @$harga; ?>" class="form-control mousetrap numeric" />
        </div>
    </div>
    <div class="form-group">
        <label>Discount</label>
        <div class="input-group">
            <input name="discount" type="text" id="discount" value="<?php echo @$discount; ?>" class="form-control mousetrap  numeric"/>
            <span class="input-group-addon">%</span>
        </div>
    </div>
    <div class="form-group">
        <label>Satuan</label>
        <select name="satuan" id="satuan" class="form-control  mousetrap">
            <option value=''>--PILIH SATUAN--</option>
            <?php
            $query_unit = $db->query("SELECT * FROM ".$tpref."products_units ORDER BY NAME");
            while($data_unit = $db->fetchNextObject($query_unit)){
            ?>
                <option value='<?php echo $data_unit->ID_PRODUCT_UNIT; ?>' <?php if(!empty($satuan) && $satuan == $data_unit->ID_PRODUCT_UNIT){?> selected<?php } ?>><?php echo $data_unit->NAME; ?></option>
        <?php } ?>
        </select>
    </div>
</div>
<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-9">
    <form method="post" action="" enctype="multipart/form-data" >
        <div class="form-group">
          <label class="req">Logo</label>
           <div class="clear"></div>
          <input type="file" name="logo" id="logo" class="form-control" />
        </div>
        <div class="clear"></div>
        <div class="form-group" style="margin-top:9px">
           <label class="req">Nama</label>
          <input name="nama" type="text" id="nama" value="<?php echo @$nama; ?>" class=" validate[required] text-input form-control" />
        </div>
        <div class="form-group">
          <label class="req">Alamat</label>
          <textarea name="alamat" id="alamat" class=" validate[required] text-input form-control"><?php echo @$alamat; ?></textarea>
        </div>
        <div class="form-group">
          <label class="req">No Tlp</label>
          <input type="text" name="tlp" id="tlp" value="<?php echo @$tlp; ?>" class=" validate[required] text-input form-control" />
        </div>
        <div class="form-group">
          <label class="req">Kontak Person</label>
          <input type="text" name="kontak" id="kontak" value="<?php echo @$kontak; ?>" class=" validate[required] text-input form-control" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" id="email" value="<?php echo @$email; ?>" class="form-control" />
        </div>
        <div class="form-group">
          <label>Website</label>
          <input type="text" name="website" id="website" value="<?php echo @$website; ?>" class="form-control" />
        </div>
        <div class="form-group">
            <?php
            if(empty($direction) || 
            (!empty($direction) && ($direction != "edit" || $direction != "show"))){
                $prosesvalue = "insert";	
            }
            if(!empty($direction) && ($direction != "get_form" && ($direction != "insert" || $direction != "delete" || $direction != "show"))){
                $prosesvalue = "save";
                $addbutton = "
                    <a href='".$lparam."'>
                        <input name='button' type='button' class='btn btn-beoro-3' value='Tambah Data'>
                    </a>";
        ?>
            <input type='hidden' name='no' id='no' value='<?php echo $no; ?>' />
            <?php
            }
        ?>
            <button name="Submit" type="submit" id="button_cmd" class="btn btn-beoro-4">Simpan Data</button>
            <?php echo @$addbutton; ?>
            <input type='hidden' name='direction' id='direction' value='<?php echo $prosesvalue; ?>' />
        </div>
    </form>
</div>

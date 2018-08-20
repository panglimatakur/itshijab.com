<?php defined('mainload') or die('Restricted Access'); ?>
<input type="hidden" id="proses_page"  value="<?php echo @$dirhost; ?>/<?php echo @$ajax_dir; ?>/proses.php">
<input type="hidden" id="data_page"  value="<?php echo @$dirhost; ?>/<?php echo @$ajax_dir; ?>/data.php">
<div class="form-group col-md-12">
	<?php 
        if(!empty($msg)){
            switch ($msg){
                case "1":
                    echo msg("Data Berhasil Disimpan","success");
                break;
                case "2":
                    echo msg("Pengisian Form Belum Lengkap","error");
                break;
                case "3":
                    echo msg("Konfirmasi Password tidak sesuai, silahkan ulangi","error");
                break;
                case "4":
                    echo msg("Maaf, akun email ini sudah terdaftar, silahkan gunakan email yang lain","error");
                break;
            }
        }
    ?>

    <form method="post" action="" enctype="multipart/form-data" >
      <div class="form-group  col-md-6" >
           <label class="req">Nama Lengkap</label>
          <input name="nama" type="text" id="nama" value="<?php echo @$nama; ?>" class="form-control" Required/>
        </div>
        <div class="form-group col-md-6">
          <label class="req">No HP</label>
          <input type="text" name="tlp" id="tlp" value="<?php echo @$tlp; ?>" Required class="form-control" />
        </div>
      <div class="form-group col-md-6">
          <label class="req">Email</label>
          <input type="text" name="email" id="email" value="<?php echo @$email; ?>" Required class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label class="req">Password</label>
          <input type="password" name="upassword" id="upassword" value="" Required class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label class="req">Konfirmasi Password</label>
          <input type="password" name="kupassword" id="kupassword" value="" Required class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label class="req">Jenis Kelamin</label>
          <select name="gender" id="gender" class="form-control" />
          	<option value="">--JENIS KELAMIN--</option>
            <option value="L" <?php if(!empty($gender) && $gender == "L"){?>selected<?php } ?>>Laki-Laki</option>
            <option value="P" <?php if(!empty($gender) && $gender == "P"){?>selected<?php } ?>>Perempuan</option>
          </select>
        </div>
      <div class="form-group col-md-12">
            <button name="Submit" type="submit" id="button_cmd" class="btn btn-primary"><i class="fa fa-user"></i> Simpan Data Anggota</button>
            <?php echo @$addbutton; ?>
            <input type='hidden' name='direction' id='direction' value='insert' />
        </div>
    </form>
</div>


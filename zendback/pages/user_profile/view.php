<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Profil <span class="title-highlight">Pengguna</span></h2>
            <div class="clearfix"></div>
        </div>
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
            <form class="formular" id="formID" action="" method="POST" enctype="multipart/form-data">
             <div class=" col-md-4">
                <div class="form-group">
                    <label>Photo</label><br>
                    <?php 
                        if(is_file($basepath."/files/images/users/".@$photo)){
                    ?>
                        <img src='<?php echo $dirhost; ?>/files/images/users/big/<?php echo $photo; ?>' class="img-avatar" width="90%"/><br />
                    <?php } 
                    ?>
                    <input type="file" name="photo" id="photo" class='file_1'/>
                </div>
            </div>
            <div class=" col-md-8">
                <div class="form-group col-md-6">
                  <label class="req">Nama Lengkap</label>
                  <input type="text" name="fname" id="fname" value="<?php echo @$fname; ?>" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="req">Email</label>
                  <input type="text" name="email" id="email" value="<?php echo @$email; ?>" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Password</label>
                  <input type="text" name="password" id="password" value="<?php echo @$password; ?>" class="form-control" >
                </div>
                <div class="form-group col-md-6">
                  <label>No HP</label>
                  <input type="text" name="phone" id="phone" value="<?php echo @$phone; ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label class="req">Jenis Kelamin</label>
                  <select name="gender" id="gender" class="form-control" />
                    <option value="">--JENIS KELAMIN--</option>
                    <option value="L" <?php if(!empty($gender) && $gender == "L"){?>selected<?php } ?>>Laki-Laki</option>
                    <option value="P" <?php if(!empty($gender) && $gender == "P"){?>selected<?php } ?>>Perempuan</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="req">Tempat Lahir</label>
                  <input type="text" name="tptlhr" id="tptlhr" value="<?php echo @$tptlhr; ?>" Required class="form-control" /> 
                </div>
                <div class="form-group col-md-6">
                  <label class="req">Tanggal Lahir</label>
                    <div class="input-group date" id="datetimepicker1">
                          <input type="text" name="tgllhr" id="tgllhr" value="<?php echo @$tgllhr; ?>" Required class="form-control" />
                      <span class="input-group-addon" ><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>                
                </div>
                <div class="form-group col-md-12">
                  <label class="req">Alamat</label>
                  <textarea type="text" name="alamat" id="alamat"class="form-control" ><?php echo @$alamat; ?></textarea>
                </div>
            </div>
            <div class=" col-md-12">
                <div class="form-group">
                  <label>&nbsp;</label>
                     <button type="submit" name="direction" class="btn btn-primary" value="save" style="color:#FFF"/>
                     Simpan Data
                     </button>
                    <input type='hidden' id='proses_page' value='<?php echo $ajax_dir; ?>/proses.php'>
                </div>
            </div>
            </form>
            <br clear="all" />    
    </div>
</div>
<script language="javascript">
    $(function(){
		$('#datetimepicker1').datetimepicker({format: "DD-MM-YYYY"});
	});
</script>

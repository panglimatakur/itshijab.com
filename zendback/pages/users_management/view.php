<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Input Data <span class="title-highlight">Pengguna</span></h2>
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

    <form method="post" action="" enctype="multipart/form-data" >
      <div class="form-group col-md-12" id="photo_container">
      <?php if(!empty($direction) && $direction == "edit"){
        if(is_file($basepath."/files/images/users/".$photo)){ ?>
            <img src="<?php echo $dirhost; ?>/files/images/users/<?php echo $photo; ?>" class="thumbnail" width="30%" />
            <span id="div_loader_img"></span>
            <button type="button" class="btn btn-primary" id="del_pic" data-info="<?php echo $no; ?>"><i class="fa fa-trash-o"></i> Hapus Foto</button>
        <?php }
	  } 
	  ?>
      </div>
      <div class="form-group col-md-6">
          <label class="req">Photo</label>
           <div class="clear"></div>
          <input type="file" name="photo" id="photo" class="form-control" />
        </div>
        <div class="clear"></div>
      <div class="form-group  col-md-6" >
           <label class="req">Nama Lengkap</label>
          <input name="nama" type="text" id="nama" value="<?php echo @$nama; ?>" class="form-control" Required/>
        </div>
      <div class="form-group col-md-6">
           <label class="req">Nama Panggilan</label>
          <input name="namap" type="text" id="namap" value="<?php echo @$namap; ?>" class="form-control" Required/>
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
          <label class="req">No HP</label>
          <input type="text" name="tlp" id="tlp" value="<?php echo @$tlp; ?>" Required class="form-control" />
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
      <div class="form-group col-md-6">
          <label class="req">Email</label>
          <input type="text" name="email" id="email" value="<?php echo @$email; ?>" Required class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label>Password</label>
          <input type="text" name="upassword" id="upassword" value="<?php echo @$upassword; ?>" <?php if(empty($direction)){?>Required <?php } ?> class="form-control" />
        </div>
        <div class="form-group col-md-6">
            <label class="req">Tingkat Jabatan</label>
          <select name="id_user_level" id="id_user_level" Required class="form-control" >
                <option value="">--LEVEL USER CLIENT--</option>
                <?php while($dt_client_user_level = $db->fetchNextObject($q_client_level)){?>
                    <option value='<?php echo $dt_client_user_level->ID_CLIENT_USER_LEVEL; ?>' <?php if(!empty($id_user_level) && $id_user_level == $dt_client_user_level->ID_CLIENT_USER_LEVEL){?> selected<?php } ?>>
                        <?php echo $dt_client_user_level->NAME; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
      <div class="form-group col-md-6">
          <label class="req">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control" Required><?php echo @$alamat; ?></textarea>
        </div>
      <div class="form-group col-md-12">
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
            <button name="Submit" type="submit" id="button_cmd" class="btn btn-primary">Simpan Data Kontributor</button>
            <?php echo @$addbutton; ?>
            <input type='hidden' name='direction' id='direction' value='<?php echo $prosesvalue; ?>' />
        </div>
    </form>

    <input id="proses_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php" />
    <input id="data_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php" />
</div>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar <span class="title-highlight">Pengguna</span></h2>
            <div class="clearfix"></div>
        </div>

	<br clear="all" />
    <a name="report"></a>
    <?php if($num_partner > 0){ ?>
    <table width="100%" class="table table-striped table-bordered table-bordered responsive-utilities jambo_table ">
        <thead>
            <tr>
                <th width="274">Photo</th>
                <th width="606">Informasi</th>
                <th width="195">Actions</th>
            </tr>
        </thead>
        <tbody>
              <?php while($dt_partner	= $db->fetchNextObject($q_partner)){ 
              ?>
              <tr id="tr_<?php echo $dt_partner->ID_USER; ?>">
                <td style="vertical-align:top">
                	<?php if(is_file($basepath."/files/images/users/".$dt_partner->USER_PHOTO)){?>
                    	<img src="<?php echo $dirhost; ?>/files/images/users/<?php echo $dt_partner->USER_PHOTO; ?>" class="thumbnail" width="90%" />
                    <?php }else{ ?>
                    	<?php if($dt_partner->USER_GENDER == "L"){?>
                    		<img src="<?php echo $dirhost; ?>/files/images/user.png" class="thumbnail" width="90%"/>
                        <?php }else{ ?>
                    		<img src="<?php echo $dirhost; ?>/files/images/user-f.png" class="thumbnail" width="90%" />
                        <?php } ?>
                    <?php } ?>
                </td>
                <td>
					<div class="form-group">
                        <label>Nama Lengkap</label><br />
                        <?php echo @$dt_partner->USER_NAME; ?>
                	</div>
					<div class="form-group">
                        <label>Telephone</label><br />
                        <?php echo @$dt_partner->USER_PHONE; ?>
                	</div>
					<div class="form-group">
                        <label>Email</label><br />
                        <?php echo @$dt_partner->USER_EMAIL; ?>
                	</div>
					<div class="form-group">
                        <label>Jenis Kelamin</label><br />
                        <?php if(!empty($dt_partner->USER_GENDER) && $dt_partner->USER_GENDER == "L"){?>Laki-Laki<?php } ?>
                        <?php if(!empty($dt_partner->USER_GENDER) && $dt_partner->USER_GENDER == "P"){?>Perempuan<?php } ?>
                	</div>
					<div class="form-group">
                        <label>Alamat</label><br />
                        <?php echo @$dt_partner->USER_ADDRESS; ?>
                	</div>
                    
                    <br />
                </td>
                <td style="vertical-align:top; text-align:center; padding-top:15px;">
                    <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt_partner->ID_USER; ?>" title="Edit">
                        <button class="btn" type="button"><i class="fa fa-pencil"></i></button>
                    </a>
                    <a href='javascript:void()' onclick="removal('<?php echo $dt_partner->ID_USER; ?>')" title="Delete">
                        <button class="btn" type="button"><i class="fa fa-trash"></i></button>
                    </a>
                </td>
            </tr>
            <?php } ?>    
        </tbody>
    </table>
    <?php }else{
        echo "<br>";
        echo msg("Tidak Ada Customer Yang Terdaftar","error");
    } ?>

    
    </div>
</div>
                    
<script language="javascript">
    $(function(){
		$('#datetimepicker1').datetimepicker({format: "DD-MM-YYYY"});
	});
</script>


<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-9">
<form method="post" action="" >
    <div class="form-group">
       <label>Nama</label>
      <input name="nama_report" type="text" value="<?php echo @$nama_report; ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat_report" class="form-control"><?php echo @$alamat_report; ?></textarea>
    </div>
    <div class="form-group">
      <label>No Tlp</label>
      <input type="text" name="tlp_report" value="<?php echo @$tlp_report; ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label>Kontak Person</label>
      <input type="text" name="kontak_report" value="<?php echo @$kontak_report; ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email_report" value="<?php echo @$email_report; ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label>Website</label>
      <input type="text" name="website_report" value="<?php echo @$website_report; ?>" class="form-control" />
    </div>
    <div class="form-group">
        <button name='direction' id='direction' type="submit" class="btn btn-beoro-4" value="show">Lihat Data</button>
    </div>
</form>
</div>
<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Informasi <span class="title-highlight">Kontak</span></h2>
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
            }
        }
    ?>
    <form class="formular" id="formID" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group col-md-6">
        <label>Logo Perusahaan</label><br>
        <?php 
            if(is_file($basepath."/files/images/".@$photo)){
        ?>
            <img src='<?php echo $dirhost; ?>/files/images/<?php echo $photo; ?>' class="img-avatar" /><br />
        <?php } 
        ?>
        <input type="file" name="photo" id="photo" class='file_1'/>
    </div>
    <div class="form-group col-md-6">
      <label class="req">Nama Perusahaan</label>
      <input type="text" name="name" id="name" value="<?php echo @$name; ?>" class="form-control" required>
    </div>
    <div class="form-group col-md-6">
      <label class="req">Email Perusahaan</label>
      <input type="text" name="email" id="email" value="<?php echo @$email; ?>" class="form-control" required>
    </div>
    <div class="form-group col-md-6">
      <label class="req">Telephone Perusahaan</label>
      <input type="text" name="phone" id="phone" value="<?php echo @$phone; ?>" class="form-control">
    </div>
    <div class="form-group col-md-12">
      <label class="req">Alamat Perusahaan</label>
      <textarea name="alamat" id="alamat" class="form-control" ><?php echo @$alamat; ?></textarea>
    </div>
    <div class="pricing_features col-md-6">
        <div class="form-group">
          <label>No Rekening BCA</label>
          <input type="text" name="bcarek" id="bcarek" value="<?php echo @$bcarek; ?>" class="form-control">
         </div>
         <div class="form-group">
          <label>Nama Rekening BCA</label>
          <input type="text" name="bcaname" id="bcaname" value="<?php echo @$bcaname; ?>" class="form-control">
        </div>
    </div>
    <div class="pricing_features col-md-6">
        <div class="form-group">
          <label>No Rekening Mandiri</label>
          <input type="text" name="mandirirek" id="mandirirek" value="<?php echo @$mandirirek; ?>" class="form-control">
         </div>
         <div class="form-group">
          <label>Nama Rekening Mandiri</label>
          <input type="text" name="mandiriname" id="mandiriname" value="<?php echo @$mandiriname; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group col-md-12">
      <label>Kordinat Peta Lokasi (Google Map)</label>
      <textarea name="peta" id="peta" class="form-control"style="min-height:100px"><?php echo @$peta; ?></textarea>
    </div>
    <?php include $call->lib("redactor"); ?>
    <div class="form-group col-md-12">
        <label>Informasi Kontak Tambahan</label>
        <section id="editor" style="margin:0 0 0 0; padding:0; width:100%;">
          <textarea id='additional' name="additional" style="margin:0; "  class="form-control"><?php echo @$additional; ?></textarea>
        </section>
    </div>
    <script type="text/javascript">
    $(document).ready(
        function(){
            $('#additional').redactor({
                imageUpload: '<?php echo $redactor; ?>scripts/image_upload.php'
            });
        }
    );
    </script>
    <div class="form-group col-md-12">
      <label>&nbsp;</label><br>
         <button type="submit" name="direction" class="btn btn-primary" value="<?php echo $dir_button; ?>" /><?php echo $dir_button; ?>
         Simpan Data
         </button>
        <input type='hidden' id='proses_page' value='<?php echo $ajax_dir; ?>/proses.php'>
    </div>
    </form>
    </div>
</div>
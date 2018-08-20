<?php defined('mainload') or die('Restricted Access'); ?>    
<div class="x_title">
    <h2>Input <span class="title-highlight">Halaman</span></h2>
    <div class="clearfix"></div>
</div>
<span id='divparent_id'>
    <?php if(!empty($parent_id)){ include $call->inc($ajax_dir,"parent.php"); } ?>
</span>
NB : Simbol bintang ( <span style='color:#900'>*</span> ) wajib di isi;<br /><br />
    <div class="form-group col-md-6">
        <label class='req'>Module</label>
            <select name="id_module" id="id_module" class="form-control span4" >
                <option value='1' <?php if(!empty($id_module) && $id_module == "1"){?> selected <?php } ?>>Module Website</option>
                <option value='2' <?php if(!empty($id_module) && $id_module == "2"){?> selected <?php } ?>>Module Admin</option>
            </select>
        </span>
    </div>
    <div class="form-group col-md-6">
        <label class='req'>Posisi Nama Halaman</label>
        <select name="posisi" id="posisi" class="form-control span4" />
            <option value="bottom" 	<?php if(!empty($posisi) && $posisi =="bottom"){?> selected<?php } ?>>BAWAH</option>
            <option value="top" 	<?php if(!empty($posisi) && $posisi =="top"){?> selected<?php } ?>>ATAS</option>
            <option value="left" 	<?php if(!empty($posisi) && $posisi =="left"){?> selected<?php } ?>>KIRI</option>
            <option value="right" 	<?php if(!empty($posisi) && $posisi =="right"){?> selected<?php } ?>>KANAN</option>
        </select>		
    </div>
    <div class="form-group col-md-6">
        <label class='req'>Betuk Halaman</label>
        <select name="is_folder" id="is_folder" onchange="getcontenttype('<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/type.php?page=<?php echo $page; ?>','divctype');" class="form-control span4" >
        <option value=''>--BENTUK LINK--</option>
        <option value='1' <?php if(!empty($is_folder) && $is_folder == 1){ echo "selected"; } ?>>Folder</option>
        <option value='2' <?php if(!empty($is_folder) && $is_folder == 2){ echo "selected"; } ?>>File</option>
        </select>
    </div>
    <span id='divctype' >
        <?php if((!empty($direction) && $direction == "edit" && $is_folder == 2)){ 
            include($ajax_dir."/type.php"); 
        } ?>
    </span>
    <div class="form-group col-md-6">
        <label class='req'>Status Halaman</label>
        <br />
        <input type="checkbox" id="sb_off" name='status' value='1' <?php if(!empty($status) && $status == 1){?> checked <?php } ?> style="margin:0; width:10px;" /> Aktif

    </div>
    
    <div class="form-group col-md-12">
        <label class='req'>Nama Halaman</label>
        <input name="nama" id="nama" type="text" value="<?php echo @$nama; ?>" class="form-control span4" required />
    </div> 
    <div class="form-group col-md-12">
        <label class='req'>Judul Halaman</label>
        <input name="judul" id="judul" type="text"  value="<?php echo @$judul; ?>" class="form-control span4" required/>
    </div>
    <div class="form-group col-md-12">
        <label class='req'>Kata Kunci</label>
        <input name="edit_keywords" id="edit_keywords" type="text" value="<?php echo @$edit_keywords; ?>" class="form-control span4" />
    </div>
    <div class="form-group col-md-12">
        <label class='req'>Deskripsi Halaman</label>
        <textarea name="edit_description" id="edit_description" class="form-control span4"><?php echo @$edit_description; ?></textarea>
    </div>
    <div class="form-group col-md-12" >
        <label class='req'>Isi Halaman</label>
        <?php include $call->lib("redactor"); ?>
        <script type="text/javascript">
        $(document).ready(
            function(){
                $('#edit').redactor({
                    imageUpload: '<?php echo $redactor; ?>scripts/image_upload.php'
                });
            }
        );
        </script>
        <section id="editor" style="padding:0; width:100%; margin:0">
          <textarea id='edit' name="isi" style="margin:0; "><?php echo @$isi; ?></textarea>
        </section>  
        <?php
        if(empty($direction) || (!empty($direction) && ($direction == "insert" || $direction == 'delete'))){
            $directionvalue	= "insert";	
        }
        if(!empty($direction) && ($direction == "edit" || $direction == "save")){
            $directionvalue = "save";
            $addbutton = "
                <a href='".$lparam."' >
                    <button class='btn btn-danger' ttype='button' style='margin-top:12px;'>Tambah Data</button>
                </a>";
        ?>
        <input type='hidden' name='no' value='<?php echo $no; ?>'>
        <?php } ?>
        <input type='hidden' id='proses_page' value='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php'>
        <input type='hidden' id='parent_page' value='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/parent.php'>
        <button name="direction" id="direction" type="submit"  class="btn btn-primary" value="<?php echo $directionvalue; ?>" style="margin:10px 0 0 0; color:#FFF;">Simpan Tulisan</button>
        <?php echo @$addbutton; ?>
    </div>
<div class="clear"></div>
<div class="clear"></div>

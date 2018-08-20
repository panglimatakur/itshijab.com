<?php defined('mainload') or die('Restricted Access'); ?>    
<div class="x_title">
    <h2>Input <span class="title-highlight">Berita</span></h2>
    <div class="clearfix"></div>
</div>
    NB : Simbol bintang ( <span style='color:#900'>*</span> ) wajib di isi;<br /><br />
    <div class="form-group">
        <label class='req'>Kategori Berita</label>
        <select name="news_cat" class="form-control" required>
            <option value="">-- PILIH KATEGORI--</option>
            <?php while($dt_category = $db->fetchNextObject($q_category)){?>
                <option value="<?php echo $dt_category->ID_POST_CATEGORY; ?>" <?php if(!empty($news_cat) && $news_cat == $dt_category->ID_POST_CATEGORY){?>selected<?php } ?>>
                    <?php echo $dt_category->NAME; ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class='req'>Judul Berita</label>
        <input name="judul" id="judul" type="text"  value="<?php echo @$judul; ?>" class="form-control" required/>
    </div>
    <div class="form-group">
        <label class='req'>Cover Berita</label>
        <input name="icon" id="icon" type="file"  required/>
    </div>
    <div class="form-group">
        <label class='req'>Kata Kunci Berita</label>
        <input name="edit_keywords" id="edit_keywords" type="text" value="<?php echo @$edit_keywords; ?>" class="form-control" />
    </div>
    <div class="form-group">
        <label class='req'>Deskripsi Berita</label>
        <textarea name="edit_description" id="edit_description" class=" form-control" style="width:100%"><?php echo @$edit_description; ?></textarea>
    </div>
    <div class="form-group">
        <label class='req'>Status Tampil</label><br />
        <input type="checkbox" id="sb_off" name='status' value='1' <?php if(!empty($status) && $status == 1){?> checked <?php } ?> style="margin:0; width:10px;" /> Aktif

    </div>

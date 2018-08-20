<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
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
    <div class="x_panel">
    	<div class="x_title">
        	<h2>Input <span class="title-highlight">Testimonial</span></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" action="" enctype="multipart/form-data" >
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="req">Nama Pelanggan</label>
                        <input type="text" name="nama" id="nama" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="req">Photo Pelanggan</label>
                        <input type="file" name="photo" id="photo"/>
                    </div>
                    <div class="form-group">
                      <label class="req">Isi Testimonial</label>
                      <textarea name="testimonial" id="testimonial" class="form-control validate[required] text-input"><?php echo @$testimonial; ?></textarea>
                    </div>
                    <div class="form-group"  style="padding:0">
                        <button name="direction" type="submit" id="button_cmd" class="btn btn-primary" value="insert">
                        	Simpan Testimonial
                        </button>
                    </div>
                
                
                </div>
                <br clear="all">
            </form>
            <input id="proses_page" type="hidden"  value="<?php echo $ajax_dir; ?>/proses.php" />
            <input id="data_page" type="hidden"  value="<?php echo $ajax_dir; ?>/data.php" />

        </div>
    </div>
    
  <div class="x_panel">
        <div class="x_title">
            <h2>Daftar <span class="title-highlight">Testimonial</span></h2>
            <div class="clearfix"></div>
        </div>
        <a name="report"></a>
        <div class="x_content">
		<?php if($num_partner > 0){ ?>
        <table width="100%" class="table table-striped table-bordered responsive-utilities jambo_table">
            <thead>
                <tr>
                    <th width="20%">&nbsp;</th>
                    <th width="28%">Nama</th>
                    <th width="42%">Testimonial</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                  <?php while($dt_partner	= $db->fetchNextObject($q_partner)){
					  
						  @$name 		= $dt_partner->NAME;
						  @$photo 		= $dt_partner->PHOTO;  
                  ?>
                  <tr id="tr_<?php echo $dt_partner->ID_TESTIMONIAL; ?>">
                    <td>
					<?php 
						if(is_file($basepath."/files/images/testimonials/".$photo)){?>
                    		<img src="<?php echo $dirhost; ?>/files/images/testimonials/<?php echo $photo; ?>" class="photo" style="width:90%; margin-left:5px"/>
					<?php }else{ ?>
                    		<img src="<?php echo $dirhost; ?>/files/images/noimage-m.jpg" class="photo" style="width:90%; margin-left:5px"/>
					<?php } ?>
                    <br />
                    </td>
                    <td style="padding:20px;">
					<?php echo @$name; ?><br />
                    </td>
                    <td>
						<?php echo @$dt_partner->TESTIMONIAL; ?><br />
                    </td>
                    <td>
                        <div class="btn-group">
                                <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt_partner->ID_TESTIMONIAL; ?>" class="btn btn-mini" title="Edit">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href='javascript:void()' onclick="removal('<?php echo $dt_partner->ID_TESTIMONIAL; ?>')" class="btn btn-mini" title="Delete">
                                    <i class="icon-trash"></i>
                                </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>    
            </tbody>
        </table>
        <?php }else{
			echo "<br>";
            echo msg("Tidak Ada Testimonial Yang Terdaftar","error");
        } ?>
       </div>
        <footer>
            <form id="form_paging" class="formular" action="#report" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="direction" value="show" />
 			<?php echo pfoot($str_query,$link_str); ?>       
        	</form>
        </footer>
    </div>
</div>
<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Input File <span class="title-highlight">Banner</span></h2>
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
  <form id="formID" class="formular" action="" method="POST" enctype="multipart/form-data">
               <div class="form-group col-md-6">
                  <label class="req">Tipe Banner</label><br />
                  <select class="form-control" name="banner_type" id="banner_type">
                  		<option value="">--PILIH TIPE BANNER--</option>
						<?php while($dt_banner = $db->fetchNextObject($q_banner)){?>
                        <option value="<?php echo $dt_banner->ID_BANNER_TYPE; ?>" 
						<?php if(!empty($banner_type) && $banner_type == $dt_banner->ID_BANNER_TYPE){?>selected<?php } ?>>
                        	<?php echo $dt_banner->NAME; ?>
                        </option>
                        <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label class="req">Sumber Banner</label><br />
                  <select class="form-control" name="source" id="source">
                  		<option value="unggah" 
						<?php if(!empty($source) && $source == "unggah"){?>selected<?php } ?>>Unggah File</option>
                        <option value="youtube"
                         <?php if(!empty($source) && $source == "youtube"){?>selected<?php } ?>>Youtube</option>
                        <option value="link"
                         <?php if(!empty($source) && $source == "link"){?>selected<?php } ?>>URL Link</option>
                  </select>
               </div>
               <div class="form-group col-md-12">
               
               	  <div class="fupload" style="
                  <?php if(!empty($direction) && !empty($source) && $source != "upload"){ ?>display:none<?php } ?>">
                  <label class="req">File Banner</label>
                  <input type="file" name="image" id="image" class="form-control"  style="line-height:0">
                  </div>

               	  <div class="fyoutube" style="
                  <?php if(empty($direction) || (!empty($source) && $source != "youtube")){ ?>display:none<?php } ?>">
                  <label class="req">URL Frame Youtube</label>
                  <textarea name="youtube" id="youtube" class="form-control" value="<?php echo @$youtube; ?>" placeholder="<?php echo 'Contoh : <iframe width=\'560\' height=\'315\' src=\'https://www.youtube.com/embed/MB3mWTvUBSo\' frameborder=\'0\' allowfullscreen></iframe>'; ?>" style="height:150px"></textarea>
                  </div>
               	  <div 	class="flink" style="
                  <?php if(empty($direction) || (!empty($source) && $source != "link")){ ?>display:none<?php } ?>">
                  <label class="req">URL Link</label>
                  <input type="text" name="link" id="link" class="form-control" value="<?php echo @$link; ?>" placeholder="contoh : http://www.hargababel.com/sites/default/files/logo_bangkatengah.jpg">
                  </div>
                  
               </div>
               <div class="form-group col-md-6">
                  <label>Judul Banner</label>
                  <input type="text" class="form-control" name="btitle" id="btitle" value="<?php echo @$btitle; ?>">
               </div>
               <div class="form-group col-md-6">
                  <label>Deskripsi Banner</label>
                  <input type="text" class="form-control" name="bdesc" id="bdesc" value="<?php echo @$bdesc; ?>">
               </div>
    		   <div class="form-group col-md-12" >
                    <button name="direction" id="direction" type="submit" class="btn btn-primary" value="insert">Simpan Data</button>
               </div>
  </form>
    
        <input id="proses_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php" />
        <input id="data_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php" />
        <div style="clear:both">&nbsp;</div>
    </div>
</div>        
        
        
<div class="col-md-12" >
  <div class="x_panel">
        <fieldset>
        	<legend>Filter Pencarian</legend>
            <form method="post" action="" enctype="multipart/form-data">
              <div class="form-group col-md-4">
                  <label>Sumber Banner</label>
                  <select class="form-control" name="filter_source" id="filter_source">
                    <option value="unggah" 
                    <?php if(!empty($filter_source) && $filter_source == "unggah"){?>selected<?php } ?>>Unggah File</option>
                    <option value="youtube"
                     <?php if(!empty($filter_source) && $filter_source == "youtube"){?>selected<?php } ?>>Youtube</option>
                    <option value="link"
                     <?php if(!empty($filter_source) && $filter_source == "link"){?>selected<?php } ?>>URL Link</option>
                  </select>
                </div>
              <div class="form-group col-md-2">
                  <label class="req">Tipe Banner</label><br />
                <select class="form-control" name="fbanner_type" id="fbanner_type">
                    <option value="">--PILIH TIPE BANNER--</option>
                    <?php while($dt_fbanner = $db->fetchNextObject($q_fbanner)){?>
                    <option value="<?php echo $dt_fbanner->ID_BANNER_TYPE; ?>" 
                    <?php if(!empty($fbanner_type) && $fbanner_type == $dt_fbanner->ID_BANNER_TYPE){?>selected<?php } ?>>
                        <?php echo $dt_fbanner->NAME; ?>
                    </option>
                    <?php } ?>
                  </select>
              </div>
              <div class="form-group col-md-5">
               	  <button type="submit" class="btn btn-primary" name="search" value="true" style="margin-top:25px">
                  	<i class="fa fa-search"></i> Cari Data
                  </button>
                </div>
            </form>
        </fieldset>
    <div class="x_title">
            <h2>Daftar <span class="title-highlight">Banner</span></h2>
            <div class="clearfix"></div>
      </div>
      <a name="report"></a>
      <table width="100%" class="table table-data table-stripped table-bordered responsive-utilities jambo_table">
          <thead>
              <tr>
                <td width="26%" style="text-align:center;">File Banner</td>
                  <td width="12%" style="text-align:center;">Tipe Banner</td>
                <td width="14%" style="text-align:center;">Sumber File</td>
                <td width="38%" style="text-align:center;">Catatan</td>
                <td width="10%" style="text-align:center">Actions</td>
              </tr>
          </thead>
          <tbody>
                <?php while($dt_produk = $db->fetchNextObject($q_produk)){  ?>
                <tr id="tr_<?php echo $dt_produk->ID_BANNER; ?>">
                  <td style="vertical-align:top;">
                	<?php 
					@$bannertype = $db->fob("NAME",$tpref."banner_type_master"," WHERE ID_BANNER_TYPE = '".$dt_produk->ID_BANNER_TYPE."'");
					if($dt_produk->SOURCE == "unggah" || $dt_produk->SOURCE == "link"){
						$ext		= pathinfo($dt_produk->FILETARGET);
						$extension 	= $ext['extension'];
						if($extension == "mp4"  ||
						   $extension == "MP4"  || 
						   $extension == "mpeg" ||
						   $extension == "MPEG" || 
						   $extension == "3gp"	||
						   $extension == "3GP"){
							$wtype = "video";
						}
						
						if($extension == "jpg"  ||
						   $extension == "JPG"  || 
						   $extension == "gif" ||
						   $extension == "GIF" || 
						   $extension == "png"	||
						   $extension == "PNG"){
							$wtype = "photo";
						}
					}
					
					if($dt_produk->SOURCE == "unggah"){
						if(is_file($basepath."/files/images/slideshow/".$dt_produk->FILETARGET)){?>
					  <?php if($dt_produk->TYPE == "photo"){?>
                       	  <div style="max-height:300px; overflow:hidden">
							<img src="<?php echo $dirhost;?>/files/images/slideshow/<?php echo $dt_produk->FILETARGET; ?>" width="100%"/>
                          </div>
					  <?php }else{ ?>
						  <video width="100%" controls  >
						<source src="<?php echo $dirhost;?>/files/images/slideshow/<?php echo $dt_produk->FILETARGET; ?>" type="video/mp4">
						  </video>
					  <?php }
						}
					}
					
					if($dt_produk->SOURCE == "link"){?>
					  <?php if($dt_produk->TYPE == "photo"){?>
						  <div style="max-height:300px; overflow:hidden">
                            <img src="<?php echo $dirhost;?>/<?php echo $dt_produk->FILETARGET; ?>" width="100%" class="thumbnail"/>
                          </div>
					  <?php }else{ ?>
						  <video width="100%" controls  >
							  <source src="<?php echo $dt_produk->FILETARGET; ?>" type="video/<?php echo $extension; ?>">
						  </video>
					  <?php }
					}
					
					if($dt_produk->SOURCE == "youtube"){?>
					  <?php echo $dt_produk->FILETARGET; ?>
                    <?php } ?>
                  </td>
                  <td style="vertical-align:top; padding-top:15px; text-align:center"> 
					<?php echo @$bannertype; ?>
                  </td>
                  <td style="vertical-align:top; padding-top:15px; text-align:center">
					  <?php echo strtoupper(@$dt_produk->SOURCE); ?>
                  </td>
                  <td style="vertical-align:top; padding-top:15px;">
					  <?php echo @$dt_produk->TITLE; ?><br />
                      <?php echo @$dt_produk->DESCRIPTION; ?>
                  </td>
                  <td style="vertical-align:top; text-align:center; padding-top:15px;">
                      <a href='javascript:void()' onclick="removal('<?php echo $dt_produk->ID_BANNER; ?>')" title="Delete">
                          <button  class="btn" tyle="button"><i class="fa fa-trash"></i></button>
                      </a>
                  </td>
              </tr>
              <?php } ?> 
          </tbody>   
      </table>
   	</div> 
</div>
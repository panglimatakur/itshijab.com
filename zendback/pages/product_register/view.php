<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Tabs <small>Float right</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
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
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Input Produk</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Cari Produk</a>
                        </li>
                    </ul>
                    <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                            <?php include $call->inc($page_dir."/includes","form_proses.php"); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                            <?php include $call->inc($page_dir."/includes","form_report.php"); ?>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
</div>
<input id="proses_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php" />
<input id="data_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php" />
<input id="kategori_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/kategori.php" />

<br /><br />
<div class="col-md-12" >
    <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Tabs <small>Float right</small></h2>
                <div class="clearfix"></div>
            </div>
        <table width="100%" class="table table-striped table-bordered responsive-utilities jambo_table">
            <thead>
                <tr>
                    <th width="20" class="table_checkbox" style="width:13px">
                    	<input type="checkbox" id="select_rows" class="select_rows"/>
                    </th>
                    <th width="114">Gambar</th>
                  <th width="677">Specifikasi</th>
                    <th width="260" style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
                  <?php while($dt_produk = $db->fetchNextObject($q_produk)){ 
                    @$photo				= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_produk->ID_PRODUCT."'");
					@$unit				= $db->fob("NAME",$tpref."products_units"," WHERE ID_PRODUCT_UNIT='".$dt_produk->ID_PRODUCT_UNIT."'");
					//@$stock				= $db->fob("STOCK",$tpref."products_stocks"," WHERE ID_PRODUCT='".$dt_produk->ID_PRODUCT."'"); 
					if(empty($stock)){ $stock = 0; }
					$st_status			= $dt_produk->ID_STATUS;
                  ?>
                  <tr class="wrdLatest" data-info='<?php echo $dt_produk->ID_PRODUCT; ?>' id="tr_<?php echo $dt_produk->ID_PRODUCT; ?>">
                    <td><input type="checkbox" name="row_sel" class="row_sel" value="<?php echo $dt_produk->ID_PRODUCT; ?>"/></td>
                    <td style="width:60px">
                        <?php if(!empty($photo) && is_file($basepath."/files/images/products/thumbnails/".$photo)){ ?>
                        <a href="<?php echo $ajax_dir; ?>/produk.php?no=<?php echo $dt_produk->ID_PRODUCT; ?>" title="Image 01" class="fancybox fancybox.ajax">
                            <img src='<?php echo $dirhost; ?>/files/images/products/thumbnails/<?php echo $photo; ?>' class='photo' style="width:98%"/>
                        </a>
                        <?php }else{ ?>
                            <img src='<?php echo $dirhost; ?>/files/images/no_image.jpg' class='photo' style="width:98%"/>
                        <?php } ?>
                    </td>
                    <td style="vertical-align:top">
                    <div class="x_panel">
                    <table width="100%" border="0" class="tbl_item">
                      <tr>
                        <td width="13%"><b>Kode Item </b></td>
                        <td width="87%"><?php echo $dt_produk->CODE; ?></td>
                      </tr>
                      <tr>
                        <td><b>Nama</b></td>
                        <td><?php echo $dt_produk->NAME; ?></td>
                      </tr>
                      <tr>
                        <td><b>Harga</b></td>
                        <td><?php echo @money("Rp.",$dt_produk->SALE_PRICE); ?></td>
                      </tr>
                      <?php if(!empty($dt_produk->DESCRIPTION)){?>
                      <tr>
                        <td><b>Deskripsi </b></td>
                        <td><?php echo printtext($dt_produk->DESCRIPTION,50); ?></td>
                      </tr>
                      <?php } ?>
                      </table>
                      </div>
				   </td>
                    <td style="vertical-align:top; text-align:center">
                        <div class="btn-group">
                            <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt_produk->ID_PRODUCT; ?>" class="btn btn-default" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/produk.php?no=<?php echo $dt_produk->ID_PRODUCT; ?>" title="<?php echo $dt_produk->NAME; ?>" class="fancybox fancybox.ajax btn btn-default">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href='javascript:void()' onclick="removal('<?php echo $dt_produk->ID_PRODUCT; ?>')" class="btn btn-default" title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <br />
                        <br />
                        <select id="st_prod_<?php echo $dt_produk->ID_PRODUCT; ?>" onchange="set_status('<?php echo $dt_produk->ID_PRODUCT; ?>')" class="form-control">
                        	<option value="">-- STATUS TAMPIL --</option>
                        	<option value="1" <?php if(!empty($st_status) && $st_status == "1"){?> selected <?php } ?>>NON AKTIF</option>
                        	<option value="2" <?php if(!empty($st_status) && $st_status == "2"){?> selected <?php } ?>>AKTIF</option>
                        </select>
                    </td>
                </tr>
                <?php } ?>    
            </tbody>
        </table>
        <div id="lastPostsLoader"></div>
        <div class="w-box-footer" style="text-align:center">
            <?php if($num_produk > 10){?>
                <a href='javascript:void()' onclick="lastPostFunc()" class='next_button'><i class='icon-chevron-down'></i>SELANJUTNYA</a>
            <?php } ?>
            <br clear="all" />
        </div>       
    </div>
</div>	


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Input Data Kategori Produk</h4>
            </div>
            <div class="modal-body">
                <p>
                    <input type="hidden" id="new_id_type" value="<?php echo @$id_type; ?>" />
                    <div class="form-group">
                        <label class='req'>Nama Kategori</label>
                        <input id="nama_kat" type="text" value="" class="form-control" style="text-transform:capitalize"/>
                    </div>
                    <div id="div_form_link" style="display:none">
                        <div class="alert alert-info" style="margin:0">Apakah nama kategori diatas,  adalah jenis kategori anak (subkategori) atau jenis kategori induk (kategori) ?</div>
                        <div class="form-group">
                            <label class='req'>Jenis Kategori</label>
                            <select id="kategori_type"  class="form-control">
                                <option value="induk">Kategori Induk</option>
                                <option value="anak">Kategori Anak</option>
                            </select>
                        </div>
                        <span id="div_kategori_induk"></span>
                    </div>
                    <span id="div_new_kat"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="new_category" value="new_category">Save changes</button>
            </div>

        </div>
    </div>
</div>

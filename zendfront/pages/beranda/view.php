<?php defined('mainload') or die('Restricted Access'); ?>
<form action="" enctype="multipart/form-data" method="post" id="form_desain">
<input type='hidden' id='harga_design' value=''>
<input type='hidden' id='harga_design_service' value=''>
<input type='hidden' name="harga_cetak" id='harga_cetak' value=''>
<input type="hidden" id="id_login" value="<?php echo @$id_login; ?>" />
<div class="form-group col-md-12">
    <div class="left-sidebar col-md-4" >
        <h2>Alat Desain</h2>
        <div class="form-group col-md-6">
            <label>Jenis Hijab</label>
            <select name="tipe" id="tipe" class="form-control">
                <?php while($dt_pattern = $db->fetchNextObject($q_pattern)){?>
                <option value="<?php echo $dt_pattern->ID_CONFIG; ?>" 
                        data-price="<?php echo $dt_pattern->VALUE; ?>">
                    <?php echo $dt_pattern->NAME; ?>
                </option>
                <?php } ?>
            </select> 
        </div>

        <div class="form-group col-md-6">
            <label>Warna Kain</label>
            <input type="text" class="form-control" name="warna" id="demo_forceformat" >
        </div>

        <div class="form-group col-md-12">
            <label>Jenis Kain</label>
            <select name="jenis_kain" id="jenis_kain" class="form-control">
                <?php while($dt_textile = $db->fetchNextObject($q_textile)){?>
                <option value="<?php echo $dt_textile->ID_CONFIG; ?>" 
                        data-price="<?php echo $dt_textile->VALUE; ?>">
                    <?php echo $dt_textile->NAME; ?>
                </option>
                <?php } ?>
            </select> 
        </div>

        <div class="form-group col-md-12">
            <div class="alert alert-warning help_ukuran" style="margin-bottom:7px;padding:6px;">
                <small>Untuk gambar desain sendiri usahakan <br />
                Pashmina berukuran 770px X 360px, Segiempat berukuran 530px X 530px atau anda bisa mengunduh file pola disamping, untuk bisa disesuaikan sendiri, lalu unggah file berformat *.png,*.jpg,*.gif pada input box Unggah Desain dibawah ini.
                </small>
            </div>

            <label>Pratinjau</label>
            <input type="file" class="form-control" id="imgInp" name="imgInp" accept="image/*">
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="col-md-6" >
        <div class="custom_canvas" id="custom_canvas" style="padding:0;" >
            <div class="inner-bg"></div>
            <img src="<?php echo $dirhost; ?>/files/images/experiment/pashmina.png" id="layer_1" width="100%"/>
            <img src="" id="layer_3" style="display:none"/>
        </div>
        
        <div id="custom-desain" class="col-md-12" style="display:none">
            <div class="form-group col-md-3">
                <label>Lebar</label><br />
                <div class="btn-group">
                    <button class="btn btn-primary" type="button" id="l_tambah">
                        <span class="fa fa-plus" aria-hidden="true"></span> 
                    </button>
                    <button class="btn btn-primary" type="button" id="l_kurang">
                        <span class="fa fa-minus" aria-hidden="true"></span> 
                    </button>
                    <input type="hidden" class="form-control" value="93" id="lebar" name="lebar" >
                </div>
    
            </div>
    
            <div class="form-group col-md-3">
                <label>Tinggi</label><br />
                <div class="btn-group">
                    <button class="btn btn-primary" type="button" id="t_tambah">
                        <span class="fa fa-plus" aria-hidden="true"></span> 
                    </button>
                    <button class="btn btn-primary" type="button" id="t_kurang">
                        <span class="fa fa-minus" aria-hidden="true"></span> 
                    </button>
                    <input type="hidden" class="form-control" value="75" id="tinggi" name="tinggi" >
                </div>
            </div>
    
            <div class="form-group col-md-3">
                <label>Atas / Bawah</label><br />
                <div class="btn-group">
                    <button class="btn btn-primary" type="button" id="atas">
                        <span class="fa fa-chevron-up" aria-hidden="true"></span> 
                    </button>
                    <button class="btn btn-primary" type="button" id="bawah">
                        <span class="fa fa-chevron-down" aria-hidden="true"></span> 
                    </button>
                    <input type="hidden" class="form-control" value="13" id="atbaw" name="topbottom" >
                </div>
            </div>
    
            <div class="form-group col-md-3">
                <label>Kiri / Kanan</label><br />
                <div class="btn-group">
                    <button class="btn btn-primary" type="button" id="kiri">
                        <span class="fa fa-chevron-left" aria-hidden="true"></span> 
                    </button>
                    <button class="btn btn-primary" type="button" id="kanan">
                        <span class="fa fa-chevron-right" aria-hidden="true"></span> 
                    </button>
                    <input type="hidden" class="form-control" value="4" id="kika" name="rightleft" >
                </div>
            </div>
    
            <div class="clearfix"></div>
            <div class="form-group col-md-3" style="display:none" id="form_ownership">
                <label>
                    Beli ?
                    <a href='javascript:void()' 
                       data-container="body" 
                       data-toggle="popover" 
                       data-placement="top" 
                       data-content="Dengan memiliki desain ini, maka anda adalah pemilik terakhir atau mungkin pertama yang memiliki desain hijab dari <?php echo $website_name; ?> ini, dan akan di hapus sebagai produksi <?php echo $website_name; ?> seterusnya.">&nbsp;<i class='fa fa-question-circle'></i></a>
                       </label><br>    
                </label>
                <input id="ownership" name="ownership" type="checkbox" value="1" data-price="<?php echo @$harga_design; ?>">
            </div>
            
            <div class='form-group col-md-4' style='margin-bottom:0'>
                <label>Jumlah</label><br>
                <div class="input-group">
                    <div class="input-group-btn">
                    	<button class="btn btn-primary minus" type="button">
                        	<i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" name='jumlah_cetak' id='jumlah_cetak' value="1" readonly="readonly">
                	<div class="input-group-btn">
                    	<button class="btn btn-primary plus" type="button">
                        	<i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            


            <div class='form-group col-md-5' style='margin-bottom:0'>
                <label>Harga Cetak</label><br>
                <input type="text" class="form-control" readonly id='label_harga' value="<?php echo money("Rp.",$harga_pashmina).",00"; ?>">
            </div>
            <div class="clearfix"></div>
            <br />
            <div class='form-group col-md-12' id='designer_info'>
                <div class=' alert alert-info text-justify'>
                    <small>
                        <b>Unggah file desain mentah anda dengan format *.ai atau *.cdr, *.svg </b><br />
    
                        <input type="file" id="raw_design" name="raw_design" />
    
                    </small>
                </div> 
             </div>       
        </div>
        
        
    </div>

   

    <div class="left-sidebar col-md-2 right-desain" >

    		<div style="width:80%;margin-left:auto;margin-right:auto">

        	<?php 

			while($dt_default_design = $db->fetchNextObject($q_default_design)){ ?>

            <div class="thumbnail col-xs-2 col-md-5" style="margin-bottom: 2px;margin-right: 2px; ">

                <img src="<?php echo $dirhost; ?>/files/images/experiment/pattern/<?php echo $dt_default_design->FILE_DESIGN; ?>" data-id="<?php echo $dt_default_design->ID_CUSTOM_DESIGN_DEFAULT; ?>" class="default_design" title="<?php echo $dt_default_design->NAME; ?>"/>

            </div>

            <?php } ?>

            </div>

    </div>

    <div class="clearfix"></div>    

    


    <div class="form-group col-md-12">
        <br />
        <button type="button" class="btn btn-large btn-primary col-xs-4 col-md-4" id="addToRoom">
            <i class="fa fa-check-square-o"></i> Simpan
        </button>

        <button type="button" class="btn btn-large btn-primary col-xs-4 col-md-4" id="viewRoom">
            <i class="fa fa-eye"></i> Lihat
        </button>

        <button class="download_pola btn btn-large btn-primary col-xs-4 col-md-4" >
            <a href="<?php echo $dirhost; ?>/files/images/experiment/pashmina.png" title="Pola Hijab Pashmina" target="_blank">
                <i class="fa fa-download"></i> 
                Unduh Pola Gambar
            </a>
        </button>
        <input type="hidden" id="src" value=""> 
        <input type="hidden" id="file_id" value="<?php echo substr(md5(rand(0,1000000000)),0,9); ?>"> 
    </div>
    <div class="clearfix"></div>
</div>

</form>

    <div class="modal fade  modal-bg" id="desainRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none; margin-top:-50px;" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" ><i class='fa fa-cubes'></i> Ruang Desain
                    </h4>
                </div>
                <div class="modal-body" style="min-height:200px; max-height:600px; overflow:scroll"></div>
            </div>
        </div>
    </div>

	<script>
      $(function() {
        $('#ownership').bootstrapToggle({
			on:"Ya",
			off:"Tidak",
			width:"80"
		});
      })

    </script>
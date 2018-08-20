<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Input Data <span class="title-highlight">Polling</span></h2>
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
    <form method="post" action="" name="form">
     
      <div class="form-group">
            <label>Isi Polling</label>
            <textarea class="form-control" name="isi"><?php echo @$isi; ?></textarea>
        </div>
        <div class="form-group">
            <label>Pilihan Polling</label>
            <?php if(empty($direction)){?>
            <div class="input-group option" id="option_1">
            <input type="text" class="form-control" name="option[]" value="<?php echo @$option[0]; ?>"/>
            <span class="input-group-addon">
                <a href="javascript:void()" id="add_more" title="Tambah Pilihan">
                    <i class="fa fa-plus-square"></i>
                </a>
            </span>
            </div>
            <?php } ?>
            
            <?php if(!empty($direction) && count($options) > 0){
                $a = 0;
                foreach($options as &$option){ $a++; ?>
                <div class="input-group option" id="option_<?php echo $a; ?>" style="margin-top:5px">
                    <input type="text" class="form-control" name="option[]" value="<?php echo @$option; ?>"/>
                    <span class="input-group-addon">
                        <?php if($a == 1){?>
                        <a href="javascript:void()" id="add_more" title="Tambah Pilihan">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <?php }else{ ?>
                        
                            <?php if(!empty($direction) && $direction == "edit"){?>
                            <a href="javascript:void()" id="del_db" title="Hapus Pilihan" data-info='"id_option":"<?php echo $id_option[$a]; ?>","id_element":"<?php echo $a; ?>"'>
                                <i class="fa fa-minus-square"></i>
                            </a>
                            <?php }else{ ?>
                            <a href="javascript:void()" id="del_more" title="Hapus Pilihan" data-info="<?php echo $a; ?>">
                                <i class="fa fa-minus-square"></i>
                            </a>
                            <?php } ?>
                            
                            
                        <?php } ?>
                    </span>
                </div>
                <?php }
            } ?>
        </div>
        <div class="form-group">
            <?php if(!empty($direction) && $direction == "edit"){ $next_dir = "save"; }else{ $next_dir = "insert"; } ?>
            <button type="submit" name="direction" value="<?php echo $next_dir; ?>" class="btn btn-primary">Simpan Polling</button>
            <input type="hidden" id="proses_page" value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php"/>
        </div>
    </form>
    </div>
</div>


<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar <span class="title-highlight">Polling</span></h2>
            <div class="clearfix"></div>
        </div>
		<?php if($num_polling > 0){?>
        <table width="100%" class="table table-bordered table-striped responsive-utilities jambo_table bulk_action" >
            <thead>
                <tr>
                    <td width="82" style="text-align:center">No</td>
                    <td width="781">Polling</td>
                    <td width="229" style="text-align:center">Action</td>
                </tr>
            </thead>
            <tbody>
            <?php $r = 0; while($dt_polling = $db->fetchNextObject($q_polling)){ $r++; ?>
                <tr id="tr_<?php echo $dt_polling->ID_POLLING; ?>">
                    <td style="text-align:center"><?php echo $r; ?></td>
                    <td >
                        <?php echo $dt_polling->CONTENT; ?><br />
                        <strong>Pilihan Polling</strong>
                        <ol>
                        <?php
                            $q_option = $db->query("SELECT * FROM ".$tpref."polling_options WHERE ID_POLLING = '".$dt_polling->ID_POLLING."' ORDER BY ID_POLLING_OPTION ASC");
                            $b = 0;
                            while($dt_option = $db->fetchNextObject($q_option)){
                                $b++;
                            ?>
                                <li style="list-style:decimal"><?php echo $dt_option->CAPTION; ?></li>
                            <?php }
                        ?>
                        </ol>
                    </td>
                    <td style="text-align:center">
                        <a href="<?php echo $lparam; ?>&direction=edit&id_polling=<?php echo $dt_polling->ID_POLLING; ?>" title="Edit">
                            <button class="btn" type="button"><i class="fa fa-pencil"></i></button>
                        </a>
                        <?php
                        $jml_vote = $db->recount("SELECT ID_POLLING_RESULT FROM ".$tpref."polling_results WHERE ID_POLLING = '".$dt_polling->ID_POLLING."'");
                        if($jml_vote > 0){
                        ?>
                        <a href='#' title="Preview" 
                           onclick='window.open("<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/preview.php?direction=preview&id_polling=<?php echo $dt_polling->ID_POLLING; ?>","_blank", "location=no,toolbar=no,status=no,scrollbars=yes,resizable=yes,top=100,left=300,width=700,height=500");'>
                            <button class="btn" type="button"><i class="fa fa-eye"></i></button>
                        </a><!--class="fancybox fancybox.ajax" -->
                        <?php } ?>
                        <a href='javascript:void()' onclick="removal('<?php echo $dt_polling->ID_POLLING; ?>')" title="Delete">
                            <button class="btn" type="button"><i class="fa fa-trash"></i></button>
                        </a>
                    </td>
              </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php }else{ ?>
            <div class="alert alert-danger">Tidak ada data polling yang terdaftar</div>
        <?php } ?>
    </div>
</div>
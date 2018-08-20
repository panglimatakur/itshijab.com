<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Master <span class="title-highlight">Jabatan / Level</span></h2>
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
                        echo msg("Nama Komunitas Ini Sudah Terdaftar","error");	
                    break;
                }
            }
        ?>
        <form method="post" action="" >
            <div class="form-group">
               <label class="req">Nama Jabatan / Level</label>
              <input name="nama" type="text" id="nama" value="<?php echo @$nama; ?>" class="form-control" />
            </div>
            <div class="form-group">
                <?php
                if(empty($direction) || 
                (!empty($direction) && ($direction != "edit" || $direction != "show"))){
                    $prosesvalue = "insert";	
                }
                if(!empty($direction) && ($direction != "get_form" && ($direction != "insert" || $direction != "delete" || $direction != "show"))){
                    $prosesvalue = "save";
                    $addbutton = "
                        <a href='".$lparam."'>
                            <input name='button' type='button' class='btn btn-danger' value='Tambah Data'>
                        </a>";
            ?>
                <input type='hidden' name='no' id='no' value='<?php echo $no; ?>' />
                <input type='hidden' name='ori_name' id='ori_name' value='<?php echo @$nama; ?>' />
                <?php
                }
            ?>
                <button name="Submit" type="submit" id="button_cmd" class="btn btn-primary">Simpan Data</button>
                <?php echo @$addbutton; ?>
                <input type='hidden' name='direction' id='direction' value='<?php echo $prosesvalue; ?>' />
            </div>
        </form>
        <input id="proses_page" type="hidden"  value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php" />
	</div>
</div>   
     
<div class="col-md-12" >
    <div class="x_panel">
        <a name="report"></a>
        <div class="x_content">
            <div class="x_title">
                <h2>Daftar <span class="title-highlight">Jabatan / Level</span></h2>
                <div class="clearfix"></div>
            </div>
        
        <?php if($num_level > 0){ ?>
            <table width="100%" class="table table-data table-stripped table-bordered responsive-utilities jambo_table">
                <thead>
                    <tr>
                        <th width="20" class="table_checkbox" style="width:13px">
                            <input type="checkbox" id="select_rows" class="select_rows"/>
                        </th>
                        <th width="910">Nama</th>
                        <th width="143" style="text-align:center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Action</button>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="javascript:void()" id="select_rows_2">
                                        <i class="fa fa-check" style="margin:0 4px 0 0"></i>
                                            Pilih Semua
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void()" id="delete_picked">
                                        <i class="fa fa-trash" style="margin:-2px 4px 0 0"></i>
                                            Hapus Yang Di Pilih
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                      <?php while($dt_level	= $db->fetchNextObject($q_level)){ 
                      ?>
                      <tr id="tr_<?php echo $dt_level->ID_CLIENT_USER_LEVEL; ?>">
                        <td><input type="checkbox" name="row_sel" class="row_sel" value='<?php echo $dt_level->ID_CLIENT_USER_LEVEL; ?>'/></td>
                        <td><?php echo @$dt_level->NAME; ?></td>
                        <td style="text-align:center">
                            <div class="btn-group">
                                    <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt_level->ID_CLIENT_USER_LEVEL; ?>" class="btn btn-default" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href='javascript:void()' onclick="removal('<?php echo $dt_level->ID_CLIENT_USER_LEVEL; ?>')" class="btn btn-default" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>    
                </tbody>
            </table>
        <?php }else{
            echo "<br>";
            echo msg("Tidak Ada Jabatan Yang Terdaftar","error");
        } ?>
        </div>
    </div>
</div>
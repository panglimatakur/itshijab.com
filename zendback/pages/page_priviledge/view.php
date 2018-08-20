<?php defined('mainload') or die('Restricted Access'); ?>
<form id="formID"  class="t-box shadow formular" method="post" action="" enctype="multipart/form-data">
<div class="col-md-12" >
	<?php 
        if(!empty($msg)){
            switch ($msg){
                case "1":
                    echo "<br>".msg("Proses Simpan Hak Akses Berhasil","success")."<br>";
                break;
                case "2":
                    echo "<br>".msg("Tentukan Tingkat Kantor dan Jabatan User","error")."<br>";
                break;
            }
        }
    ?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Form <span class="title-highlight">Hak Akses</span></h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
                    
            <input type="hidden" id='treeview_check_page' value='libraries/treeform' />
            <input type="hidden" id='proses_page' value='<?php echo $dirhost."/".$ajax_dir."/proses.php"; ?>' />
            <input type="hidden" id='modules_page' value='<?php echo $dirhost."/".$ajax_dir."/modules.php"; ?>' />
            <div class="form-group">
                <label class="req">Tingkat Jabatan</label>
                <select name="id_client_user_level" id="id_client_user_level" class="form-control" >
                    <option value="">--LEVEL USER CLIENT--</option>
                    <?php while($dt_client_user_level = $db->fetchNextObject($q_client_user_level)){?>
                        <option value='<?php echo $dt_client_user_level->ID_CLIENT_USER_LEVEL; ?>' <?php if(!empty($id_client_user_level) && $id_client_user_level == $dt_client_user_level->ID_CLIENT_USER_LEVEL){?> selected<?php } ?>>
                            <?php echo $dt_client_user_level->NAME; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
        </div>
        
        <div id="div_modules" class="col-md-8" >
                <?php 
                if(!empty($direction) && $direction == "insert"){
                   include $call->inc($ajax_dir,"modules.php");
                } 
                ?>
        </div>
    </div>
    
</div>


</form>

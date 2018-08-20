<?php defined('mainload') or die('Restricted Access'); ?>
<form class="formular" id="formID" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-6" >
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Kategori <span class="title-highlight">Produk</span></h2>
                <div class="clearfix"></div>
            </div>
               
            <div class="cnt_a" style="height:auto; max-height:500px; overflow:scroll">
                <?php include $call->inc($page_dir."/includes","list.php");  ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Input Kategori <span class="title-highlight">Produk</span></h2>
                <div class="clearfix"></div>
            </div>
			<?php 
                if(!empty($msg)){
                    switch ($msg){
                        case "1":
                            echo msg("Data Kategori Berhasil Disimpan","success");
                        break;
                        case "2":
                            echo msg("Data Kategori Berhasil Disimpan dan Di Perbaiki","success");
                        break;
                    }
                }
            ?>
            <div class="cnt_a"><?php include $call->inc($page_dir."/includes","form.php"); ?></div>
        </div>
    </div>
</form>
<?php defined('mainload') or die('Restricted Access'); ?>
        <h2 class="title text-center">Program <span class="title-highlight">Afiliasi</span></h2>

        <div class="category-tab shop-details-tab" style="margin-bottom:0"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
                    <li class=""><a href="#how" data-toggle="tab">Cara Kerja</a></li>
                    <li class=""><a href="#komisi" data-toggle="tab">Komisi dan Model Afiliasi</a></li>
                    <li class=""><a href="#syarat" data-toggle="tab">Syarat Dan Ketentuan</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="overview">
                    <?php include $call->inc($inc_dir,"overview.php"); ?>
                </div>
                
                <div class="tab-pane fade" id="how">
                    <?php include $call->inc($inc_dir,"how.php"); ?>
                </div>
                
                <div class="tab-pane fade" id="komisi">
                    <?php include $call->inc($inc_dir,"komisi.php"); ?>
                </div>
                <div class="tab-pane fade" id="syarat">
                	<?php include $call->inc($inc_dir,"syarat.php"); ?>
                </div>
                
            </div>
            
        </div>
        <div class="col-sm-12" style="margin:5px 0 10px 0">
        	<a href="<?php echo $dirhost; ?>/registration">
            	<button type="button" class="btn btn-primary"><i class="fa fa-user"></i> Ke Form Pendaftaran</button>
            </a>
        </div>

<?php defined('mainload') or die('Restricted Access'); ?>

<div class="x_panel">
    <div class="x_title">
        <h2><i class="fa fa-bars"></i> Tabs <small>Float left</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
        <div class="form-group col-md-6">
          <label>Affiliate ID</label>
          <pre>
            <?php echo $aff_id; ?>
          </pre>
        </div>
        <div class="form-group col-md-6">
          <label>Affiliate URL</label>
          <pre>
            <?php echo @$dirhost; ?>/<?php echo $aff_id; ?>
          </pre>
        </div>
        <div class="form-group col-md-6">
          <label>API Key</label>
          <pre>
            <?php echo @$api_key; ?>
          </pre>
        </div>
    <div class="x_content">
    
    
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class=""><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Produk Affiliasi</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Banner Affiliasi</a>
                </li>
                <li role="presentation" class="active"><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Statistic Aktifitas</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="true">Transaction</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="true">Video Tutorial</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade" id="tab_content1" aria-labelledby="home-tab">
                    <p><?php include $call->inc($inc_dir,"produk_affiliasi.php"); ?></p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <p><?php include $call->inc($inc_dir,"banner_affiliasi.php"); ?></p>
                </div>
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="profile-tab">
                    <p><?php include $call->inc($inc_dir,"activity_statistic.php"); ?></p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                    <p>Transaction History</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                    <p>Video Tutorial</p>
                </div>
            </div>
        </div>
    </div>
</div>


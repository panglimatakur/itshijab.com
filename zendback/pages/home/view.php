<?php defined('mainload') or die('Restricted Access'); ?>
<!-- top tiles -->
<!--<div class="row tile_count">
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
            <div class="count">2500</div>
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
            <div class="count">123.50</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
            <div class="count green">2,500</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
            <div class="count">4,567</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">7,325</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>

</div>-->
<!-- /top tiles -->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Statistik Kunjungan</h3>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                    <label>Periode</label>
                    <select id="periode" class="form-control">
                        <option value="">-- PERIODE --</option>
                        <option value="harian">HARIAN</option>
                        <option value="bulanan">BULANAN</option>
                        <option value="tahunan">TAHUNAN</option>
                    </select>
                </div>
                <div id="periode_el">
                    <div class="periode_el form-group col-md-2 col-sm-12 col-xs-12" id="div_bulan" style="display:none">
                        <label>Bulan</label>
                        <select id="bulan" class="form-control">
                            <option value="">-- BULAN --</option>
                            <?php $q2 = 0; while($q2 < 12){ $q2++; if(strlen($q2) == 1){ $q2 = "0".$q2; } ?>
                            <option value="<?php echo $q2; ?>"><?php echo $dtime->nama_bulan($q2); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="periode_el form-group col-md-2 col-sm-12 col-xs-12" id="div_tahun" style="display:none">
                        <label>Tahun <span id="cap_thn_awal"></span></label>
                        <select id="tahun" class="form-control">
                            <option value="">-- TAHUN --</option>
                            <?php $q2 = date('Y')-10; while($q2 < date('Y')){ $q2++; ?>
                            <option value="<?php echo $q2; ?>"><?php echo $q2; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="periode_el form-group col-md-2 col-sm-12 col-xs-12" id="div_tahun2" style="display:none">
                        <label>Tahun Akhir</label>
                        <select id="tahun2" class="form-control">
                            <option value="">-- TAHUN --</option>
                            <?php $q2 = date('Y')-10; while($q2 < date('Y')){ $q2++; ?>
                            <option value="<?php echo $q2; ?>"><?php echo $q2; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                    <button type="submit" id="fetch_data" class="btn btn-danger" style="margin-top:25px;">
                        <i class="fa fa-search"></i> Lihat Data
                    </button>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                    <canvas id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></canvas>
                
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</div>
<br />

<div class="row">


	
    <?php
		if(!empty($condition)){
			switch ($condition){
				case "os":
					$q_condition = " AND ACTIVITY LIKE '%".$value."%'";	
				break;
				case "ip":
					$q_condition = " AND IP_ADDRESS = '".$value."'"; 
				break;
			}
		}
		$str_log = "SELECT * FROM ".$tpref."visitor_logs WHERE ID_VISITOR_LOG IS NOT NULL ".@$q_condition." ORDER BY ID_VISITOR_LOG DESC LIMIT 0,100";
		$q_logs = $db->query($str_log);
		//echo $str_log;
	?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Aktifitas <small>Kunjungan</small> <?php if(!empty($condition)){ ?> <small><a href="<?php echo $dirhost; ?>/?module=cpanel&page=home">&laquo; Kembali </a></small> <?php } ?></h2>
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
            <div class="x_content" style="max-height:415px; overflow:scroll">
                <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                        <?php while($dt_visitor_log = $db->fetchNextObject($q_logs)){?>
                        <li>
                        
                            <div class="block">
                                <div class="block_content">
                                    <h2 class="title">
                                        <a href="<?php echo $dirhost; ?>/?module=cpanel&page=home&condition=ip&value=<?php echo $dt_visitor_log->IP_ADDRESS; ?>"><?php echo $dt_visitor_log->IP_ADDRESS; ?></a>
                                    </h2>
                                    <div class="byline">
                                        <span>
											<?php echo $dtime->now2indodate2($dt_visitor_log->UPDATEDATE); ?> 
											<?php echo $dt_visitor_log->UPDATETIME; ?>
                                         </span>
                                    </div>
                                    <p class="excerpt"><?php echo $dt_visitor_log->ACTIVITY; ?></a>
                                    </p>
                                </div>
                            </div>
                            
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <!-- Start to do list -->
    <!--<div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>To Do List <small>Sample tasks</small></h2>
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
            <div class="x_content">

                <div class="">
                    <ul class="to_do">
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Create email address for new intern</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Create email address for new intern</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                        </li>
                        <li>
                            <p>
                                <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>-->
    <!-- End to do list -->

        
        
</div>
        <input type='hidden' id='data_page' value='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php'>

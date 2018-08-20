<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

    <!-- Bootstrap core CSS -->
	
    <link href="<?php echo $web_btpl_dir; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo $web_btpl_dir; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $web_btpl_dir; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo $web_btpl_dir; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo $web_btpl_dir; ?>css/icheck/flat/green.css" rel="stylesheet" />

    <script src="<?php echo $web_btpl_dir; ?>js/jquery.min.js"></script>
	<?php //include $call->lib("fancybox"); 					?>
    <?php include $call->clas('class.html2text'); ?>
    <?php if(is_file($basepath."/".$page_dir."/css/style.css")){ ?>
        <link rel="stylesheet" href="<?php echo $dirhost;?>/<?php echo $page_dir; ?>/css/style.css" type="text/css">
    <?php } ?>
    <?php if(is_file($basepath."/".$page_dir."/js/js.js")){ ?>
        <script language="javascript" src="<?php echo $dirhost; ?>/<?php echo $page_dir; ?>/js/js.js"></script>
    <?php } ?>
    <script src="<?php echo $dirhost; ?>/includes/general.js"></script>
    <style type="text/css">
		.uppercase{ text-transform:uppercase; }
		.lowercase{ text-transform:lowercase; }
		.req:after { content: " *"; color: #ff0000; }
	</style>
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo $dirhost; ?>/?module=cpanel&page=home" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $website_name; ?></span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                       <?php $photo_admin = $db->fob("USER_PHOTO","system_users_client"," WHERE ID_USER = '".$_SESSION['uidkey']."'"); ?> 
						<?php if(!empty($photo_admin) && is_file($basepath."/files/images/users/".$photo_admin)){?>
                            <img src="<?php echo $dirhost; ?>/files/images/users/<?php echo $photo_admin; ?>" class=" img-circle" style="width:100%">
                        <?php }else{ 
                            if(!empty($gender_admin) && $gender_admin == "L"){
                        ?>
                            <img src="<?php echo $dirhost; ?>/files/images/user.png" class="img-circle" style="width:100%">
                            <?php }else{?>
                            <img src="<?php echo $dirhost; ?>/files/images/users/user-f" class="img-circle" style="width:100%">
                            <?php } ?>
                        <?php } ?>
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['username']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
					<?php
                    function child_menu($parent){
                        global $db;
                        global $dirhost;
                        global $permalink;
                        $q_menu 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PARENT='".$parent."' ORDER BY SERI ASC");
                        $num_menu 	= $db->numRows($q_menu);
                        if($num_menu >0){
                    ?>
                        <ul class="nav child_menu" style="display: none">
                    <?php
                            $t = 0;
                            while($dt_menu = $db->fetchNextObject($q_menu)){
                                $t++;
								if(rightaccess($dt_menu->PAGE) > 0){
                                    $url_link = "";
                                    if($dt_menu->IS_FOLDER == 1){ 
                                        $url_link = "href='javascript:void()'";
                                    }else{ 
                                        if(@$permalink == 1){
                                            $url_link = str_replace(" ","","href='".$dirhost."/cpanel/".$dt_menu->PAGE."'");	 
                                        }else{
                                            $url_link = str_replace(" ","","href='".$dirhost."/?module=cpanel&page=".$dt_menu->PAGE."'");	 
                                        }
                                    }
                            ?>
                                <li><a <?php echo $url_link; ?> >
                                       <?php echo $dt_menu->NAME; ?>
                                     </a>
                                </li>
                            <?php
								}
                            }
                    ?>
                        </ul>
                    <?php
                        }
                    }
                    ?>
                        <div class="menu_section">
                            <ul class="nav side-menu">
							<?php
                            $q_menu 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PAGE_CLIENT IS NOT NULL AND ID_PARENT='0' AND ID_MODULE = '2' ORDER BY SERI ASC");
                            while($dt_menu = $db->fetchNextObject($q_menu)){
                                
								if(rightaccess($dt_menu->PAGE) > 0){
									$url_link = "";
									if($dt_menu->IS_FOLDER == 1){ 
										$url_link = "href = 'javascript:void()'";
									}else{ 
										if(@$permalink == 1){
										   $url_link = str_replace(" ","","href='".$dirhost."/cpanel/".$dt_menu->PAGE."'");	 
										}else{
										   $url_link = str_replace(" ","","href='".$dirhost."/?module=cpanel&page=".$dt_menu->PAGE."'");	
										}
									}
									$num_child_menu = 
									$db->recount("SELECT ID_PAGE_CLIENT FROM system_pages_client WHERE ID_PARENT = '".$dt_menu->ID_PAGE_CLIENT."'"); ?>
                                    <li>
                                        <a <?php echo $url_link; ?>>
                                            <?php echo $dt_menu->ICON; ?> <?php echo $dt_menu->NAME; ?>
                                            <?php if($num_child_menu > 0){?><span class="fa fa-chevron-down"></span><?php } ?>
                                        </a>
                                        <?php if($num_child_menu > 0){ echo child_menu($dt_menu->ID_PAGE_CLIENT); } ?> 
                                        
                                    </li>
							<?php }
							} 
							?>	
                                <li><a href="<?php echo $dirhost; ?>/?logout=true"><i class="fa fa-power-off"></i> Log Out</a>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a href="<?php echo $dirhost; ?>/?module=cpanel&page=user_profile" data-toggle="tooltip" data-placement="top" title="Profil Pengguna">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="<?php echo $dirhost; ?>/?logout=true" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<?php if(!empty($photo_admin) && is_file($basepath."/files/images/users/".$photo_admin)){?>
                                    <img src="<?php echo $dirhost; ?>/files/images/users/<?php echo $photo_admin; ?>" >
                                <?php }else{ 
                                    if(!empty($gender_admin) && $gender_admin == "L"){
                                ?>
                                    <img src="<?php echo $dirhost; ?>/files/images/user.png" >
                                    <?php }else{?>
                                    <img src="<?php echo $dirhost; ?>/files/images/users/user-f" >
                                    <?php } ?>
                                <?php } ?>
                                    
                                    <?php echo $_SESSION['username']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo $dirhost; ?>/?module=cpanel&page=user_profile">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="<?php echo $dirhost; ?>/?logout=true"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo $web_btpl_dir; ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo $web_btpl_dir; ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo $web_btpl_dir; ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo $web_btpl_dir; ?>images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
				<div class="row">
                	
					<?php 
					if(is_file($basepath."/".$page_dir."/page.php")){
						include $call->inc($page_dir,"page.php");
					}
					?>
                	<input type="hidden" id='config' value='"dirhost":"<?php echo $dirhost; ?>","page":"<?php echo @$page; ?>"' />
                	
                </div>
                <!-- footer content -->
                <footer style="position:fixed; width:83%; bottom:0">
                    <div class="">
                        <p class="pull-right">
                            <span class="lead"> <i class="fa fa-bug"></i> <?php echo $website_name; ?></span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo $web_btpl_dir; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $web_btpl_dir; ?>js/custom.js"></script>
    
    <!-- chart js -->
    <script src="<?php echo $web_btpl_dir; ?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo $web_btpl_dir; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo $web_btpl_dir; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo $web_btpl_dir; ?>js/icheck/icheck.min.js"></script>
	<?php if(is_file($basepath."/".$page_dir."/lib.php")){ ?>
        <?php include $call->inc($page_dir,"lib.php"); ?>
    <?php } ?>

    <!-- /footer content -->
</body>

</html>

<?php defined('mainload') or die('Restricted Access'); ?>
<?php
if(isset($_REQUEST['direction'])) 	{	$direction 	= $sanitize->str($_REQUEST['direction']); 	}
if(isset($_REQUEST['parameters'])) 	{	
	$parameters = $sanitize->str($_REQUEST['parameters']); 	
	$parameter 	= explode("/",$parameters);
}
if(isset($_REQUEST['module'])) 		{	$module 	= $sanitize->str($_REQUEST['module']); 		}
if(isset($_REQUEST['page'])) 		{	$page 		= $sanitize->str($_REQUEST['page']); 		}
if(isset($_REQUEST['no'])) 			{	$no 		= $sanitize->str($_REQUEST['no']); 			}
if(isset($_REQUEST['msg'])) 		{	$msg 		= $sanitize->str($_REQUEST['msg']); 		}

//TEMPLATES RESOURCE
$img_dir_tpl	= "templates/images";
$tpl_css		= "templates/css";
$tpl_js			= "templates/js";
$web_ftpl_dir	= $dirhost."/zendfront/templates/".$web_template."/";
$web_btpl_dir	= $dirhost."/zendback/templates/admin/";
//FILE DIRECTORY
$img_dir		= "files/images";
$user_file		= "files";
$plugins_dir	= $dirhost."/libraries";
if(empty($page) || $page == "beranda"){
	$module = "website";
	$page 	= "beranda";
}
if($page == "statis"){ $page_target = $_REQUEST['parameters']; }else{ $page_target = $page; }
$q_pages		= $db->query("SELECT TYPE,ID_MODULE,ID_PAGE_CLIENT,TITLE FROM system_pages_client WHERE PAGE='".$page_target."'");
$dt_pages		= $db->fetchNextObject($q_pages);
@$page_module 	= $dt_pages->ID_MODULE;
@$id_page 		= $dt_pages->ID_PAGE_CLIENT;
@$page_title 	= $dt_pages->TITLE;
if(!empty($module) && $module == "cpanel"){ $pos = "zendback"; }else{ $pos = "zendfront"; } 
@$page_dir 		= $pos."/pages/".$page;
//ON SYSTEM

//MODULES
@$ajax_dir		= $page_dir."/ajax";
@$js_dir		= $page_dir."/js/js.js";
@$css_dir		= $page_dir."/css/style.css";
@$inc_dir		= $page_dir."/includes";
$module_parameter = "";
if(!empty($page_module) && $page_module == "2"){
	$module_parameter = "module=cpanel&";
}
$lparam			= $dirhost."?".$module_parameter."page=".$page;

$alamat_admin_main 		= ""; 
$telephone_admin_main	= "";
$email_admin_main		= "";
$fax_admin_main			= "";

function is_mod_rewrite_enabled() {
	if(function_exists('apache_get_modules')){
		if(in_array('mod_rewrite',apache_get_modules())){
			return TRUE;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}
?>

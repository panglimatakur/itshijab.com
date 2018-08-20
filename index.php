<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
//session_destroy();
ob_start();
if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
include_once('includes/config.php');
include_once('includes/classes.php');
include $call->inc("includes/classes","class.templates.php");
include_once('includes/functions.php');
include_once('includes/declarations.php');
$user_agent     	= $_SERVER['HTTP_USER_AGENT'];
$user_os     		= getOS($user_agent);

if((!empty($_REQUEST['logout']) && $_REQUEST['logout']=="true")){
	session_destroy();
	redirect_page($dirhost);
}
if(!empty($module) && $module == "cpanel"){
	include $call->inc("zendback","index.php");
}else{
	include $call->inc("zendfront","index.php");
}
$db->close();
?>

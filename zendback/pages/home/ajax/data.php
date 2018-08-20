<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	define('mainload','ADORSCREENPRINT',true);
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	
	$direction 	= isset($_REQUEST['direction']) 	? $sanitize->str($_REQUEST['direction']) 	: "";
	$periode 	= isset($_REQUEST['periode']) 		? $sanitize->str($_REQUEST['periode']) 		: "";
	$bln 		= isset($_REQUEST['bln']) 			? $sanitize->str($_REQUEST['bln']) 			: "";
	$thn 		= isset($_REQUEST['thn']) 			? $sanitize->str($_REQUEST['thn']) 			: "";
	$thn2 		= isset($_REQUEST['thn2']) 			? $sanitize->str($_REQUEST['thn2']) 		: "";
	
	if(!empty($direction) && $direction == "fetch_data"){ 
		if(empty($periode)){ 
			$periode 	= "bulanan";
			$thn 		= 2017; 
		}
		$condition	= "";
		switch($periode){
			case "harian":
				$first  = 0;
				$end 	= 31;
			break;
			case "bulanan":
				$first  = 0;
				$end 	= 12;
			break;
			case "tahunan":
				$first  = $thn-1;
				$end 	= $thn2;
			break;
		}
		$q = $first;
		while($q < $end){ $q++;
			if(strlen($q) == 1){ $q = "0".$q; }
			switch($periode){
				case "harian":
					$condition = " AND DAY(UPDATEDATE) = '".$q."' AND MONTH(UPDATEDATE) = '".$bln."' AND YEAR(UPDATEDATE) = '".$thn."' ";
				break;
				case "bulanan":
					$condition = " AND MONTH(UPDATEDATE) = '".$q."' AND YEAR(UPDATEDATE) = '".$thn."'";
				break;
				case "tahunan":
					$condition = " AND YEAR(UPDATEDATE) = '".$q."'";
				break;
			}
		
			$q_log = $db->query("SELECT COUNT(ID_VISITOR_LOG) AS JUMLAH FROM cat_visitor_logs WHERE ID_VISITOR_LOG IS NOT NULL ".$condition." ORDER BY ID_VISITOR_LOG DESC");
			$dt_log = $db->fetchNextObject($q_log);
			if(empty($dt_log->JUMLAH)){ $jumlah = 0; }else{ $jumlah = $dt_log->JUMLAH; }
			@$result[] = $jumlah;
		}
		echo json_encode($result);
	}
}
else{  defined('mainload') or die('Restricted Access'); }
?>

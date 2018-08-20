<?php
//if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	define('mainload','ITSHIJAB',true);
	include_once("../../../includes/config.php");
	include_once("../../../includes/classes.php");
	$direction 	= isset($_REQUEST['direction']) 	? $sanitize->str($_REQUEST['direction']) 					: "";
	$id_polling 	= isset($_REQUEST['id_polling']) 		? $sanitize->number($_REQUEST['id_polling']) 		: "";
	
	$q_polling 		= $db->query("SELECT * FROM ".$tpref."polling WHERE ID_POLLING='".$id_polling."'");
	$dt_polling 	= $db->fetchNextObject($q_polling);
	
	$q_option 		= $db->query("SELECT * FROM ".$tpref."polling_options WHERE ID_POLLING='".$id_polling."'");
?>
   <div id="chartContainer" style="height: 400px; width: 100%;"></div>
   
   <script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "<?php echo $dt_polling->CONTENT; ?>",
					fontColor: "#666666",
				},
				axisY: {
					labelFontSize: 16,
					labelFontColor: "dimGrey",
					interlacedColor: "#ECF5FF",
					gridColor: "#D9ECFF",
				},
				axisX: {
					labelAngle: -30,
					labelFontSize: 10,
				},
			 	axisY2:{ 
					labelFontSize: 20,
			 	},
				data: [{
					type: "column",
					dataPoints: [
						<?php 
							while($dt_option 	= $db->fetchNextObject($q_option)){
								$jml_vote = $db->recount("SELECT ID_POLLING_RESULT FROM ".$tpref."polling_results WHERE ID_OPTION = '".$dt_option->ID_POLLING_OPTION."'");
						?>
								{ y: <?php echo $jml_vote; ?>, label: "<?php echo $dt_option->CAPTION; ?>" },
						<?php } ?>
					]
				}]
			});
			chart.render();
		}
	</script>

<?php
	include $call->lib("chart");
//}
//else{  defined('mainload') or die('Restricted Access'); }
?>

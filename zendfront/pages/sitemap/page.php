<?php defined('mainload') or die('Restricted Access'); 	?>
<?php include $call->clas("class.html2text"); 			?>
<?php include $call->func("function.paging"); 			?>

<?php include $call->inc($page_dir,"controller.php"); 		?>
<?php include $call->inc($page_dir,"model.php"); 		?>
<?php include $call->inc($page_dir,"view.php"); 		?>

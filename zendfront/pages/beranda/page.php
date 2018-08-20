<?php defined('mainload') or die('Restricted Access'); 	?>
<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>js/mousehold.js"></script>

<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>js/colorpicker/bootstrap-colorpicker.js"></script>
<link href="<?php echo $web_ftpl_dir; ?>js/colorpicker/bootstrap-colorpicker.css" rel="stylesheet">


<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>js/slider/bootstrap-slider.min.js"></script>
<link href="<?php echo $web_ftpl_dir; ?>js/slider/bootstrap-slider.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>js/html2canvas.min.js"></script>



<?php include $call->lib("accounting"); 		?>
<?php include $call->inc($page_dir,"controller.php"); 		?>
<?php include $call->inc($page_dir,"model.php"); 		?>
<?php include $call->inc($page_dir,"view.php"); 		?>


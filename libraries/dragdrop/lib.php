<?php require("php/db.php"); ?>
<?php if(!empty($dirhost)){ $dragdrop = $dirhost."/libraries/dragdrop/"; } ?>
<script type="text/javascript" src="<?php echo @$dragdrop; ?>js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo @$dragdrop; ?>js/jquery-ui-1.7.1.custom.min.js"></script>
<link href="<?php echo $dragdrop; ?>css/dnd.css" rel="stylesheet" type="text/css" />
<style>
ul {
	margin: 0;
}

</style>


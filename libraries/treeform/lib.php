    <?php $treeview_check = $dirhost."/libraries/treeform/"; ?>
	<!--<script type="text/javascript" src="<?php echo @$treeview_check; ?>js/jquery-1.4.4.js"></script>-->
    <script type="text/javascript" src="<?php echo @$treeview_check; ?>js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo @$treeview_check; ?>js/jquery.checkboxtree.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo @$treeview_check; ?>css/jquery.checkboxtree.css"/>

    <script type="text/javascript">
        $(document).ready(function() {
			$('#tree2').checkboxTree({
				collapseImage: '<?php echo @$treeview_check; ?>images/bminus.png',
				expandImage: '<?php echo @$treeview_check; ?>images/bplus.png'
				
			});
        });
    </script>

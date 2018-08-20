<?php defined('mainload') or die('Restricted Access'); ?>
<?php if(!empty($dirhost)){ $datetimepicker = $dirhost."/libraries/datetimepicker/"; } ?>
<!--<script type="text/javascript" src="<?php echo @$datetimepicker; ?>js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo @$datetimepicker; ?>css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo @$datetimepicker; ?>css/font-awesome.min.css" />-->

<script type="text/javascript" src="<?php echo @$datetimepicker; ?>js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo @$datetimepicker; ?>js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo @$datetimepicker; ?>css/bootstrap-datetimepicker.min.css" />

<?php if(empty($datetimepicker)){?>
<div class="form-group col-md-6">
    <div class='input-group date' id='datetimepicker1'>
        <input type='text' class="form-control" />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
</script>
<?php } ?>

<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-sm-12">    			   			
    <h2 class="title text-center"><?php echo @$dt_halaman->TITLE; ?></h2>  
    <?php echo stripslashes(@$dt_halaman->CONTENT); ?>
</div>

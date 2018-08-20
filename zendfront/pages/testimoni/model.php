<?php defined('mainload') or die('Restricted Access'); ?>

<?php
	$q_str 			= "SELECT * FROM ".$tpref."testimonials ORDER BY ID_TESTIMONIAL DESC LIMIT 0,24";
	$q_testimoni 	= $db->query($q_str);
?>

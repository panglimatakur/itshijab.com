<?php
$dbhost							= "localhost";
$dbuser							= "itshijab_casudab";
$dbpass							= "casudabe220889";
$dbname							= "itshijab_its";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
?>
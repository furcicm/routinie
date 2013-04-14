<?php
include('routinie_conf.php');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$con) {
  die('Something goes wrong');
}
	
$db_selected = mysql_select_db(DB_DATABASE, $con);
if (!$db_selected) {
  die ('Something goes wrong with select database');
}
?>
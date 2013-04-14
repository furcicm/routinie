<?php
  session_start();	
  require_once('../include/connect_db.php');
  $uid = $_SESSION['uid'];

  $query = mysql_query("SELECT `provider` `p` FROM `sn_linked_account` WHERE `uid`='$uid'");
  $output = array();
  while ($result = mysql_fetch_assoc($query)) {
  	$output[] = $result['p'];
  }

  echo json_encode($output);
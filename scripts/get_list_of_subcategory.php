<?php 
  @session_start();
  include_once('../include/connect_db.php');
  $cat = isset($_POST['cat']) ? $_POST['cat'] : '';
  if ($cat) {
  	$output = array();
  	$query = mysql_query("SELECT * FROM `subcategory` WHERE `cid`='$cat'");
  	while ($result = mysql_fetch_assoc($query)) {
  		$output[$result['sid']] = ucfirst($result['name']);
  	}

  	echo json_encode($output);
  }
<?php
@session_start();
require_once('../include/functions.inc');
$uid = $_SESSION['uid'];
$subcats = array("Choose a category");

if (isset($_GET['cat'])) {
	$cid = $_GET['cat'];
	$subcats = get_subcategory_by_cid($cid) ? get_subcategory_by_cid($cid) : array(0 => "Choose a category");
}
$selected_subcat = $subcats ? $cid : 0;
if (isset($_GET['subcat'])) {

	$subcat = $_GET['subcat'];
	$sid = get_progress_sid_by_name($subcat);
	// $main_content = eval(file_get_contents('templates/' . $subcat . '_page.tpl.php'));
	$template = get_template_by_subcategory($subcat);
	ob_start();
	include_once('templates/' . $template . '_page.tpl.php');
	$main_content = ob_get_clean();
}
else {
	// $main_content = eval(file_get_contents('templates/main_page.tpl.php'));
	$progress = get_current_progress_by_uid($uid);
	// print_r($progress);
	ob_start();
	include_once('templates/main_page.tpl.php');
	$main_content = ob_get_clean();
}
                          
include_once('../templates/main_page.tpl.php');

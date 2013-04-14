<?php

@session_start();
include_once('../include/connect_db.php');
include_once('inc/get_progress.php.inc');
$uid = $_SESSION['uid'];

if (isset($_POST['sid']) && $_POST['sid']) {
	$sid = $_POST['sid'];
	$output = get_current_planner_progress($sid, $uid, true);
	echo json_encode($output);
}



/*if (isset($_POST['sid']) && $_POST['sid']) {
	$sid = $_POST['sid'];
	$progress_sids = array(2,3,4,5,6,7,8,13,14,15,16,17,18,19,20,21,22,26);
	$progress_books_sids = array(1);
	$progress_diet_sids = array(10);
	$progress_money_sids = array(23,24,25);
	$progress_movement_sids = array(11,12);
	$progress_sports_sids = array(9);

	switch (true) {
		case (in_array($sid, $progress_sids)) :
			$query = mysql_query("SELECT SUM(`time`) time 
				FROM `progress` 
				WHERE `uid`='$uid'
				AND `sid`='$sid'
				AND `done`= 0
				GROUP BY `sid`
			");
			
			while ($prog = mysql_fetch_assoc($query)) {
				$time_progress = $prog['time'];
			}
			
			$query = mysql_query("SELECT `data` 
				FROM `specific_planner`
				WHERE `uid`='$uid'
				AND `sid`='$sid'
			");
			
			while ($plan = mysql_fetch_assoc($query)) {
				$time_plan = $plan['data'];
				$tmp = explode('+-+', $time_plan);
				$tmp = explode('==', $tmp[0]);
				$time_plan = $tmp[1];
			}

			break;

		case (in_array($sid, $progress_books_sids)) : 
			




			break;
		
		case (in_array($sid, $progress_diet_sids)) : 
			






			break;
		
		case (in_array($sid, $progress_money_sids)) :





			break;
		
		case (in_array($sid, $progress_movement_sids)) :




			break;

		case (in_array($sid, $progress_sports_sids)) : 





			break; 
	}
	



 $output['time_progress'] = $time_progress;
 $output['time_plan'] = $time_plan;




echo json_encode($output);*/


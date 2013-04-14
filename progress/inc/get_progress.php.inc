<?php

function get_progress_info($sid, $uid, $created = 0) {
	$table = get_table($sid);
	
	$progress_query = mysql_query("SELECT created c
		FROM $table 
		WHERE uid='$uid' AND sid='$sid' ORDER BY c DESC LIMIT 1");
	$tmpc = mysql_fetch_assoc($progress_query);	
	$output['last_created'] = isset($tmpc['c']) ? convert_to_days_ago($tmpc['c']) : 'Never';	
	
	switch ($table) {

		case 'progress':

			$progress_query = mysql_query("SELECT SUM(time) t
				FROM progress 
				WHERE uid='$uid' AND sid='$sid' AND done=0 AND created>$created");
			$tmpd = mysql_fetch_assoc($progress_query);
			if ($created) {
				$output['progress_bar']['minutes'] = (isset($tmpd['t']) ? $tmpd['t'] : 0);
			}
			else {
				$output['data'] = (isset($tmpd['t']) ? $tmpd['t'] : 0) . ' Minutes';
			}

			break;

		case 'progress_diet':
			$progress_query = mysql_query("SELECT SUM(quantity) q
				FROM progress_diet 
				WHERE uid='$uid' AND sid='$sid'  AND done=0 AND created>$created");
			$tmp = mysql_fetch_assoc($progress_query);
			$output['data'] = (isset($tmp['q']) ? $tmp['q'] : 0) . ' Quantity';
			break;

		case 'progress_books':
			$progress_query = mysql_query("SELECT SUM(time) t, SUM(pages) p
				FROM progress_books 
				WHERE uid='$uid' AND sid='$sid'  AND done=0 AND created>$created");
			$tmp = mysql_fetch_assoc($progress_query);
			$pages = (isset($tmp['p']) ? $tmp['p'] : 0) . ' Pages in ';
			$time = (isset($tmp['t']) ? $tmp['t'] : 0) . ' Minutes';
			if ($created) {
				$output['progress_bar']['pages'] = (isset($tmp['p']) ? $tmp['p'] : 0);
				$output['progress_bar']['minutes'] = (isset($tmp['t']) ? $tmp['t'] : 0);
			}
			else {
				$output['data'] = $pages . $time;
			}
			break;

		case 'progress_money':
			$progress_query = mysql_query("SELECT SUM(amount) a, currency c
				FROM progress_money 
				WHERE uid='$uid' AND sid='$sid' AND currency IS NOT NULL  AND done=0 AND created>$created
				GROUP BY currency");
			$result = array();
			$result_tmp = array();
			while($tmp = mysql_fetch_assoc($progress_query)) {
				if ($created) {
					$output['progress_bar'][$tmp['c']] = $tmp['a'];
				}
				else {
					$result[] = $tmp['a'] . ' ' . ucfirst($tmp['c']);	
				}
			}
			if(!$created) {
				$output['data'] = implode(', ', $result);
			}
			break;

		case 'progress_movement':
			$progress_query = mysql_query("SELECT SUM(time) t, SUM(km) k
				FROM progress_movement 
				WHERE uid='$uid' AND sid='$sid'  AND done=0 AND created>$created");
			$tmp = mysql_fetch_assoc($progress_query);
			if ($created) {
				$output['progress_bar']['km'] = (isset($tmp['k']) ? round($tmp['k'], 2) : 0);
				$output['progress_bar']['minutes'] = (isset($tmp['t']) ? $tmp['t'] : 0);
			}
			else {
				$output['data'] = (isset($tmp['k']) ? round($tmp['k'], 2) : 0) . ' Km in ' . (isset($tmp['t']) ? $tmp['t'] : 0) . ' Minutes';
			}
			break;

		case 'progress_sports':
			$progress_query = mysql_query("SELECT SUM(games) g, SUM(time) t
				FROM progress_sports 
				WHERE uid='$uid' AND sid='$sid'  AND done=0 AND created>$created");
			$tmp = mysql_fetch_assoc($progress_query);
			if ($created) {
				$output['progress_bar']['games'] = (isset($tmp['g']) ? $tmp['g'] : 0);
				$output['progress_bar']['minutes'] = (isset($tmp['t']) ? $tmp['t'] : 0);
			}
			else {
				$output['data'] = (isset($tmp['g']) ? $tmp['g'] : 0) . ' Games in ' . (isset($tmp['t']) ? $tmp['t'] : 0) . ' Minutes';
			}
			break;
		
	}
	return $output;
}

function get_all_progress_info_by_user($uid){

 include_once('include/connect_db.php');
  $query = mysql_query("SELECT s.sid sid, sb.cid cid, sb.name, name 
                        FROM specific_planner s
                        INNER JOIN subcategory sb
                        ON s.sid=sb.sid 
                        WHERE s.uid='$uid'");
  
  $category_query = mysql_query("SELECT * FROM category");
  while ($category_result = mysql_fetch_assoc($category_query)) {
    $category[$category_result['cid']] = $category_result['name'];
  }

  $all_progress = array();
   while ($result = mysql_fetch_assoc($query)) {
    $all_progress[$category[$result['cid']]][$result['sid']] =  $result['name'];
  }
  return $all_progress;
}

function get_table($sid) {
	$sids_db = array(
		'progress' => array(2,3,4,5,6,7,8,13,14,15,16,17,18,19,20,21,22,26),
		'progress_books' => array(1),
		'progress_diet' => array(10),
		'progress_money' => array(23,24,25),
		'progress_movement' => array(11,12),
		'progress_sports' => array(9),
	);

	foreach ($sids_db as $k => $v) {
		if (in_array($sid, $v)) {
			$table = $k;
		break;
	}
	
	}
	return $table;
}

function get_current_planner_progress($sid, $uid, $get_plan = false){
	$plan_query = mysql_query("SELECT data, created c FROM specific_planner WHERE uid='$uid' AND sid='$sid' ORDER BY created DESC LIMIT 1");
	$result = mysql_fetch_assoc($plan_query);
	$created = $result['c'];
	$tmp = explode('+-+', $result['data']);
	$output['current_plan'] = '';	
	$output['nr_plan'] = array();
	if(in_array($sid, array(23,24,25))) {
		$tmp_money = explode('==', $tmp[0]);
		$tmp_currency = explode('==', $tmp[1]);
		$type = $tmp_currency[1];
		$output['current_plan'] .= $tmp_money[1] . ' ' . ucfirst($tmp_currency[1]) . ' ';
		$output['data'][$type] = $tmp_money[1];
		$output['nr_plan'][] = $type;
	}
	else {
		foreach($tmp as $key => $data) {
			if(!empty($data)) {
				$tmp_out = explode('==', $data);
				$type = ($tmp_out[0] == 'time')? 'minutes' : $tmp_out[0];
				$output['current_plan'] .= $tmp_out[1] . ' ' . ucfirst($type) . ' '; 
				$output['data'][$type] = $tmp_out[1];
				$output['nr_plan'][] = $type;

			}
		}
	}
	if ($get_plan) {
		$tmp_prog  = get_progress_info($sid, $uid, $created);
		$output_plan['progress'] = $tmp_prog['progress_bar'];
		$output_plan['plan'] = $output['data'];
		return $output_plan;
		exit;
	}
	return $output;
}

function convert_to_days_ago($time) {
	$now = time();
	$diff = $now - $time;
	$nr_days = (int) ($diff / (24 * 3600));
	if ($nr_days == 0) {
		return 'Today';
	}
	if ($nr_days == 1) {
		return 'Yesterday';
	}
	
	return $nr_days . ' Days ago';

}
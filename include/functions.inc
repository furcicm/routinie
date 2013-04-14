<?php

require_once('connect_db.php');

function get_subcategory_by_cid($cid) {
	$query_subcat = mysql_query("SELECT * FROM subcategory WHERE cid='$cid'");
	while ($subcat = mysql_fetch_assoc($query_subcat)) {
		$output[$subcat['sid']] = $subcat['name'];
	}
	return $output;
}

function get_current_progress_by_uid($uid) {
	$output = array();
	$query_progress = mysql_query("SELECT * FROM planner_progress_percentage WHERE uid='$uid'");
	$nr = 0;
	while ($progress = mysql_fetch_array($query_progress)) {
		$name = get_progress_name_by_sid($progress['sid']);
		$output[$name][$progress['field']] = array('value' => $progress['value']);
	}
	return $output;
}
function get_progress_name_by_sid($sid) {
	$name = array(
		1 => 'books',
  	2 => 'courses',
		3 => 'tutorials',
		4 => 'experiments',
		5 => 'research',
		6 => 'work',
		7 => 'projects',
		8 => 'contracts',
		9 => 'sports',
		10 => 'diet',
		11 => 'walking',
		12 => 'jogging',
		13 => 'traveling',
		14 => 'hobbies',
		15 => 'volunteering',
		16 => 'relationships',
		17 => 'friends',
		18 => 'family',
		19 => 'television',
		20 => 'movies',
		21 => 'music',
		22 => 'games',
		23 => 'income',
		24 => 'expenses',
		25 => 'donations',
		26 => 'sleep',
	);
	return $name[$sid];
}

function get_progress_sid_by_name($name) {
	$sid = array(
		'books' => 1,
  	'courses' => 2, 
		'tutorials' => 3,
		'experiments' => 4,
		'research' => 5,
		'work' => 6,
		'projects' => 7, 
		'contracts' => 8,
		'sports' => 9,
		'diet' => 10,
		'walking' => 11,
		'jogging' => 12,
		'traveling' => 13,
		'hobbies' => 14,
		'volunteering' => 15,
		'relationships' => 16,
		'friends' => 17,
		'family' => 18,
		'television' => 19,
		'movies' => 20,
		'music' => 21,
		'games' => 22,
		'income' => 23,
		'expenses' => 24,
		'donations' => 25,
		'sleep' => 26,
	);
	return $sid[$name];
}


function get_template_by_subcategory($sub) {
	$out = array(
		'sleep' => 'template_1',
		'diet' => 'template_2',
		'work' => 'template_3', 
		'game' => 'template_3',
		'research' => 'template_3',
		'contracts' => 'template_3',
		'tutorials' => 'template_3',
		'experiments' => 'template_3', 
		'hobbies' => 'template_3',
		'music' => 'template_3',
		'courses' => 'template_3',
		'volunteering' => 'template_3',
		'projects' => 'template_3',
		'television' => 'template_3',
		'donations' => 'template_4',
		'expenses' => 'template_4',
		'income' => 'template_4',
		'jogging' => 'template_5',
		'walking' => 'template_5',
		'sports' => 'template_6',
		'books' => 'template_7',
		'movies' => 'template_8',
		'relationships' => 'template_9',
		'friends' => 'template_9',
		'family' => 'template_9',
		'traveling' => 'template_10',
	);
	return $out[$sub];
}


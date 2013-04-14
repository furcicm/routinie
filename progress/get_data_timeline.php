 <?php
  @session_start();
  include_once('../include/connect_db.php');
  $uid = $_SESSION['uid'];
  $sid = $_POST['sid'];
  $freq = $_POST['freq'];

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
  $column = 'time'; // default
  if ($table == 'progress_money') {
    $column = 'amount';
  }
  if ($table == 'progress_diet') {
    $column = 'quantity';
  }
  if ($table && $sid && $freq) {
    if ($freq == 'Daily') {
      $time = 3600*24;
    }
    elseif ($freq == 'Weekly') {
      $time = 3600*24*7;
    }

    $today = strtotime('today');

    for($i = 6; $i >= 0; $i--) {
    	$days[$i] = $today - $time * $i;
    }
    foreach ($days as $day) {
    	$end_day = $day + $time;
    	$query = mysql_query("SELECT SUM($column) `t` FROM $table WHERE `uid`='$uid' 
                            AND `sid`='$sid' AND `created` BETWEEN '$day' AND '$end_day'");
    	if ($query) {
        $result = mysql_fetch_assoc($query);
      }

    	$output = isset($result['t']) ? $column == 'time' ? round($result['t'] / 60, 2) : $result['t'] : 0;
      $out['data'][] = $freq == 'Daily' ? array(date('M, d', $day), $output) : array(date('\W\e\e\k W', $day), $output);
    }
    $out['title'] = ucfirst($column) . ($column == 'time' ? ' (hours)' : '');
    echo json_encode($out, JSON_NUMERIC_CHECK);
    
  }


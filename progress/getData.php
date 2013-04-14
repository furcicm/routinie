<?php
  @session_start();
  include_once('../include/connect_db.php');
  $uid = $_SESSION['uid'];
  $one_day = 86400; //seconds
  // $_POST['date_day'] = "13-02-2013";
  if (isset($_POST['date_week'])) {
    $created = date('Y\-W', strtotime($_POST['date_week']));
    $table = 'weekly_progress';
    // if ($_POST['date_week'] != 'Today') {
    //   if (date('D', strtotime($_POST['date_week'])) == 'Mon') {
    //     $start_day = strtotime($_POST['date_week']);
    //   }
    //   else {
    //     $start_day = strtotime('last Monday', strtotime($_POST['date_week']));
    //   }
    // }
    // else {
    //   if (date('D', strtotime('today')) == 'Mon') {
    //     $start_day = strtotime('today');
    //   }
    //   else {
    //     $start_day = strtotime('last Monday');
    //   }
    // }
    // $end_day = $start_day + (7 * $one_day);
  }
  elseif (isset($_POST['date_day'])) {
    $created = date('Y\-m\-d', strtotime($_POST['date_day']));
    $table = 'daily_progress';
    /*if (isset($_POST['date_day'])) {
      if ($_POST['date_day'] != 'Today') {
        $start_day = strtotime($_POST['date_day']);
      }
      else {
        $start_day = strtotime('today');
      }
    }

    $end_day = $start_day + $one_day;*/
  }

 /* $query = mysql_query("SELECT p.sid, SUM(p.time) time, s.name
                        FROM progress p
                        INNER JOIN subcategory s
                        ON s.sid=p.sid
                        WHERE p.uid=$uid AND p.done=0 AND p.created > $start_day
                        AND p.created < $end_day
                        GROUP BY p.sid
                        UNION ALL
                        SELECT p.sid, SUM(p.time) time, s.name
                        FROM progress_books p
                        INNER JOIN subcategory s
                        ON s.sid=p.sid
                        WHERE p.uid=$uid AND p.done=0 AND p.created > $start_day
                        AND p.created < $end_day
                        GROUP BY p.sid
                        UNION ALL
                        SELECT p.sid, SUM(p.time) time, s.name
                        FROM progress_movement p
                        INNER JOIN subcategory s
                        ON s.sid=p.sid
                        WHERE p.uid=$uid AND p.done=0 AND p.created > $start_day
                        AND p.created < $end_day
                        GROUP BY p.sid
                        UNION ALL
                        SELECT p.sid, SUM(p.time) time, s.name
                        FROM progress_sports p
                        INNER JOIN subcategory s
                        ON s.sid=p.sid
                        WHERE p.uid=$uid AND p.done=0 AND p.created > $start_day
                        AND p.created < $end_day
                        GROUP BY p.sid");
*/

  $query = mysql_query("SELECT p.time, s.name FROM $table p
                        INNER JOIN subcategory s
                        ON s.sid=p.sid
                        WHERE p.uid=$uid AND p.created='$created'");
  // echo json_encode(mysql_fetch_assoc($query));
  // echo json_encode(array($table, $created, $uid)); die; 
  $result2['cols'] = array (
        0 => 
        array (
          'id' => '',
          'label' => 'Topping',
          'pattern' => '',
          'type' => 'string',
        ),
        1 => 
        array (
          'id' => '',
          'label' => 'Slices',
          'pattern' => '',
          'type' => 'number',
        ),
    );

  

  $time_left = $one_day/60;
  if (isset($_POST['date_week'])) {
    $time_left = 7 * $one_day/60;  
  }

  if ($query) {
    while ($row = mysql_fetch_assoc($query)) {

      $time_left -= $row['time'];
      $time = $row['time'];
      $result2['rows'][] = array('c'=>array(0=>array('v' => ucfirst($row['name']), 'f' => NULL), 1=>array('v' => $time, 'f' => NULL)));
      $result2['legend'][ucfirst($row['name'])] = min_to_time($time);
    }

  }
  $result2['rows'][] = array('c'=>array(0=>array('v' => 'Unallocated time', 'f' => NULL), 1=>array('v' => $time_left, 'f' => NULL)));
  // $result2['aaaaaaaaaaaaaaaaaaaaaaaa'] = min_to_time($time_left);
  if ($time_left == '1440' || empty($time_left)) { 
    $time_displayed = "24 : 00";
  }
  else {
    $time_displayed = min_to_time($time_left);
  }

  $result2['legend']['Unallocated time'] = $time_displayed;
  $list_of_colors = array('maroon', 'saddlebrown', 'magenta', 'olive', 'coral', 'lightseagreen', 'royalblue', 'dimgray',  'blue', 'mediumslateblue');
  $color = array();
  $nr = 0;
  $result3 = array();
  foreach($result2['legend'] as $k=>$v) {
    $result3[$k] = $v;
    $color[$k] = $list_of_colors[$nr];
    $nr++;
  }

  natsort($result3);
  $result2['legend'] = array_reverse($result3);
  $result2['colors'] = $color;

  if ($time_left && $time_left > -1) {
    echo json_encode($result2, JSON_NUMERIC_CHECK);
  }
  else {
    echo json_encode('error');
  }

function min_to_time($min, $type = 'week') {
  $seconds = $min * 60;
  // extract days
  $hours = floor($seconds / 3600);

  // extract minutes
  $divisor_for_minutes = $seconds % 3600;
  $minutes = floor($divisor_for_minutes / 60);

  // return the final array
  $obj = array(
      "h" => (int) $hours,
      "m" => (int) $minutes,
  );

  if (strlen($obj["h"]) == 1) $obj["h"] = "0" . $obj["h"];
  if (strlen($obj["m"]) == 1) $obj["m"] = "0" . $obj["m"];
  return $obj["h"] . " : " . $obj["m"];
}


  // $string = file_get_contents("sampleData.json");

?>
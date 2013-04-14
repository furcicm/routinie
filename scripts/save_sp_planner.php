<?php

session_start();

if (isset($_POST['save_plan'])) {
  require_once('../include/connect_db.php');
  $uid = $_SESSION['uid'];
  $result = 1;
  $planner_table = array(
    1 => 's_planner_book',
    2 => 's_planner_course',
    3 => 's_planner_tutorial',
    4 => 's_planner_experiment',
    5 => 's_planner_research',
    6 => 's_planner_work',
    7 => 's_planner_project',
    8 => 's_planner_contract',
    9 => 's_planner_sport',
    11 => 's_planner_walking',
    12 => 's_planner_jogging',
    13 => 's_planner_traveling',
    14 => 's_planner_hobby',
    15 => 's_planner_volunteer',
    16 => 's_planner_relationship',
    17 => 's_planner_friend',
    18 => 's_planner_family',
    19 => 's_planner_television',
    20 => 's_planner_movie',
    21 => 's_planner_music',
    22 => 's_planner_game',
    23 => 's_planner_income',
    24 => 's_planner_expense',
    25 => 's_planner_donation',
    26 => 's_planner_sleep',
  );

  $planner_progress_table = array(
    1 => 'planner_progress_percentage',
    2 => 'planner_progress_percentage',
    3 => 'planner_progress_percentage',
    4 => 'planner_progress_percentage',
    5 => 'planner_progress_percentage',
    6 => 'planner_progress_percentage',
    7 => 'planner_progress_percentage',
    8 => 'planner_progress_percentage',
    9 => 'planner_progress_percentage',
    10 => 'planner_progress_percentage',
    12 => 'planner_progress_percentage',
    13 => 'planner_progress_done',
    14 => 'planner_progress_done',
    15 => 'planner_progress_percentage',
    16 => 'planner_progress_done',
    17 => 'planner_progress_done',
    18 => 'planner_progress_done',
    19 => 'planner_progress_percentage',
    20 => 'planner_progress_percentage',
    21 => 'planner_progress_percentage',
    22 => 'planner_progress_percentage',
    23 => 'planner_progress_percentage',
    24 => 'planner_progress_percentage',
    25 => 'planner_progress_percentage',
    26 => 'planner_progress_percentage',
  );

  foreach($_POST['data'] as $sid => $values) {
    $created = strtotime('now');
    $data = array("''", "'" . $uid . "'");
    if ($values) {
      $only_one_time = TRUE;
      $one_time = FALSE;
      foreach($values as $value) {
        $val_tmp = $value[0];
        $table_prog = $planner_progress_table[$sid];
        $data_prog = $data;
        array_push($data_prog, "'" . $sid . "'");
        array_push($data_prog, "0");
        if ($table_prog == 'planner_progress_percentage') {
          $field = $value[1];
          array_push($data_prog, "'" . $field . "'");
          $only_one_time = FALSE;
        }
        $values_prog = implode(',', $data_prog);
        if (!$one_time) {
          if (($table_prog == 'planner_progress_percentage' && $val_tmp) || $table_prog == 'planner_progress_done') {
            $query_prog = mysql_query("INSERT INTO $table_prog VALUES ($values_prog)");
          }
          if ($only_one_time) {
            $one_time = true;
          }
        }
      }  
    
    
      array_push($data, "'" . time() . "'");
      array_push($data, '1');
      $values = implode(",", $data);
      $table = $planner_table[$sid];

      $query = mysql_query("INSERT INTO $table VALUES ($values)");
      if (!mysql_affected_rows()) {
            $result = 2;
      }
    }
  }
  $_SESSION['message'] = 'Your specific planner has been saved.';
  echo $result;
}
else {
  header("Status: 404 Not Found");
}

?>
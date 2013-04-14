<?php
  session_start();
  if (isset($_POST['save_plan'])) {
    require_once('../include/connect_db.php');
    $uid = $_SESSION['uid'];
    //print_r($_SESSION);
    $period = $_SESSION['planner_year'];
    $result = 1;
    //$update = 0;print_r($_SESSION);die;
    // Check to see if there is a record with the same period.
    $query = mysql_query("SELECT * 
                          FROM `wesrom_routinie`.`general_planner` 
                          WHERE `uid`='$uid' 
                          AND `period`='$period'");
    if ($query) {
    $row = mysql_fetch_array($query);
        if ($row['period'] == $period) {
          $update = 1;
        }
    }
    
    foreach($_SESSION as $key => $value) {
      $key = explode('__', $key);
      if ($key[0] == 'planner') {
        $created = strtotime('now');
        $cat = $key[1];
        $question = $key[2];
        $value = explode('__', $value);
        $now = $value[0];
        $after = $value[1];
        if ($update) {
          $query = mysql_query("UPDATE `wesrom_routinie`.`general_planner`
                                SET `answer_now` = '$now', `answer_after` = '$after', `created` = '$created'
                                WHERE `period`='$period'
                                AND `uid`='$uid'
                                AND `question` = '$question' ");
        }
        else {
          $query = mysql_query("INSERT INTO `wesrom_routinie`.`general_planner` 
                            (`uid`, `period`, `category`, `question`, `answer_now`, `answer_after`, `created`)
                            VALUES ('$uid', '$period', '$cat', '$question', '$now', '$after', '$created')");
        }
  
        if (!mysql_affected_rows()) {
          $result = 2;
        }
        
        //echo "\n";
      }
    }
    $_SESSION['message'] = 'Your general planner has been saved.';
    echo $result;
  
    
  }
  else {
    header("Status: 404 Not Found");
  }
?>
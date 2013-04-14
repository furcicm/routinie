<?php
  session_start();
  
  if (isset($_POST['sid'])) {
    
    $sid = $_POST['sid'];
    $title = isset($_POST['title'])? $_POST['title'] : '';
    $uid = $_SESSION['uid'];
    $created = strtotime('now');
    $page = isset($_POST['page'])? $_POST['page'] : '';
    $table = isset($_POST['table'])? $_POST['table'] : '';
    switch ($sid) {
      case 1: // books
        $nr_pages = isset($_POST['pages'])? $_POST['pages'] : '';
      case 2: // courses
      case 3: // tutorials
      case 4: // experiments
      case 5: // research
      case 19: // television
        $nr_time = isset($_POST['time'])? $_POST['time'] : ''; 
        break;

      case 11: // walking
      case 12: // jogging
        $km = isset($_POST['km'])? $_POST['km'] : '';
        $nr_time = isset($_POST['time'])? $_POST['time'] : ''; 
        break;

      case 9: // sports
        $games = isset($_POST['games'])? $_POST['games'] : '';
      case 6: // work
      case 7: // projects
      case 8: // contracts
        $nr_time = isset($_POST['time-hour']) ? $_POST['time-hour'] * 60 : '';
        break;

      case 10: // diet
        $quantity = isset($_POST['quantity'])? $_POST['quantity'] : '';
        break;

      case 14: // hobbies
      case 15: // volunteering
      case 26: // sleep
      case 21: // music
      case 22: // games
        $hour_to_min = isset($_POST['time-hour'])? $_POST['time-hour'] * 60 : 0;
        $minutes = isset($_POST['time-minutes'])? $_POST['time-minutes'] : 0;
        $nr_time = $hour_to_min + $minutes;
        break;

      case 13: // traveling
        $start = isset($_POST['travel-start'])? strtotime($_POST['travel-start']) : '';
        $end = isset($_POST['travel-end'])? strtotime($_POST['travel-end']) : '';
        $continent = !empty($_POST['title-continent']) ? $_POST['title-continent'] : '';
        $country = !empty($_POST['title-country']) ? $_POST['title-country'] : '';
        $place = !empty($_POST['title-place']) ? $_POST['title-place'] : '';
        break;

      case 16: // relationships
      case 17: // friends
      case 18: // family
        $with = !empty($_POST['social-whom']) ? $_POST['social-whom'] : ''; 
        $where = !empty($_POST['social-place']) ? $_POST['social-place'] : '';
        $nr_time = isset($_POST['time'])? $_POST['time'] : ''; 
        break;

      case 20: // movies
        $title = $_POST['title-movie'];
        $type = $_POST['type-movie'];
        $nr_time = isset($_POST['time'])? $_POST['time'] : ''; 
        break;
      
      case 23: // income
      case 24: // expenses
      case 25: // donations
        $currency = isset($_POST['currency'])? $_POST['currency'] : '';
        $amount = isset($_POST['amount'])? $_POST['amount'] : '';
        break;

    }
  }
  else {
    header("Location: http://routinie.com");
  }
  /*$title = isset($_POST['title'])? $_POST['title'] : '';
  $nr_pages = isset($_POST['pages'])? $_POST['pages'] : '';
  $nr_time = isset($_POST['time'])? $_POST['time'] : ''; 
  if (!$nr_time) {
    $hour_to_min = isset($_POST['time-hour-hob-vol'])? $_POST['time-hour-hob-vol'] * 60 : 0;
    $minutes = isset($_POST['time-minutes-hob-vol'])? $_POST['time-minutes-hob-vol'] : 0;
    if ($hour_to_min || $minutes) {
      $nr_time = $hour_to_min + $minutes;
    }
  }
  if (isset($_POST['page']) && $_POST['page'] == 'movies') {
    $title = $_POST['title-movie'] . '+-+' . $_POST['type-movie'];
  }
  $table = isset($_POST['table'])? $_POST['table'] : '';
  $sid = isset($_POST['sid'])? $_POST['sid'] : '';
  $page = isset($_POST['page'])? $_POST['page'] : '';
  $games = isset($_POST['games'])? $_POST['games'] : '';
  $quantity = isset($_POST['quantity'])? $_POST['quantity'] : '';
  $km = isset($_POST['km'])? $_POST['km'] : '';
  $travel_start = isset($_POST['travel-start'])? strtotime($_POST['travel-start']) : '';
  $travel_end = isset($_POST['travel-end'])? strtotime($_POST['travel-end']) : '';
  if (!$title) {
    if (!empty($_POST['social-whom'])) {$title = $_POST['social-whom'];}
    if (!empty($_POST['social-place'])) {$title .= '+-+' . $_POST['social-place'];}
  }
  // travel duration
  if(!$nr_time) {
    $nr_time = (isset($travel_end) && isset($travel_start))? $travel_end - $travel_start : '';
  }
  if (!$title) {
    if (!empty($_POST['title-continent'])) {$title = $_POST['title-continent'];} else {$title = '#null';}
    if (!empty($_POST['title-country'])) {$title .= '-' . $_POST['title-country'];} else {$title .= '-#null';}  
    if (!empty($_POST['title-place'])) {$title .= '-' . $_POST['title-place'];} else {$title .= '-#null';}
  }
  $currency = isset($_POST['currency'])? $_POST['currency'] : '';
  $amount = isset($_POST['amount'])? $_POST['amount'] : '';
  $uid = $_SESSION['uid'];
  $created = strtotime('now');
  if (isset($_POST['time-hour'])) {
    $nr_time = $_POST['time-hour'] * 60;
  }*/


  include_once('../include/connect_db.php');
  $title = strtolower($title);

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

   // If planner exist
   $table_plan = $planner_table[$sid];
   print_r(array($table_plan, $uid, $sid));
   $query_planner = mysql_query("SELECT * FROM $table_plan WHERE uid='$uid' AND active=1");
   $skip_key = array('pid', 'uid', 'created', 'active');
   if ($result = mysql_fetch_assoc($query_planner)) {
    foreach ($result as $k => $v) {
      if (!in_array($k, $skip_key)) {
        $plan[$k] = $v;
      }
    }
   }


  if ($nr_time) {
    
    // TODO Optimize this code !
    
    // dalily progress
    $created_date_day = date('Y\-m\-d', $created);
    $query = mysql_query("SELECT time FROM `wesrom_routinie`.`daily_progress` 
              WHERE uid=$uid AND sid=$sid AND created='$created_date_day'");
    if ($q_result = mysql_fetch_assoc($query)) {
      $time = $nr_time + $q_result['time'];
      $result = mysql_query("UPDATE `wesrom_routinie`.`daily_progress` 
                SET `time`=$time
                WHERE uid=$uid AND sid=$sid AND created='$created_date_day'");
      if (!$result) {
        echo mysql_error();
      }
    }
    else {
      $result = mysql_query("INSERT INTO `wesrom_routinie`.`daily_progress` 
                  ( `uid`, `sid`, `time`, `created`)
                  VALUES ('$uid', '$sid', '$nr_time', '$created_date_day')");
      if (!$result) {
        echo mysql_error();
      }
    }


    //weekly progress
    $created_date_week = date('Y\-W', $created);
     $query = mysql_query("SELECT time FROM `wesrom_routinie`.`weekly_progress` 
              WHERE uid=$uid AND sid=$sid AND created='$created_date_week'");
    if ($q_result = mysql_fetch_assoc($query)) {
      $time = $nr_time + $q_result['time'];
      $result = mysql_query("UPDATE `wesrom_routinie`.`weekly_progress` 
                SET `time`=$time
                WHERE uid=$uid AND sid=$sid AND created='$created_date_week'");
      if (!$result) {
        echo mysql_error();
      }
    }
    else {
      $result = mysql_query("INSERT INTO `wesrom_routinie`.`weekly_progress` 
                  ( `uid`, `sid`, `time`, `created`)
                  VALUES ('$uid', '$sid', '$nr_time', '$created_date_week')");
      if (!$result) {
        echo mysql_error();
      }
    }
  }
  if ($_POST['submit-add']) { 
      switch ($table) {
        case 'progress_book':
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_book` 
                                ( `uid`, `sid`, `title`, `time`, `page`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$title', '$nr_time', '$nr_pages', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;
        
        case 'progress':
          $table_db = $_POST['table_db'];
          $result = mysql_query("INSERT INTO $table_db 
                                (`uid`, `sid`, `title`, `time`, `created`, `done`, `active`)
                                VALUES ( '$uid', '$sid', '$title', '$nr_time', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;

        case 'progress_sleep':
          $result = mysql_query("INSERT INTO progress_sleep
                                (`uid`, `sid`, `time`, `created`, `done`, `active`)
                                VALUES ( '$uid', '$sid', '$nr_time', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;

        case 'progress_movie':
          $result = mysql_query("INSERT INTO progress_movie
                                (`uid`, `sid`, `title`,`time`, `type`, `created`, `done`, `active`)
                                VALUES ( '$uid', '$sid', '$title', '$nr_time', '$type', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;
        
        case 'progress_sport':
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_sport` 
                                ( `uid`, `sid`, `title`, `game`, `time`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$title', '$games', '$nr_time', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;

        case 'progress_traveling':
          $result = mysql_query("INSERT INTO progress_traveling 
                                ( `uid`, `sid`, `continent`, `country`, `place`, `start`, `end`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$continent', '$country', '$place', '$start', '$end', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;

        case 'progress_social':
          $table_db = $_POST['table_db'];
          $result = mysql_query("INSERT INTO $table_db
                                ( `uid`, `sid`, `with`, `where`, `time`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$with', '$where', '$nr_time', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;
        
        case 'progress_diet':
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_diet` 
                                (`uid`, `sid`, `title`, `quantity`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$title', '$quantity', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;
        
        case 'progress_movement':
          $table_db = $_POST['table_db'];
          $result = mysql_query("INSERT INTO $table_db 
                                ( `uid`, `sid`, `title`, `distance`, `time`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$title', '$km', '$nr_time', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break; 
        
        case 'progress_money':
          $table_db = $_POST['table_db'];
          $result = mysql_query("INSERT INTO $table_db 
                                (`pid`, `uid`, `sid`, `title`, `amount`, `currency`, `created`, `done`, `active`)
                                VALUES (NULL, '$uid', '$sid', '$title', '$amount', '$currency', '$created', 0, 1)");
          if (!$result) {
            echo mysql_error();
          }
        break;
          
      }
  }
  elseif ($_POST['submit-done']) {
    switch ($table) {
        case 'progress_book':
          if ((!empty($title) && !empty($nr_pages)) || (!empty($title) && !empty($nr_time))) {
            $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_book` 
                                  (`pid`, `uid`, `sid`, `title`, `time`, `page`, `created`, `done`, `active`)
                                  VALUES (NULL, '$uid', '$sid', '$title', '$nr_time', '$nr_pages', '$created', 0, 1)");
          }
          
          $query = mysql_query("SELECT SUM(`time`) AS t_time, SUM(`page`) AS t_pages 
                                FROM `wesrom_routinie`.`progress_book` 
                                WHERE `uid`='$uid' 
                                AND `sid`='$sid'
                                AND `done`=0 
                                AND `active`=1 
                                AND `title`='$title'");
          if ($query) {
            $row = mysql_fetch_array($query);
              $tot_pages = $row['t_pages'];
              $tot_time = $row['t_time'];          
          }
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_book` 
                                (`pid`, `uid`, `sid`, `title`, `time`, `page`, `created`, `done`, `active`)
                                VALUES (NULL, '$uid', '$sid', '$title', '$tot_time', '$tot_pages', '$created', 1, 1)");
          $result = mysql_query("UPDATE `wesrom_routinie`.`progress_book` 
                                SET `done`=0, `active`=0
                                WHERE `title`='$title'
                                AND `uid`='$uid'
                                AND `sid`='$sid'
                                AND `done`=0");
        break;
        
        case 'progress': 
          $table_db = $_POST['table_db'];
          if (!empty($title) && !empty($nr_time)) {
            $result = mysql_query("INSERT INTO $table_db 
                                  (`pid`, `uid`, `sid`, `title`, `time`, `created`, `done`, `active`)
                                  VALUES (NULL, '$uid', '$sid', '$title', '$nr_time', '$created', 0, 1)");
          }
          
          $query = mysql_query("SELECT SUM(`time`) AS t_time 
                                FROM $table_db 
                                WHERE `uid`='$uid' 
                                AND `done`=0 
                                AND `sid`='$sid'
                                AND `active`=1 
                                AND `title`='$title'");
          if ($query) {
            $row = mysql_fetch_array($query);
              $tot_time = $row['t_time'];          
          }
          $result = mysql_query("INSERT INTO $table_db 
                                (`pid`, `uid`, `sid`, `title`, `time`, `created`, `done`, `active`)
                                VALUES (NULL, '$uid', '$sid', '$title', '$tot_time', '$created', 1, 1)");
          $result = mysql_query("UPDATE $table_db 
                                SET `done`=0, `active`=0
                                WHERE `title`='$title'
                                AND `uid`='$uid'
                                AND `sid`='$sid'
                                AND `done`=0");
        break;
        
         case 'progress_sport': 
          if (!empty($title) && !empty($games)) {
            $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_sport` 
                                  (`uid`, `sid`, `title`, `game`, `time`, `created`, `done`, `active`)
                                  VALUES ('$uid', '$sid', '$title', '$games', '$nr_time', '$created', 0, 1)");
          }
          
          $query = mysql_query("SELECT SUM(`time`) AS t_time, SUM(`game`) AS t_games 
                                FROM `wesrom_routinie`.`progress_sport` 
                                WHERE `uid`='$uid' 
                                AND `done`=0 
                                AND `sid`='$sid'
                                AND `active`=1 
                                AND `title`='$title'");
          if ($query) {
            $row = mysql_fetch_array($query);
              $tot_time = $row['t_time']; 
              $tot_games = $row['t_games'];
          }
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_sport` 
                                (`uid`, `sid`, `title`, `game`, `time`, `created`, `done`, `active`)
                                VALUES ('$uid', '$sid', '$title', '$tot_games', '$tot_time', '$created', 1, 1)");
          $result = mysql_query("UPDATE `wesrom_routinie`.`progress_sport` 
                                SET `done`=0, `active`=0
                                WHERE `title`='$title'
                                AND `uid`='$uid'
                                AND `sid`='$sid'
                                AND `done`=0");
        break;
        
        case 'progress_diet': 
          if (!empty($title) && !empty($quantity)) {
            $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_diet` 
                                  (`uid`, `sid`, `title`, `quantity`, `created`, `done`, `active`)
                                  VALUES ('$uid', '$sid', '$title', '$quantity', '$created', 0, 1)");
          }
          
          $query = mysql_query("SELECT SUM(`quantity`) AS t_quantity 
                                FROM `wesrom_routinie`.`progress_diet` 
                                WHERE `uid`='$uid' 
                                AND `sid`='$sid'
                                AND `done`=0 
                                AND `active`=1 
                                AND `title`='$title'");
          if ($query) {
            $row = mysql_fetch_array($query);
              $tot_quantity = $row['t_quantity'];
          }
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_diet` 
                                (`pid`, `uid`, `sid`, `title`, `quantity`, `created`, `done`, `active`)
                                VALUES (NULL, '$uid', '$sid', '$title', '$tot_quantity', '$created', 1, 1)");
          $result = mysql_query("UPDATE `wesrom_routinie`.`progress_diet` 
                                SET `done`=0, `active`=0
                                WHERE `title`='$title'
                                AND `uid`='$uid'
                                AND `sid`='$sid'
                                AND `done`=0");
        break;
        
        case 'progress_money': 
          if (!empty($title)) {
            $table_db = $_POST['table_db'];
            $result = mysql_query("INSERT INTO $table_db 
                                  (`pid`, `uid`, `sid`, `title`, `amount`, `currency`, `created`, `done`, `active`)
                                  VALUES (NULL, '$uid', '$sid', '$title', '$amount', '$currency', '$created', 0, 1)");
          }
          
          $query = mysql_query("SELECT SUM(`amount`) AS t_amount, `currency` 
                                FROM $table_db 
                                WHERE `uid`='$uid' 
                                AND `done`=0 
                                AND `sid`='$sid'
                                AND `active`=1 
                                AND `title`='$title'");
          if ($query) {
            $row = mysql_fetch_array($query);
              $tot_amount = $row['t_amount']; 
              $currency = $row['currency'];
          }
          $result = mysql_query("INSERT INTO $table_db
                                (`pid`, `uid`, `sid`, `title`, `amount`, `currency`, `created`, `done`, `active`)
                                VALUES (NULL, '$uid', '$sid', '$title', '$tot_amount', '$currency', '$created', 1, 1)");
          $result = mysql_query("UPDATE $table_db 
                                SET `done`=0, `active`=0
                                WHERE `title`='$title'
                                AND `uid`='$uid'
                                AND `sid`='$sid'
                                AND `done`=0");
        break;
        
        /* case 'progress_movement': 
          if (!empty($title) && !empty($km)) {
            $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_movement` 
                                  (`pid`, `uid`, `sid`, `title`, `km`, `time`, `created`, `done`, `active`)
                                  VALUES (NULL, '$uid', '$sid', '$title', '$km', '$nr_time', '$created', 0, 1)");
          }
          
          $query = mysql_query("SELECT SUM(`km`) AS t_km 
                                FROM `wesrom_routinie`.`progress_movement` 
                                WHERE `uid`='$uid'
                                AND `sid`='$sid'
                                AND `done`=0 
                                AND `active`=1 
                                AND `title`='$title'");
          if ($query) {
            $row = mysql_fetch_array($query);
              $tot_km = $row['t_km'];
          }
          $result = mysql_query("INSERT INTO `wesrom_routinie`.`progress_movement` 
                                (`pid`, `uid`, `sid`, `title`, `km`, `time`, `created`, `done`, `active`)
                                VALUES (NULL, '$uid', '$sid', '$title', '$tot_km', '$nr_time' '$created', 1, 1)");
          $result = mysql_query("UPDATE `wesrom_routinie`.`progress_movement` 
                                SET `done`=0, `active`=0
                                WHERE `title`='$title'
                                AND `sid`='$sid'
                                AND `uid`='$uid'
                                AND `done`=0");
        break; */
          
     }
  }
  header("Location: http://routinie.com/?page=$page");
 ?>
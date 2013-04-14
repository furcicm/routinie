<?php
  if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
?>
  <link rel="stylesheet" href="css/books.css" />
  <div id="title">Health - <?php echo ucfirst($subcategory_p); ?></div>
  
  <div id="add-progress">
    <div class="title">Add Progress</div>
    <div id="add-progress-subtitle-left">Title & Current Progress</div>
    <div id="add-progress-subtitle-right">Sleep time</div>
    
    
      <?php
        $uid = $_SESSION['uid'];
        $subcategory = array();
        $today_start = strtotime('today');
        $today_end = $today_start + 86399;
        $query = mysql_query("SELECT SUM(`time`) AS s_time
                              FROM progress
                              WHERE `uid`='$uid' 
                              AND `done`=0 
                              AND `active`=1
                              AND `created` > '$today_start'
                              AND `created` < '$today_end'
                              AND `sid`='$sid'");
        if ($query) {
          while ($row = mysql_fetch_array($query)) {
            $sleep_time = $row['s_time']; 
          }
          $sleep_hour = (int) ($sleep_time / 60);
          $sleep_min = $sleep_time - ($sleep_hour * 60);
          $sleep_min = strlen($sleep_min) == 1 && $sleep_min != 0 ? '0' . $sleep_min : $sleep_min;
        }
      ?>
          
            <div class="add-progress-row">
              <div class="progress-title">Today sleep</div>
              <div class="display-input-progress"><?php echo $sleep_hour . ' hours and ' . $sleep_min . ' minutes'; ?></div>
              <form class="add-progress-form" action="include/process_progress.php" method="POST" error=1>
                <div id="form-top">
                  <input type="text" name="time-hour" placeholder="Hours" autocomplete="off" class="new-input-hour-hob-vol_1" />
                  <input type="text" name="time-minutes" placeholder="Minutes" autocomplete="off" class="new-input-minutes-hob-vol_1"/>
                  <input type="submit" name="submit-add" value="Add" />
                  <input type="hidden" name="table" value="progress" />
                  <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
                  <input type="hidden" name="title" value="<?php echo $title; ?>" />
                  <input type="hidden" name="page" value="<?php echo $subcategory_p; ?>" />
                </div>
              </form>
             </div> 
  </div>
  
  
<?php
  }
  else {
    header("Status: 404 Not Found");
  }
?>
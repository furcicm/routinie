<?php
	if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
  $sid = $variables['sid'];
  $subcat_sg = $variables['subcat_sg'];
  $subcat_pl = $variables['subcat_pl'];
  $table = $variables['table'];
?>
	<link rel="stylesheet" href="css/books.css" />
	<div id="title">Lifestyle - <?php echo ucfirst($subcat_pl); ?></div>
	
	<div id="add-progress">
		<div class="title">Add Progress</div>
		<div id="add-progress-subtitle-left">Name & Current Progress</div>
		<div id="add-progress-subtitle-right">Add Progress</div>
		
		
			<?php
      $uid = $_SESSION['uid'];
        $hobbies = array();
        $query = mysql_query("SELECT `title`, SUM(`time`) AS s_time 
                              FROM $table  
                              WHERE `uid`='$uid' 
                              AND `done`=0 
                              AND `active`=1
                              AND `sid`='$sid'
                              GROUP BY `title`");
        if ($query) {
          while ($row = mysql_fetch_array($query)) {
            $title = ucfirst($row['title']);
            $time[$title] = $row['s_time'];
            if ($time[$title] >= 60) {
              $time_hour[$title] = floor($time[$title] / 60);
              $time[$title] -= $time_hour[$title] * 60;
            }
            if (!in_array($title, $hobbies)) {
              $hobbies[] = $title;
            }
          }
        }
        if ($hobbies) {
          $nr = 1;
          foreach($hobbies as $hobby_title) { ?>
            <div class="add-progress-row">
              <div class="progress-title"><?php echo $hobby_title; ?></div>
              <div class="display-input-progress">
              <?php 
                echo 'For '; 
                echo !empty($time_hour[$hobby_title])? ($time_hour[$hobby_title] > 1)? $time_hour[$hobby_title]  . ' hours ' : $time_hour[$hobby_title] . ' hour' : ''; 
                echo (!empty($time_hour[$hobby_title]) && !empty($time[$hobby_title])) ? ' and ' : '';
                echo !empty($time[$hobby_title])? ($time[$hobby_title] > 1)? $time[$hobby_title] . ' minutes' : $time[$hobby_title] . ' minute' : '';
                if (empty($time_hour[$hobby_title]) && empty($time[$hobby_title])){
                 echo '0 minute';
                }
              ?>
              </div>
              <form class="add-progress-form" action="include/process_progress.php" method="POST" error=<?php echo $nr;?> >
                <div id="form-top">
                  <input type="text" name="time-hour" placeholder="Hours" autocomplete="off" class="new-input-hour-hob-vol_<?php echo $nr;?>"/>
                  <input type="text" name="time-minutes" placeholder="Minutes" autocomplete="off" class="new-input-minutes-hob-vol_<?php echo $nr;?>"/>
                  <input type="submit" name="submit-done" value="Done!" />
                  <input type="submit" name="submit-add" value="Add" />
                  <input type="hidden" name="table" value="progress" />
                  <input type="hidden" name="table_db" value=<?php echo $table; ?> />
                  <input type="hidden" name="sid" value=<?php echo $sid; ?> />
                  <input type="hidden" name="title" value="<?php echo $hobby_title; ?>" />
                  <input type="hidden" name="page" value=<?php echo $subcat_pl; ?> />
                </div>
              </form>
             </div>
<?php       $nr++; 
          }
        }
        else {
          echo "<div class='progress-title'>First add a new $subcat_sg</div>";
          echo '<style>div#add-progress-subtitle-right{display:none;}</style>';
        }
?>    
		
	</div>
	
	<div id="add-new-progress">
		<div class="title">Add New <?php echo ucfirst($subcat_sg); ?></div>
    <div id="add-progress-subtitle-left">Title</div>
    <div class="music-random">Random ?</div>
		<form id="form-add-new-progress" action="include/process_progress.php" method="POST">
			<input id="add-progress-input" type="text" name="title" autocomplete="off" class="new-input-title"/>
			<select name="random" class="enterteinment-random progress3-random">
        <option value="">No</option>
        <option value="No specific <?php echo $subcat_sg; ?>">Yes</option>
      </select>
      <span id="float-right" class="width-fix">
				<input type="submit" name="submit-add" value="Add New" class="add-new margin-top-fix"/>
        <input type="hidden" name="table" value="progress" />
        <input type="hidden" name="table_db" value=<?php echo $table; ?> />
        <input type="hidden" name="sid" value=<?php echo $sid; ?> />
        <input type="hidden" name="page" value="<?php echo $subcat_pl; ?>" />
			</span>
		</form>
	</div>
	
	<div id="completed">
		<div class="title">Completed</div><div id="space"></div>
<?php 
    $empty = 1;
    $query = mysql_query("SELECT `title`, `time`
                          FROM $table  
                          WHERE `uid`='$uid' 
                          AND `done`=1
                          AND `active`=1
                          AND `sid`='$sid'
                          ORDER BY `created` DESC");
    if ($query) {    
       while ($row = mysql_fetch_array($query)) { $empty = 0; 
        $time = $row['time'];
        if ($time >= 60) {
          $time_hour = floor($time / 60);
          $time -= $time_hour * 60;
        }
       
       ?>
        <div class="row-completed">
          <div class="completed-title">
            <?php 
              echo $row['title'] . ' - for '; 
              echo !empty($time_hour)? ($time_hour > 1)? $time_hour  . ' hours ' : $time_hour . ' hour' : ''; 
              echo (!empty($time_hour) && !empty($time)) ? ' and ' : '';
              echo !empty($time)? ($time > 1)? $time . ' minutes' : $time . ' minute' : '';
              if (empty($time_hour) && empty($time)){
               echo '0 minute';
              }
             ?>
          </div>
          <div class="view-process">View Process</div>
        </div>
<?php }
    }
    if ($empty) {
      echo "<div class='row-completed'>You didn't add any $subcat_pl</div>";
    } ?>
	</div>
  
<?php
	}
	else {
		header("Status: 404 Not Found");
	}
?>
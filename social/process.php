<?php
	if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
?>
	
	<div id="title">Social - <?php echo ucfirst($subcategory_p); ?></div>
	
  <div id="add-new-progress" class="progress-title-social">
		<div class="title"><?php echo $title_add_new; ?></div>
    <div id="add-progress-subtitle-left">With whom</div>
    <div class="add-new-social-subtitle subtitle-social-time">How much</div>
		<div class="add-new-social-subtitle subtitle-social-place">Where</div>
		<form id="form-add-new-progress" action="include/process_progress.php" method="POST">
			<input type="text" name="social-whom" autocomplete="off" id="add-progress-input" class="input-social-whom"/>
			<span id="float-right">
				<input type="text" name="social-place" placeholder="Place" autocomplete="off" class="input-social-where"/>
				<input type="text" name="time" placeholder="Minutes" autocomplete="off" class="input-social-time"/>
				<input type="submit" name="submit-add" value="Add New" class="add-new"/>
        <input type="hidden" name="table" value="progress" />
        <input type="hidden" name="sid" value=<?php echo $sid; ?> />
        <input type="hidden" name="page" value=<?php echo $title; ?> />
			</span>
		</form>
	</div>

<div id="completed">
		<div class="title"><?php echo $title_completed; ?></div><div id="space"></div>
    <div class="completed-social-with">With</div>
    <div class="add-new-social-subtitle completed-social-time">How much</div>
		<div class="add-new-social-subtitle completed-social-where">Where</div>
		
<?php 
    $uid = $_SESSION['uid'];
    $empty = 1;
    $query = mysql_query("SELECT `title`, `time`
                          FROM progress  
                          WHERE `uid`='$uid' 
                          AND `done`=0
                          AND `active`=1
                          AND `sid`='$sid'
                          ORDER BY `created` DESC");
    if ($query) {
      while ($row = mysql_fetch_array($query)) { $empty = 0; 
        $time = $row['time'];
        $title = explode('+-+', $row['title']);
        $with = $title[0];
        $where = $title[1];
       
       ?>
        <div class="row-completed row-completed-social">
          <div class="completed-social-with-item">
            <?php echo $with; ?>
          </div>
            <div class="completed-social-time-item">
            <?php  
              echo !empty($time)? ($time > 1)? $time . ' minutes' : $time . ' minute' : '';
             ?>
            </div>
            <div class="completed-social-where-item">
              <?php echo $where; ?>
            </div>
            <div class="clearfix"></div>
        </div>
<?php }
      echo '<div class="clearfix"></div>';
    }
    if ($empty) {
      echo "<div class='row-completed'>You didn't added any record</div>";
      echo "<style>.completed-social-with, .completed-social-where, .completed-social-time {display:none;}</style>";
    } ?>
	</div>
  
<?php
	}
	else {
		header("Status: 404 Not Found");
	}
?>
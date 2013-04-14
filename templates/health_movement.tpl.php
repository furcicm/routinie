<?php
	if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
?>
	<link rel="stylesheet" href="css/books.css" />
	<div id="title">Health - <?php echo ucfirst($variables['subcat_pl']); ?></div>
	
	<div id="add-progress">
		<div class="title">Add Progress</div>
		<div id="add-progress-subtitle-left">Title & Current Progress</div>
		<div id="add-progress-subtitle-right">Add Progress</div>
		
		
			<?php
        $uid = $_SESSION['uid'];
        $sid = $variables['sid'];
        $table = $variables['table'];
        $title = $variables['title'];
        $subcategory = array();
        $query = mysql_query("SELECT `title`, SUM(`distance`) AS s_km, SUM(`time`) AS s_time
                              FROM $table   
                              WHERE `uid`='$uid' 
                              AND `done`=0 
                              AND `active`=1
                              AND `sid`='$sid'
                              GROUP BY `title`");
        if ($query) {
          while ($row = mysql_fetch_array($query)) {
            //$title = ucfirst($row['title']);
            $km[$title] = $row['s_km'];
            $time[$title] = $row['s_time'];
            
          }
          
        }
      ?>
          
            <div class="add-progress-row">
              <div class="progress-title"><?php echo ucfirst($title); ?></div>
              <div class="display-input-progress"><?php echo isset($km[$title])? round($km[$title], 2) : '0'; echo ' km in '; echo isset($time[$title])? $time[$title] : '0'; echo ' minutes';?></div>
              <form class="add-progress-form" action="include/process_progress.php" method="POST">
                <div id="form-top">
                  <input type="text" name="km" placeholder="Km" autocomplete="off" class="new-input-km" />
                  <input type="text" name="time" placeholder="Minutes" autocomplete="off" class="new-input-time-movement"/>
                  <input type="submit" name="submit-add" value="Add" />
                  <input type="hidden" name="table" value="progress_movement" />
                  <input type="hidden" name="table_db" value="<?php echo $table; ?>" />
                  <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
                  <input type="hidden" name="title" value="<?php echo $title; ?>" />
                  <input type="hidden" name="page" value="<?php echo $variables['subcat_pl']; ?>" />
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
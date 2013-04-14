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
        $subcategory = array();
        $query = mysql_query("SELECT `title`, SUM(`time`) AS s_time, SUM(`game`) AS s_games
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
            $games[$title] = $row['s_games'];
            if ($time[$title] >= 1440) {
              $days[$title] = floor($time[$title] / 1440);
              $time[$title] -= $days[$title] * 1440;
            }
           
            if ($time[$title] >= 60) {
              $hours[$title] = floor($time[$title] / 60);
            }
            
            if (!in_array($title, $subcategory)) {
              $subcategory[] = $title;
            }
          }
          
        }
        
        if ($subcategory) {
          $nr = 1;
          foreach($subcategory as $subcategory_title) {  ?>
          
            <div class="add-progress-row">
              <div class="progress-title"><?php echo $subcategory_title; ?></div>
              <div class="display-input-progress"><?php echo isset($games[$subcategory_title])? $games[$subcategory_title] . ' Games in ' : ''; echo isset($hours[$subcategory_title])? $hours[$subcategory_title] . (($hours[$subcategory_title]>1)? ' hours ' : ' hour ') : '0 minute'; ?></div>
              <form class="add-progress-form" action="include/process_progress.php" method="POST" error=<?php echo $nr;?> >
                <div id="form-top">
                  <input type="text" name="games" placeholder="Games" autocomplete="off" class="new-input-games_<?php echo $nr;?>"/>
                  <input type="text" name="time-hour" placeholder="Hour" autocomplete="off" class="new-input-time-hour_<?php echo $nr;?>"/>
                  <input type="submit" name="submit-done" value="Done!" />
                  <input type="submit" name="submit-add" value="Add" />
                  <input type="hidden" name="table" value="<?php echo $table; ?>" />
                  <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
                  <input type="hidden" name="title" value="<?php echo $subcategory_title; ?>" />
                  <input type="hidden" name="page" value="<?php echo $variables['subcat_pl']; ?>" />
                </div>
              </form>
             </div>
<?php       $nr++; 
          }
        }
        else {
          echo '<div class="progress-title">First add a new ' . $variables['subcat_sg'] . '</div>';
          echo '<style>div#add-progress-subtitle-right{display:none;}</style>';
        }
?>    
		
	</div>
	
	<div id="add-new-progress">
		<div class="title">Add New <?php echo ucfirst($variables['subcat_sg']); ?></div>
    <div id="add-progress-subtitle-left">Title</div>
		<form id="form-add-new-progress" action="include/process_progress.php" method="POST">
			<input id="add-progress-input" type="text" name="title" autocomplete="off" class="new-input-title"/>
			<span id="float-right">
				<input type="submit" name="submit-add" value="Add New" class="add-new"/>
        <input type="hidden" name="table" value="<?php echo $table; ?>" />
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="page" value="<?php echo $variables['subcat_pl']; ?>" />
			</span>
		</form>
	</div>
	
	<div id="completed">
		<div class="title">Completed</div><div id="space"></div>
<?php 
    $empty = 1;
    $query = mysql_query("SELECT `title`, `time`, `game`  
                          FROM $table   
                          WHERE `uid`='$uid' 
                          AND `done`=1
                          AND `active`=1
                          AND `sid`='$sid'
                          ORDER BY `created` DESC");
    if ($query) {    
       while ($row = mysql_fetch_array($query)) { 
        $empty = 0; 
        $title = ucfirst($row['title']);
        $time[$title] = $row['time'];
        $games[$title] = $row['game'];
        if ($time[$title] >= 1440) {
              $days[$title] = floor($time[$title] / 1440);
              $time[$title] -= $days[$title] * 1440;
        }
        if ($time[$title] >= 60) {
          $hours[$title] = floor($time[$title] / 60);
        }
       
       ?>
        <div class="row-completed">
          <div class="completed-title"><?php echo "\"" . $title . "\" - "; echo isset($games[$title])? ($games[$title] . (($games[$title] > 1)? ' games ' : ' game ')) : ''; echo isset($hours[$title])? $hours[$title] . ' in ' .(($hours[$title]>1)? ' hours ' : ' hour ') : ''; ?></div>
          <div class="view-process">View Process</div>
        </div>
<?php }
    }
    if ($empty) {
      echo "<div class='row-completed'>You haven't finished any" . $variables['subcat_sg'] . "</div>";
    } ?>
	</div>
  
<?php
	}
	else {
		header("Status: 404 Not Found");
	}
?>
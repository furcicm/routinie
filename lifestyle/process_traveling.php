<?php
	if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
?>
   <script>
    $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1d",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to" ).datepicker({
            defaultDate: "+2d",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
    </script>
	  <div id="title">Lifestyle - <?php echo  ucfirst($subcategory_p);  ?></div> 
	
	<div id="add-new-progress" class="add-new-progress-traveling">
		<div class="title">Add Visited Destination </div>
    <div id="add-progress-subtitle-left" class="subtitle-place">Continent</div>
    <div class="subtitle-place">Country</div>
    <div class="subtitle-place">Place</div>
    <div id="add-progress-subtitle-right">Period</div>
		<form id="form-add-new-progress" action="include/process_progress.php" method="POST">
			<input type="text" name="title-continent" autocomplete="off" class="new-input-title-continent add-progress-input"/>
			<input type="text" name="title-country" autocomplete="off" class="new-input-title-country add-progress-input"/>
      <input type="text" name="title-place" autocomplete="off" class="new-input-title-place add-progress-input"/>
      
      <span id="float-right">
        <input id="from"  type="text" name="travel-start" autocomplete="off" class="new-input-travel-start" placeholder="Start"/>
        <input id="to"  type="text" name="travel-end" autocomplete="off" class="new-input-travel-end" placeholder="End"/>
				<input type="submit" name="submit-add" value="Add New" class="add-new"/>
        <input type="hidden" name="table" value="progress" />
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="page" value="<?php echo $subcategory_p; ?>" />
			</span>
		</form>
	</div>
	
	<div id="completed">
		<div class="title">Completed</div><div id="space"></div>
    <div id="add-progress-subtitle-left" class="subtitle-place completed-continent">Continent</div>
    <div class="subtitle-place completed-country ">Country</div>
    <div class="subtitle-place completed-place">Place</div>
    <div class="completed-period">Period</div>
<?php 
    $empty = 1;
    $uid = $_SESSION['uid'];
    $query = mysql_query("SELECT `title`, `time`  
                          FROM progress   
                          WHERE `uid`='$uid' 
                          AND `done`=0
                          AND `active`=1
                          AND `sid`='$sid'
                          ORDER BY `created` DESC");
    if ($query) {
       while ($row = mysql_fetch_array($query)) { 
        $empty = 0; 
        $title = $row['title'];
        $title_array = explode('-', $row['title']);
        $title_continent[$title] = ucfirst($title_array[0]);
        $title_country[$title] = ucfirst($title_array[1]);
        $title_place[$title] = ucfirst($title_array[2]);
        $time[$title] = $row['time'] / 60;
        if ($time[$title] >= 1440) {
              $days[$title] = floor($time[$title] / 1440);
              $time[$title] -= $days[$title] * 1440;
        }
        if ($time[$title] >= 60) {
          $hours[$title] = floor($time[$title] / 60);
        }
       
       ?>
        <div class="row-completed completed-traveling">
          <div class="completed-title-traveling completed-continent"><?php echo ($title_continent[$title] != '#null')? $title_continent[$title]: '-' ?></div>
          <div class="completed-title-traveling completed-country"><?php echo ($title_country[$title] != '#null')? $title_country[$title]: '-' ?></div>
          <div class="completed-title-traveling completed-place"><?php echo ($title_place[$title] != '#null')? $title_place[$title]: '-' ?></div>
          <div class="completed-title-traveling completed-period"><?php echo isset($days[$title])? $days[$title] . (($days[$title]>1)? ' days ' : ' day ') :  '';  ?></div>
          <div class="clearfix"></div>
        </div>
<?php }
    }
    if ($empty) {
      echo "<div class='row-completed'>You haven't added any $subcategory_s</div>
            <style> .completed-continent, .completed-country, .completed-place, .completed-period {display: none;} </style>";
    } ?>
    <div class="clearfix"></div>
	</div>
  
<?php
	}
	else {
		header("Status: 404 Not Found");
	}
?>
<?php
	if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
  $sid = $variables['sid'];
  $table = $variables['table'];
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
	  <div id="title">Lifestyle - <?php echo  ucfirst($variables['subcat_pl']);  ?></div> 
	
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
        <input type="hidden" name="table" value="<?php echo $table; ?>" />
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="page" value="<?php echo $variables['subcat_pl']; ?>" />
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
    $query = mysql_query("SELECT continent, country, place, start, end  
                          FROM $table   
                          WHERE `uid`='$uid' 
                          AND `done`=0
                          AND `active`=1
                          AND `sid`='$sid'
                          ORDER BY `created` DESC");
    $nr = 0;
    if ($query) {
       while ($row = mysql_fetch_array($query)) { 
        $empty = 0; 
        $title_continent[$nr] = ucfirst($row['continent']);
        $title_country[$nr] = ucfirst($row['country']);
        $title_place[$nr] = ucfirst($row['place']);
        $start[$nr] = $row['start'];
        $end[$nr] = $row['end'];
        $time[$nr] = ($end[$nr] - $start[$nr]) / 60;;
        if ($time[$nr] >= 1440) {
              $days[$nr] = floor($time[$nr] / 1440);
              $time[$nr] -= $days[$nr] * 1440;
        }
        if ($time[$nr] >= 60) {
          $hours[$nr] = floor($time[$nr] / 60);
        }
       
       ?>
        <div class="row-completed completed-traveling">
          <div class="completed-title-traveling completed-continent"><?php echo ($title_continent[$nr] != '#null')? $title_continent[$nr]: '-' ?></div>
          <div class="completed-title-traveling completed-country"><?php echo ($title_country[$nr] != '#null')? $title_country[$nr]: '-' ?></div>
          <div class="completed-title-traveling completed-place"><?php echo ($title_place[$nr] != '#null')? $title_place[$nr]: '-' ?></div>
          <div class="completed-title-traveling completed-period"><?php echo isset($days[$nr])? $days[$nr] . (($days[$nr]>1)? ' days ' : ' day ') :  '';  ?></div>
          <div class="clearfix"></div>
        </div>
<?php $nr++; }
    }
    if ($empty) {
      echo "<div class='row-completed'>You haven't added any " . $variables['subcat_sg'] . "</div>
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
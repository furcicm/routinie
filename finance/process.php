<?php
	if (!strpos($_SERVER['REQUEST_URI'], $_GET['page'] . '.php')) {
  include_once('include/connect_db.php');
?>
	<link rel="stylesheet" href="css/books.css" />
	<div id="title">Finance - <?php echo ucfirst($page); ?></div>
	
	<div id="add-progress">
		<div class="title">Add Progress</div>
		<div id="add-progress-subtitle-left">Name & Current Progress</div>
		
		
			<?php
      $uid = $_SESSION['uid'];
        $names = array();
        $query = mysql_query("SELECT `title`, SUM(`amount`) AS s_amount, currency 
                              FROM progress_money   
                              WHERE `uid`='$uid' 
                              AND `done`=0 
                              AND `active`=1
                              AND `sid`='$sid'
                              GROUP BY `title`");
        if ($query) {
          while ($row = mysql_fetch_array($query)) {
            $title = ucfirst($row['title']);
            $amount[$title] = $row['s_amount'];
            $currency[$title] = $row['currency'];
            if (!in_array($title, $names)) {
              $names[] = $title;
            }
          }
        }
        if ($names) {
          $nr = 1;
          foreach($names as $name_title) { ?>
            <div class="add-progress-row">
              <div class="progress-title"><?php echo $name_title; ?></div>
              <div class="display-input-progress"><?php echo $method . ' ' . $amount[$name_title] . ' ' . $currency[$name_title]; ?></div>
              <form class="add-progress-form" action="include/process_progress.php" method="POST" error=<?php echo $nr;?> >
                <div id="form-top">
                  <input type="text" name="amount" placeholder="Amount (<?php echo $currency[$name_title]; ?>)" autocomplete="off" class="new-input-pages_<?php echo $nr;?>"/>
                  <input type="hidden" name="currency" value=<?php echo $currency[$name_title]; ?> />
                  <input type="submit" name="submit-done" value="Done!" />
                  <input type="submit" name="submit-add" value="Add" />
                  <input type="hidden" name="table" value="progress_money" />
                  <input type="hidden" name="sid" value=<?php echo $sid; ?> />
                  <input type="hidden" name="title" value="<?php echo $name_title; ?>" />
                  <input type="hidden" name="page" value=<?php echo $page; ?> />
                </div>
              </form>
             </div>
<?php       $nr++; 
          }
        }
        else {
          echo '<div class="progress-title">First add new ' . $page . '</div>';
          echo '<style>div#add-progress-subtitle-right{display:none;}</style>';
        }
?>    
		
	</div>
	
	<div id="add-new-progress">
		<div class="title">Add New <?php echo ucfirst($page); ?></div>
    <div id="add-progress-subtitle-left">Name</div>
    <div class="currency-money-title random-title">Currency</div>
    <div class="random-money-title random-title">Random?</div>

		<form id="form-add-new-progress" action="include/process_progress.php" method="POST">
			<input id="add-progress-input" type="text" name="title" autocomplete="off" class="new-input-title"/>
			<span id="float-right">
        <select name="random" class="progress3-random enterteinment-random">
          <option value="">No</option>
          <option value="No specific <?php echo $subcategory_s; ?>">Yes</option>
        </select>	
        <select name="currency" class="progress4-random money-random">
          <option value="euro">EUR</option>
          <option value="dollars">USD</option>
          <option value="ron">RON</option>
        </select>
				<input type="submit" name="submit-add" value="Add New" class="add-new"/>
        <input type="hidden" name="table" value="progress_money" />
        <input type="hidden" name="sid" value=<?php echo $sid; ?> />
        <input type="hidden" name="page" value=<?php echo $page; ?> />
			</span>
		</form>
	</div>
	
	<div id="completed">
		<div class="title">Completed</div><div id="space"></div>
<?php 
    $empty = 1;
    $query = mysql_query("SELECT `title`, `amount`, `currency` 
                          FROM progress_money   
                          WHERE `uid`='$uid' 
                          AND `done`=1
                          AND `active`=1
                          AND `sid`='$sid'
                          ORDER BY `created` DESC");
    if ($query) {    
       while ($row = mysql_fetch_array($query)) { $empty = 0; ?>
        <div class="row-completed">
          <div class="completed-title"><?php echo $row['title'] . ' - ' . $row['amount'] . ' ' . $row['currency'];?></div>
          <div class="view-process">View Process</div>
        </div>
<?php }
    }
    if ($empty) {
      echo "<div class='row-completed'>You didn't added any $subcategory_s</div>";
    } ?>
	</div>
  
<?php
	}
	else {
		header("Status: 404 Not Found");
	}
?>
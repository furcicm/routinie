<?php
  @session_start();
  $uid = $_SESSION['uid'];
  include_once('inc/get_progress.php.inc');
  $all_progress = get_all_progress_info_by_user($uid); 
?>
<link rel="stylesheet" href="../css/fontello/css/fontello.css" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/progress.js"></script>
<?php 
// $_SESSION['message'] = 'Progress is under maintenance, please visit later!';
            if (!empty($_SESSION['message'])) {
               echo "<div class='main-message'>{$_SESSION['message']}</div>";
               unset($_SESSION['message']);
            }
  ?>
<div class="title title-progress">My Routinie</div>
<div id="progress-chart-container">
  <p>Your routinie is formed of a chart that shows what activities you have</p>
  <ul class="progress-chart-menu">
    <li class="progress-day">Day</li>
    <li class="progress-week">Week</li>
    <li class="progress-date"><input id="select-progress-date"  type="text" name="progress-date" autocomplete="off" class="progress-date" placeholder="Date"/></li>
  </ul>
  <p>Activity List for <span id="placeholder-for-date"></span></p>
  <div id="chart-legend-container"></div>
  <br style="clear:both;font-size:0;line-height:0;height:0;" />
  <div id="chart_div" class="day"></div>
  <div id="chart_div2" class="week"></div>
</div>
<div class="title title-progress">My Timeline</div>
<div id="timeline-container">
  <p>Your routinie is formed of a chart that shows what activities you have</p>
  <div class="timeline-dropdown-container">
      <select class="timeline-dropdown-item timeline-dropdown-item-freq">
        <option>Daily</option>
        <option>Weekly</option>
      </select>
      <select class="timeline-dropdown-item timeline-dropdown-item-category">
        <option>Category</option>
        <option value=1>Education</option>
        <option value=2>Business</option>
        <option value=3>Health</option>
        <option value=4>Lifestyle</option>
        <option value=5>Social</option>
        <option value=6>Entertainment</option>
        <option value=7>Finance</option>
      </select>
      <select class="timeline-dropdown-item timeline-dropdown-item-subcategory">
        <option>Subcategory</option>
      </select>
  </div>
  <div id="chart-timeline" class="timeline"></div>
</div>

<div class="title title-progress">My Plans</div>
<div id="plans-container">
  <p>Here you can find detailed information regarding the plans ypu have created for yourself using the Specific planner</p>
  <?php foreach($all_progress as $cat => $subcat): ?>
    <div class="plans-category"><?php echo ucfirst($cat);?></div>
    <?php foreach($subcat as $sid => $name): ?>

      <?php $progress = get_progress_info($sid, $uid); ?>
      <?php $data = get_current_planner_progress($sid, $uid); ?>
      <div class="plans-subcategory-item" sid=<?php echo $sid;?>>
        <span class="progress-horizontal-line"><hr /></span>
        <div class="plans-subcategory"><?php echo ucfirst($name); ?></div>
        <div class="plans-last-progress">Last progress added : <?php echo $progress['last_created']; ?> </div>
        <div class="plans-total-progress">Total progress</div>
        <div class="plans-total-progress-data"><?php echo $progress['data']; ?></div>
        <div class="plans-current-plan">Current Plan</div>
        <div class="plans-current-plan-data"><?php echo $data['current_plan']; ?></div>
        <?php foreach($data['nr_plan'] as $key => $plan):  ?>
          <div class="plans-progress-bar progress-bar-<?php echo $plan; ?>">
            <div class="plans-current-progress-bar current-progress-bar-<?php echo $plan; ?>"></div>
<!--             <div class="icon-right-open-big first"></div>
            <div class="icon-right-open-big center "></div>
            <div class="icon-right-open-big last"></div> -->
          </div>
        <?php endforeach; ?>
        <div class="plans-progress-status">
          Progress Status
          <div class="plans-progress-status-data"></div>
        </div>
        <div class="plans-progress-advice">Some advice</div>
      </div>
    <?php endforeach; //End subcategory ?>
  <?php endforeach; //End category ?>
</div>





<!-- <div id="progress-planner-container">
  <div id="progressbar-container">
    <span class="progress-text">0%</span>
    <div id="progress"></div>
  </div>
  <select id="progress-select-subcat">
    <option value="0">Select one</option>
    <?php 
      /*foreach ($subcats_select as $sid => $name) {
        echo "<option value=" . $sid . ">" . $name . "</option>";
      } */
    ?>
  </select>
</div> -->

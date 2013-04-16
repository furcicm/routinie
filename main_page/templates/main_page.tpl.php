<script type='text/javascript' src="js/main_progress.js"></script>
<div class="title title-progress">My Routinie</div>
<div id="progress-chart-container">
	  <p>Your routinie is formed of a chart that shows what activities you have</p>
	  <ul class="progress-chart-menu">
	    <li class="progress-day">Day</li>
	    <li class="progress-week">Week</li>
	    <li class="progress-date"><input id="select-progress-date" class="progress-date" /></li>
	  </ul>
	  <p>Activity List for <span id="placeholder-for-date"></span></p>
	  <div id="chart-legend-container"></div>
	  <br style="clear:both;font-size:0;line-height:0;height:0;" />
	  <div id="chart_div" class="day"></div>
	  <div id="chart_div2" class="week"></div>
</div>
<div class="title title-progress">My Progress</div>
<div id="progress-planner-container">
	<?php $nr = 1; foreach($progress as $subcategory => $values): ?>
		<?php foreach ($values as $field => $value): ?>
			<div class="progress-planner-column-<?php echo $nr; ?>"><?php echo ucfirst($subcategory) . ' - ' . ucfirst($field) . '</br>';  echo $value['value']; ?></div>
			<?php $nr = $nr == 2 ? 1 : 2; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<div class="clearfix"></div>
</div>



(function($){
	// Document ready.
	$(document).ready(function(){

		var chartContainer = $('#progress-chart-container');
		var chartLegContainer = $('#chart-legend-container');
    $('#placeholder-for-date').html('today');

		chartContainer.find('.day').show();
		chartContainer.attr('active', 'day');
		// chartContainer.find('.progress-day').css({'background':'rgb(144, 214, 241)'});
		drawChart('today');
		drawChart2('today');
    drawTimeline();
		
		chartContainer.find('.progress-day, .progress-week').click(displayChart);
		
    $('#timeline-container').find('.timeline-dropdown-item-category').change(function(){
      var cat = $(this).val();
      $('#timeline-container').find('.timeline-dropdown-item-subcategory').html('');
      var subcategory = $.ajax({
        url: "scripts/get_list_of_subcategory.php",
        dataType:"json",
        type: 'POST',
        data: 'cat=' + cat,
        async: false,
        success: function(data){}
      }).responseText;
      subcategory = $.parseJSON(subcategory);
      var $subcat = $('#timeline-container').find('.timeline-dropdown-item-subcategory');
      $subcat.append('<option>Subcategory</option>');
      $.each(subcategory, function(i,v){
        var $option = $('<option></option').val(i).html(v).data('subcat', v);
        $subcat.append($option);
        // output += '<option value="' + i + '">' + v + '</option>';
      });
      // .append(output);
    });

    $('#timeline-container').find('.timeline-dropdown-item-subcategory').change(function(){
      var freq = $('#timeline-container').find('.timeline-dropdown-item-freq').val();
      var sid = $(this).val();
      var data = $.ajax({
        url: "progress/get_data_timeline.php",
        dataType:"json",
        type: 'POST',
        data: {'sid': sid, 'freq': freq},
        async: false,
        success: function(data){}
      }).responseText;
      console.log(data);
      var name = $(this).find('option[value='+sid+']').data('subcat');

      title = $.parseJSON(data)['title'];
      data = $.parseJSON(data)['data'];

      drawTimeline(data, name, title);

    });


		$( "#select-progress-date" ).datepicker({
    	defaultDate: "-1d",
    	changeMonth: true,
     	dateFormat: 'dd-mm-yy',
     	numberOfMonths: 1,
    });

	  $('#select-progress-date').change(function(){
      var t = chartContainer.attr('active');
      if (t == 'week') {
        date = (getCustomDate('week') == 'this week') ? 'this week' : 'the week ( ' + getCustomDate('week') + ' )';
      }
      else {
        date = getCustomDate('day') == 'today' ? 'today' : 'the date ' + getCustomDate('day');
      }
      $('#placeholder-for-date').html(date);
	   	chartLegContainer.find('ul').remove();
	    drawChart($(this).val());
	    drawChart2($(this).val());
    });
   

	});

  $(window).load(function(){
     $('#plans-container').find('.plans-subcategory-item').each(function(){
      var sid = $(this).attr('sid');
      displayProgressPlan(sid);
    });
  });

	var listOfColors = ['maroon', 'saddlebrown', 'magenta', 'olive', 'coral', 'lightseagreen', 'royalblue', 'dimgray',  'blue', 'mediumslateblue'];

	var displayChart = function () {
		var chart = $(this).html();
		var chartContainer = $('#progress-chart-container');
		var chartLegContainer = $('#chart-legend-container');
		chartContainer.attr('active', chart.toLowerCase());
		if (chart == 'Day') {
      date = getCustomDate('day') == 'today' ? 'today' : 'the date ' + getCustomDate('day');
      $('#placeholder-for-date').html(date);
			//chartContainer.find('.progress-day').css({'background':'rgb(144, 214, 241)'});
			//chartContainer.find('.progress-week').css({'background':'none'});
			chartLegContainer.find('.chart-legend-day').show();
			chartContainer.find('.day').show();
			chartLegContainer.find('.chart-legend-week').hide();
			chartContainer.find('.week').hide();
      $('#placeholder-for-date').html(date);
		}
		else if (chart == 'Week') {
      date = (getCustomDate('week') == 'this week') ? 'this week' : 'the week ( ' + getCustomDate('week') + ' )';
      $('#placeholder-for-date').html(date);
			//chartContainer.find('.progress-day').css({'background':'none'});
			//chartContainer.find('.progress-week').css({'background':'rgb(144, 214, 241)'});
			chartLegContainer.find('.chart-legend-day').hide();
			chartContainer.find('.day').hide();
			chartLegContainer.find('.chart-legend-week').show();
			chartContainer.find('.week').show();
		}
	
	}

	// Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
 	google.setOnLoadCallback(drawChart);
 	google.setOnLoadCallback(drawChart2);
  
 	var drawChart = function(date) {
   	
   	if (date.length != 10) {
    	date = 'Today';
   	}
    
    var jsonData = $.ajax({
      url: "progress/getData.php",
      dataType:"json",
      type: 'POST',
      data: 'date_day=' + date,
      async: false,
      success: function(data){}
    }).responseText;

    if (jsonData != '"error"') { 

      getLegend(jsonData, 'day');

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

      chart.draw(data, {
      	'legend' : 'none', 
      	// title    : date, 
      	width		 : 400, 
      	height   : 350, 
      	colors   : listOfColors
      });
    }
    else {
      $('#chart_div').html('No data available');
    }
  }

  var drawChart2 = function(date) {
   
    if (date.length != 10) {
      date = 'Today';
    }
   
    var jsonData2 = $.ajax({
      url: "progress/getData.php",
      dataType:"json",
      type: 'POST',
      data: 'date_week='+date ,
      async: false,
      success: function(data){}
    }).responseText;   
   
    if (jsonData2 != '"error"') {

      getLegend(jsonData2, 'week'); 

      // Create our data table out of JSON data loaded from server.
      var data2 = new google.visualization.DataTable(jsonData2);

      // Instantiate and draw our chart, passing in some options.
      var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));

      chart2.draw(data2, {
      	// title:"Week corresponding to " + date, 
      	width: 400, 
      	height: 350, 
      	'legend' : 'none', 
      	colors : listOfColors
      });
    
    }
    else {
      $('#chart_div2').html('No data available');
    }
  }

  function drawTimeline(data1, name, title) {
    if (!data1) {
      data1 = [
        ['Name', 'None'],
        ['1', 0],
        ['2', 0],
        ['3', 0],
        ['4', 0],
      ];
    } 
    else {

      data1.unshift(['Subcategory', name]);

    }

    var data = google.visualization.arrayToDataTable(data1);

    var options = {
      title: title,
      width: 900, 
      height: 350, 
      animation:{
        duration: 5000,
        easing: 'inAndOut',
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart-timeline'));
    chart.draw(data, options);
  }
 
	var getLegend = function(data, type) {
	  var legend = $.parseJSON(data)['legend'];
	  var color = $.parseJSON(data)['colors'];

	  var colorLi = $('<ul class="chart-legend-color chart-legend-' + type + '"></ul>');
	  var ul = $('<ul class="chart-legend-name chart-legend-' + type + '"></ul>');
	  var ul2 = $('<ul class="chart-legend-value chart-legend-' + type + '"></ul>');

	  $.each(legend, function(k, v){
	    $('<li><div style="background : ' + color[k] + '"></div></li>').appendTo(colorLi);
	    $('<li>' + k + '</li>').appendTo(ul);
	    $('<li>' + v + ' hrs</li>').appendTo(ul2);
	  });


	  var active = $('#progress-chart-container').attr('active');

	  $('#chart-legend-container').append(colorLi).append(ul2).append(ul);
    if (colorLi.hasClass('chart-legend-' + active)) {
      colorLi.show();
      ul.show();
      ul2.show();
    }
	}

	var displayProgressPlan = function(sid) {
		var progress = $.ajax({
      url: "progress/get_progress.php",
      dataType:"json",
      type: 'POST',
      data: 'sid=' + sid ,
      async: false,
      success: function(data){}
    }).responseText;
    var data = $.parseJSON(progress),
    plan = data.plan,
    progress = data.progress;
    console.log(data);
    // console.log(plan);
    // console.log(progress);
    var progressData, planData, totalProgress;
    $.each(plan, function(k, v){
      planData = typeof v == 'undefined'? 0 : v;
      if (progress != null) {
        progressData = typeof progress[k] == 'undefined'? 0 : progress[k];  
      }
      else {
        progressData = 0;
      }
      if (progressData == 0) {
        totalProgress = 0;
      }
      else {
        totalProgress = Math.floor((((100 * progressData) / planData) > 100 ? 100 : (100 * progressData) / planData) * 100) / 100;
      }
      console.log(sid);
      console.log(planData);
      console.log(progressData);
      console.log(totalProgress);
      var $item = $('#plans-container').find('.plans-subcategory-item[sid="' + sid + '"]').each(function(){
        var $progressTarget = $(this).find('.plans-progress-bar');
        if ($progressTarget.hasClass('progress-bar-'+k)) {
          $progressTarget.find('.current-progress-bar-'+k).css('width',totalProgress + '%');
          $(this).find('.plans-progress-status-data').append(ucfirst(k) + ' : ' + totalProgress + '%' + '  (' + progressData + '/' + planData + ')<br />');
        }
      });
    });
    return false;
    /*var time = $.parseJSON(progress); 
    var time_plan = time['time_plan'];
    var time_progress = time['time_progress'];
    var result = parseInt(time_progress * 100 / time_plan);
    var result_text = '';

    if (result > 100) {
      result = 100;
      result_text = '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bravo ba! :)';
    }

    $('#progress').css('width', result + '%');
    $('#progressbar-container').find('.progress-text').html(result+'%');
    $('#progress-select-subcat').after('<div>' + result_text + '</div>');*/
	}

  var getCustomDate = function(type) {
    var date = $('#select-progress-date').val();
    if (date) {
      var tmp = date.split('-');
      date = tmp[1] + '-' + tmp[0] + '-' + tmp[2];
      var curr = new Date(date); // get current date
      var nrDay = curr.getUTCDay();
      var first = curr.getUTCDate() - nrDay + 1; // First day is the day of the month - the day of the week
      var last = first + 6; // last day is the first day + 6
      var currDay = ((curr.getDate().toString().length == 1) ? '0' + curr.getDate() : curr.getDate()) + '.' + 
             (((curr.getMonth() + 1).toString().length == 1) ? '0' + (curr.getMonth() + 1) : (curr.getMonth() + 1)) + '.' + 
             curr.getFullYear();
      var firstday = new Date(curr.setDate(first));
      var lastday = new Date(curr.setDate(last));
      var weekStart = ((firstday.getDate().toString().length == 1) ? '0' + firstday.getDate() : firstday.getDate()) + '.' + 
             (((firstday.getMonth() + 1).toString().length == 1) ? '0' + (firstday.getMonth() + 1) : (firstday.getMonth() + 1)) + '.' + 
             firstday.getFullYear();
      var weekEnd = ((lastday.getDate().toString().length == 1) ? '0' + lastday.getDate() : lastday.getDate()) + '.' + 
             (((lastday.getMonth() + 1).toString().length == 1) ? '0' + (lastday.getMonth() + 1) : (lastday.getMonth() + 1)) + '.' + 
             lastday.getFullYear();
      if (type == 'day') {
        return currDay;
      }
      if (type == 'week') {
        return weekStart + ' - ' + weekEnd;
      }
    }
    else if(type == 'day') {
      return'today';
    }
    else if(type == 'week') {
      return 'this week';
    }
  }

  var ucfirst = function(string)
  {
      return string.charAt(0).toUpperCase() + string.slice(1);
  }

})(jQuery);


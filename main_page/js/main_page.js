(function($){
	var
		init = function() {
			var active = $('#left-sidebar').attr('active');
			$('#left-sidebar').find('a[href="?cat=' + active + '"]')
												.find('li')
												.addClass('subcategory-active');
		};

	
	// Document ready.
	$(document).ready(function(){

		init();
                		/*var chartContainer = $('#progress-chart-container');
                		var chartLegContainer = $('#chart-legend-container');
                    $('#placeholder-for-date').html('today');

                		chartContainer.find('.day').show();
                		chartContainer.attr('active', 'day');
                		// chartContainer.find('.progress-day').css({'background':'rgb(144, 214, 241)'});
                		drawChart('today');
                		drawChart2('today');
                    // drawTimeline();
                		
                		chartContainer.find('.progress-day, .progress-week').click(displayChart);*/
		
   /* $('#timeline-container').find('.timeline-dropdown-item-category').change(function(){
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
*/
   /* $('#timeline-container').find('.timeline-dropdown-item-subcategory').change(function(){
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

    });*/


            		/*$( "#select-progress-date" ).datepicker({
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
                });*/

    $('#content-header').find('li').click(function(){
      var subcat = $(this).html().toLowerCase();
      var url = $(location).attr('href').split('&');
      console.log(url[0]);
      window.location.href = url[0] + '&subcat=' + subcat;
    });
   

	});

  /*$(window).load(function(){
     $('#plans-container').find('.plans-subcategory-item').each(function(){
      var sid = $(this).attr('sid');
      displayProgressPlan(sid);
    });
  });*/

})(jQuery);
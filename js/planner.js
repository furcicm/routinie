jQuery(function ($) {

	$('.lightbox-ok').click(function(){
		var year = $('input.lightbox-input-years').val();
		if (year && $.isNumeric(year) && year > 0) {
			document.cookie = "planner_year=" + year;
			$('.year').html(year);
			$("#lightbox, #lightbox-panel").fadeOut(300);
			window.location.replace("/?q=general-planner/health");
		}
	});
	if (document.cookie.indexOf('planner_year') != -1) {
		var inputYear = document.cookie.split('; ');
		var index = inputYear.indexOf('planner_year');
		var year;
		$.each(inputYear, function(key, val){
			var result = val.split('=');
			if (result[0] == 'planner_year') {
				year = result[1];
				return false;
			}
		})
		$('.year').html(year);
	}
	
	$('.planner-change-year').click(function(){
		$("#lightbox, #lightbox-panel").fadeIn(300);
		$('.lightbox-input-years').focus();
	});
	
	$(".close-panel").click(function(){
      $("#lightbox, #lightbox-panel").fadeOut(300);
	})
	$(".planner-next-step").click(function(e){
		var x = [];
		var nr = 0;
		$('.planner-question-title').each(function(){
			x[nr] = $(this).text(); nr++;
			x[nr] = $(this).parent().find('.answer-now').val(); nr++;
			x[nr] = $(this).parent().find('.answer-after').val(); nr++;
		});
		var cat = '';
		$('.general-planner-menu div').each(function(){
			if ($(this).hasClass('menu-item-selected')) {
				cat = $(this).text().toLowerCase();
			}
		});

		$.ajax({
				url: "/scripts/gen_plan.php",
				type: "POST",
				data: { 'save' : 1,
						'cat' : cat,
						'q0' : x[0],
						'an0' : x[1],
						'aa0' : x[2],
						'q1' : x[3],
						'an1' : x[4],
						'aa1' : x[5],
						'q2' : x[6],
						'an2' : x[7],
						'aa2' : x[8],
						'q3' : x[9],
						'an3' : x[10],
						'aa3' : x[11],
						'q4' : x[12],
						'an4' : x[13],
						'aa4' : x[14],
						'q5' : x[15],
						'an5' : x[16],
						'aa5' : x[17]
				},
				dataType: "html",
				success: function(data) {
					console.log(data);
				},
				error: function(error) {
					console.log('error: '+error);
				}
		});
		
		if ($(this).hasClass('save-plan')) {
			$.ajax({
				url: "/scripts/save_gen_planner.php",
				type: "POST",
				data: { 'save_plan' : 1 },
				dataType: "html",
				success: function(data) {
					console.log(data);
				},
				error: function(error) {
					console.log('error: '+error);
				}
			});
		}
		
	});
	
	$('.sp-subcat-item').click(function(){
		var name = 'sp-' + $(this).text().toLowerCase();
		$('input[name="'+name+'"]').click();
	});
	
	$('.sp-next').click(function(){
		var subcats = [];
		$('input[type="checkbox"]:checked').each(function(i,v){
			subcats.push(v.value);
		});
		$.post("scripts/save_session_var.php", { subcats: subcats, save_var : 1 }, function(){
			window.location = '/?q=specific-planner-do';
		});
	});
	
	$('.sp-checkbox').click(function(){
		var thisInput = $(this).prev('input');
		var target = thisInput.attr('name');
		target = target.replace("sp-", ".sp-question-");
		//@@console.log(target);
		if (target.indexOf('both') != -1) {
			
			if (thisInput.is(':checked')) {	
				var result = target.split('-');
				$('.sp-question').each(function(){
					var classes = $(this).attr('class').split(' ');
					var target_class = classes[1].split('-');
					if (result[2] == target_class[2]) {
						if ($(this).hasClass('hide')) {
							$(this).hide();
						}
					}
				});
				$('input[type="checkbox"]').each(function(){
					var name = $(this).attr('name');
					name = name.split('-');
					if(name[1] == result[2]) {
						$(this).removeAttr('checked');
					}
				});

				
			}
			else {
				var result = target.split('-');
				$('.sp-question').each(function(){
					var classes = $(this).attr('class').split(' ');
					var target_class = classes[1].split('-');
					if (result[2] == target_class[2]) {
						$(this).show();
					}
				});
				$('input[type="checkbox"]').each(function(){
					var name = $(this).attr('name');
					name = name.split('-');
					if(name[1] == result[2]) {
						$(this).attr('checked', 'checked');
					}
				});
			}
		}
		else if(thisInput.is(':checked')){
			thisInput.removeAttr('checked');
			$(target).hide();
		}
		else {
			thisInput.attr('checked', 'checked');
			$(target).show();
		}
	});
	
	$('.sp-save').click(function(){
		var result = [];
		var record = 0;
		$('.category-question').each(function(){
			var sid = $(this).attr('sid');
			result[sid] = [];
			$(this).find('.sp-data').each(function(){
				if($(this).length > 0) {
					result[sid].push([$(this).val(), $(this).attr('data')]);
					record++;
				}
				else {
					return false;
				}
			});
		});
		$.each(result, function(k,v){
			var exist = false;
			if (typeof v != 'undefined') {
				if (v.length > 1) {
					$.each(v, function(nk, nv){
						if (nv[0]) {
							exist = true;
						}
					});
					if (!exist) {
						delete result[k];
						record--;
					}
				}
				else if (v.length == 1) {
					if (!v[0]) {
						delete result[k];
						record--;
					}
				}
			}
			else {
				record--;
			}
		});
		if (record) {
		
			$.ajax({
				url: "/scripts/save_sp_planner.php",
				type: "POST",
				data: { 'save_plan' : 1, 'data' : result },
				dataType: "html",
				success: function(data) {
					console.log(data);
					window.location = '/';
				},
				error: function(error) {
					console.log('error: '+error);
				}
			});
		}
	});
	
	//$('input[type="checkbox"]').click(function(){
	//	console.log('da');
	//	var target = $(this).attr('name');
	//	console.log(target);
	//
	//});
	
	
});
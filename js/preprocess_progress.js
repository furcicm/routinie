(function($) {
	$(document).ready(function(){
		$(".cat-subcat").mouseenter(function(){
			$(this).animate({
				marginTop: '-240'
			  }, 300, function() {
				// Animation complete.
			  });; 
		});
		$(".cat-subcat").mouseleave(function(){			
			 $(this).animate({
				marginTop: '0'
			  }, 300, function() {
				// Animation complete.
			  });; 
		});
		
		$('.enterteinment-random').change(function(){
			$('#add-progress-input').val($(this).val());
		});
		
		$('input').focus(function(){$('input').removeClass('error-red')});
		$('#form-add-new-progress').submit(function(){
			if ($('.new-input-title').length) {
				if (!$('.new-input-title').attr('value')) {
					$('.new-input-title').addClass('error-red');
				return false;
				}
			}
			if ($('.new-input-pages').length) {
				if (!$.isNumeric($('.new-input-pages').val()) || $('.new-input-pages').val() < 1 ) {
					$('.new-input-pages').addClass('error-red');
					return false;
				 }
			}
			if ($('.new-input-time').length) {
				if (!$.isNumeric($('.new-input-time').val()) || $('.new-input-time').val() < 1) {
					$('.new-input-time').addClass('error-red');
					return false;
				}
			}
			if ($('.new-input-time-hour').length) {
				if ($.isNumeric($('.new-input-time-hour').val()) && $('.new-input-time-hour').val() >= 0){
					return true;
				}
				else {
					$('.new-input-time-hour').addClass('error-red');	
				}
				return false;
			}

			if ($('.new-input-time-hour').length) {
				if (!$.isNumeric($('.new-input-time-hour').val())) {
					$('.new-input-time-hour').addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-time-hour').length) {
				if (!$.isNumeric($('.new-input-time-hour').val())) {
					$('.new-input-time-hour').addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-title-continent').length) {
				var ok = false;
				if($('.new-input-title-continent').val()) {
					ok = true;
				}
				else if($('.new-input-title-country').val()) {
					ok = true;
				}
				else if($('.new-input-title-place').val()) {
					ok = true;
				}
				
				if (ok) {
					if(!$('.new-input-travel-start').val()) {
						$('.new-input-travel-start').addClass('error-red');
						return false;
					}
					if(!$('.new-input-travel-end').val()) {
						$('.new-input-travel-end').addClass('error-red');
						return false;
					}
				}
				else {
					$('.add-progress-input').addClass('error-red');
					return false;
				}
			}
			
			if ($('.input-social-whom').length) {
				if (!$('.input-social-whom').val()) {
					$('.input-social-whom').addClass('error-red');
					return false;
				}
			}
			if ($('.input-social-where').length) {
				if (!$('.input-social-where').val()) {
					$('.input-social-where').addClass('error-red');
					return false;
				}
			}
			if ($('.input-social-time').length) {
				if (!$('.input-social-time').val() || !$.isNumeric($('.input-social-time').val()) || $('.input-social-time').val() < 1) {
					$('.input-social-time').addClass('error-red');
					return false;
				}
			}
			
			return true;
		});
		
		var skip_check = 0;
		$("input[name='submit-done']").click(function(){
			skip_check = 1;
		});
		
		$('.add-progress-form').submit(function(){
			
			if (skip_check) {
				return true;
			}
			
			var nr = $(this).attr('error');
			if ($('.new-input-pages_' + nr).length) {
				if (!$.isNumeric($('.new-input-pages_' + nr).val()) || $('.new-input-pages_' + nr).val() < 1 ) {
					$('.new-input-pages_' + nr).addClass('error-red');
					return false;
				}
			}
			if ($('.new-input-time_' + nr).length) {
				if (!$.isNumeric($('.new-input-time_' + nr).val()) || $('.new-input-time_' + nr).val() < 1) {
					$('.new-input-time_'+nr).addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-km').length) {
				if (!$.isNumeric($('.new-input-km').val()) || $('.new-input-km').val() < 0.1) {
					$('.new-input-km').addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-time-movement').length) {
				if (!$.isNumeric($('.new-input-time-movement').val()) || $('.new-input-time-movement').val() < 1) {
					$('.new-input-time-movement').addClass('error-red');
					return false;
				}
			}
			
			
			if ($('.new-input-games_' + nr).length) {
				if (!$.isNumeric($('.new-input-games_' + nr).val()) || $('.new-input-games_' + nr).val() < 1) {
					$('.new-input-games_'+nr).addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-time-hour_' + nr).length) {
				if (!$.isNumeric($('.new-input-time-hour_' + nr).val()) || $('.new-input-time-hour_' + nr).val() < 1) {
					$('.new-input-time-hour_'+nr).addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-quantity_' + nr).length) {
				if (!$.isNumeric($('.new-input-quantity_' + nr).val()) || $('.new-input-quantity_' + nr).val() < 1) {
					$('.new-input-quantity_'+nr).addClass('error-red');
					return false;
				}
			}
			
			if ($('.new-input-hour-hob-vol_' + nr).length) {
				if ($.isNumeric($('.new-input-hour-hob-vol_' + nr).val()) && $('.new-input-hour-hob-vol_' + nr).val() >= 0){
					return true;
				}
				else if ($.isNumeric($('.new-input-minutes-hob-vol_' + nr).val()) && $('.new-input-minutes-hob-vol_' + nr).val() >= 0){
					return true;
				}
				$('.new-input-hour-hob-vol_' + nr).addClass('error-red');
				return false;
			}
			return true;
		});
	});
})(jQuery);
(function ($) {
	var account = {
	
		valuesCheck : function(fullName, country, city, gender, day, month, year) {
			return false;
		},
		getLinkedAccount : function() {
			$.ajax({
				dataType: 'json',
				url: "/scripts/get_linked_account.php",
				success : function(data) {
					$.each(data, function(i, v){
						var $account = $('.social-account-container').find('.account-' + v);
						$account.parent('a').removeAttr('href');
						$account.css('background-color','#00B5EE').find('p').html('Already linked');
					});
				},
				error : function(data) {
					console.log(data);
				},
			});
		},
		update : function(fullName, country, city, gender, day, month, year) {
			// console.log(fullName + ' ' + country + ' ' + city + ' ' + gender + ' ' + day + ' ' + month + ' ' + year);
			$('div.update-status').remove();
			$.ajax({
				url: "/scripts/update_account.php",
				type: "POST",
				data: { 'update' : 1,
						'fullName' : fullName,
						'country' : country,
						'city' : city,
						'gender' : gender,
						'day' : day,
						'month' : month,
						'year' : year,
					},
				dataType: "html",
				success: function(data) {
					$('div#header-center').after('<div class="update-status"></div>');
					if (data == 1) {
						$('div.update-status').addClass('green-background').html('Your account details has been updated!');					
						$('.account-message span.strong').html(fullName);
					}
					else if (data == 2) {
						$('div.update-status').addClass('green-background').html('Nothing has been updated!');
					}
				},
				error: function(error) {
					console.log('error: '+error);
				},
			});
			return false;
		},
		
		updatePassword : function(currentPassword, newPassword, noPass) {
		$('div.update-password-status').remove();
		$('.password-account-container input').removeClass('red-border');
			$.ajax({
				url: "/scripts/update_account.php",
				type: "POST",
				data: { 'update_password' : 1,
						'current_password' : currentPassword,
						'new_password' : newPassword,
						'no_pass' : noPass,
					},
				dataType: "html",
				success: function(data) {
					$('div.account-password').append('<div class="update-password-status"></div>');
					if (data == '4') {
						$('div.update-password-status').addClass('red-background').html('You have entered a wrong password.');
						$('.account-current-password').addClass('red-border');
					}
					else if (data == 3) {
						$('div.update-password-status').addClass('red-background').html('You have entered the same password.');
						$('.account-current-password').addClass('red-border');
						$('.account-new-password').addClass('red-border');
						$('.account-retype-new-password').addClass('red-border');
					}
					else if (data == 1) {
						$('div.update-password-status').addClass('green-background').html('Your password has been changed.');
						$('.password-account-container input[type="password"]').val('');
					}
					else {
						$('div.update-password-status').addClass('red-background').html('Error.. Please try again later.');
					}
				},
				error: function(error) {
					console.log('error: '+error);
				},
			});
			return false;
		},
		
	};
	$(document).ready(function(){
		account.getLinkedAccount();
		$('input[name="user-update"]').click(function(e){
			var fullName = $('form#profile-information input[name="full-name"]').val();
			var country = $('form#profile-information input[name="country"]').val();
			var city = $('form#profile-information input[name="city"]').val();
			var gender = $('form#profile-information select[name="gender"]').val();
			var day = $('form#profile-information select[name="day"]').val();
			var month = $('form#profile-information select[name="month"]').val();
			var year = $('form#profile-information select[name="year"]').val();
			// var check = account.valuesCheck(fullName, country, city, gender, day, month, year);
			// if (check) {
				// $('form#profile-information input').removeClass('red-border');
				// $('form#profile-information input[name="' + check + '"]').addClass('red-border');
				// return false;
			// }
			account.update(fullName, country, city, gender, day, month, year);
			return false;
		});
		
		$('input[name="user-update-email"]').click(function(e){
			return false;
		});
		
		$('input[name="user-update-password"]').click(function(e) {
			$('div.update-password-status').remove();
			$('.password-account-container input').removeClass('red-border');
			var currPass = $('.account-current-password').val();
			var newPass = $('.account-new-password').val();
			var rePass = $('.account-retype-new-password').val();
			var noPass = $('.no-password').val();
			if (noPass != 1) { noPass = 0;}
			if (currPass.length == 0 && noPass !=1) {
				$('.account-current-password').addClass('red-border');
				console.log('da');
				return false;
			}
			if (newPass.length == 0 || rePass.length == 0 || newPass != rePass) {
				$('.password-account-container input').removeClass('red-border');	
				$('.account-new-password').addClass('red-border');
				$('.account-retype-new-password').addClass('red-border');
				return false;
			}
			account.updatePassword(currPass, newPass, noPass);
			return false;
		});
	});
})(jQuery);
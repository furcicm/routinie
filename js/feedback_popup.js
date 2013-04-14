/*
 * SimpleModal Contact Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2010 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact.js 254 2010-07-23 05:14:44Z emartin24 $
 */

jQuery(function ($) {
	var contact = {
		message: null,
		init: function () {
			$('a.contact').click(function (e) {
				e.preventDefault();

				// load the contact form using ajax
				$.get("../include/feedback_win.php", function(data){
					// create a modal dialog with the data
					$(data).modal({
						closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
						position: ["15%",],
						overlayId: 'contact-overlay',
						containerId: 'contact-container',
						onOpen: contact.open,
						onShow: contact.show,
						onClose: contact.close
					});
				});
			});
		},
		open: function (dialog) {
			// add padding to the buttons in firefox/mozilla
			if ($.browser.mozilla) {
				$('#contact-container .contact-button').css({
					'padding-bottom': '2px'
				});
			}
			// input field font size
			if ($.browser.safari) {
				$('#contact-container .contact-input').css({
					'font-size': '.9em'
				});
			}

			// dynamically determine height
			var h = 250;

			var title = $('#contact-container .contact-title').html();
			$('#contact-container .contact-title').html('Loading...');
			dialog.overlay.fadeIn(200, function () {
				dialog.container.fadeIn(200, function () {
					dialog.data.fadeIn(1, function () {
						$('#contact-container .contact-content').animate({
							height: h
						}, function () {
							$('#contact-container .contact-title').html(title);
							$('#contact-container form').fadeIn(200, function () {
								$('#contact-container #contact-name').focus();


								// fix png's for IE 6
								if ($.browser.msie && $.browser.version < 7) {
									$('#contact-container .contact-button').each(function () {
										if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
											var src = RegExp.$1;
											$(this).css({
												backgroundImage: 'none',
												filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
											});
										}
									});
								}
							});
						});
					});
				});
			});
		},
		show: function (dialog) {
			$('#contact-container .contact-send').click(function (e) {
				e.preventDefault();
				// validate form
				if (contact.validate()) {
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(function () {
						msg.removeClass('contact-error').empty();
					});
					$('#contact-container .contact-title').html('Sending...');
					$('#contact-container form').fadeOut(200);
					$('#contact-container .contact-content').animate({
						height: '85px'
					}, function () {
						$('#contact-container .contact-loading').fadeIn(200, function () {
							$.ajax({
								url: '../include/feedback_win.php',
								data: $('#contact-container form').serialize() + '&action=send',
								type: 'post',
								cache: false,
								dataType: 'html',
								success: function (data) {
									$('#contact-container .contact-loading').fadeOut(200, function () {
										$('#contact-container .contact-title').css('margin-left', '-25px').css('width', '420px').css('text-align', 'center').html('Thank you for providing your valuable <br>feedback.');
										msg.html(data).fadeIn(200);
									});
								},
								error: contact.error
							});
						});
					});
				}
			
			});
		},
		close: function (dialog) {
			$('#contact-container .contact-message').fadeOut();
			$('#contact-container .contact-title').html('Goodbye...');
			$('#contact-container form').fadeOut(200);
			$('#contact-container .contact-content').animate({
				height: 40
			}, function () {
				dialog.data.fadeOut(1, function () {
					dialog.container.fadeOut(200, function () {
						dialog.overlay.fadeOut(200, function () {
							$.modal.close();
						});
					});
				});
			});
		},
		error: function (xhr) {
			alert(xhr.statusText);
		},
		validate: function () {
			contact.message = '';
			return true;
			
		},
	};

	contact.init();

});
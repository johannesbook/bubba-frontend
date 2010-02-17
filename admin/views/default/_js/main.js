var statustimer;

function hide_status() {
	$("#update_status").slideUp(500);
}

function update_status($success,$msg) {
	if($success=="success") {
		alert("call has changed - do not use string");
	}
	if($success=="fail") {
		alert("call has changed - do not use string");
	}
	if($success > 0) {
		$("#update_status").removeClass("error");
		$("#update_status").html($msg)
		$("#update_status").slideDown(200);
		if(statustimer) {
			clearTimeout(statustimer);
		}
		statustimer = setTimeout(hide_status,3000);
	} else {
		$("#update_status").addClass("error");
		$("#update_status").html($msg)
		$("#update_status").slideDown(100);
	}
}

function cursor_wait() {
	$('body').addClass('cursor_wait');
	$('body *').addClass('cursor_wait');
	$("input").addClass('cursor_wait');
	$("select").addClass('cursor_wait');
}		
function cursor_ready() {
	$('body').removeClass('cursor_wait');
	$('body *').removeClass('cursor_wait');
	$("input").removeClass('cursor_wait');
	$("select").removeClass('cursor_wait');
}		

jQuery.fn.extend({
		stripe: function() {

			return this.each(function(i) {
					if( !jQuery(this).is('table') ) {
						return;
					}
					var rowClass = 'even';
					var rowIndex = 0;
					return jQuery('tr',this).each(function(ii) {
							if (jQuery('th', this).length) {
								rowClass = 'subhead';
								rowIndex = -1;
							} else if (rowIndex % 1 == 0) {
								rowClass = (rowClass == 'even' ? 'odd' : 'even');
							};
							jQuery(this).removeClass("odd even");
							jQuery(this).addClass(rowClass);
							rowIndex++;				
						});
				});
		}
	});


$(document).ready( function() {

		$(".expansion").click(function() {
			var $thisid = $(this).attr('id');
			$(".expansion").each(function() {
				if($(this).attr('id') == $thisid) {
					if($(this).closest('fieldset').children('div').css('display') == "none") {
						// change '+' sign to '-'
						$(this).children('span').html("-");
					} else {
						// change '-' sign to '+'
						$(this).children('span').html("+");
					}
					$(this).closest('fieldset').children('div').slideToggle(500);
					
				} else {
					// change '-' sign to '+'
					$(this).children('span').html("+");
					$(this).closest('fieldset').children('div').slideUp(500);
				}
				
			});
		});
		/*
		$('fieldset.expandable.collapsed').children(':last-child').hide();
		$('fieldset.expandable > legend').prepend($('<span/>').addClass('expander'));
		$('fieldset.expandable > legend').click(function() {
				collapsed = $(this).parent().hasClass( 'collapsed' );
				$('fieldset.expandable.expanded').children(':last-child').slideUp(500);
				$('fieldset.expandable.expanded').removeClass('expanded').addClass('collapsed');
				if( collapsed ) {
					$(this).siblings(':last-child').slideDown(500);
					$(this).parent().removeClass('collapsed').addClass('expanded');
				}
			}
		);
		*/
		
	});
(
	function($) {
		$.dialog = function jQuery_ui_confirm(message, header, buttons, class ) {
			if(!class) {
				class="";
			}
			if(!buttons) {
				buttons = {};
			}
			div = $('<div/>');
			div.attr('title', header);
			div.html(message);
			div.dialog({
					bgiframe: true,
					resizable: false,
					modal: true,
					buttons: buttons,
					dialogClass: class,
					beforeclose: function(event, ui) { cursor_ready(); }

				}
			);
		};

		$.confirm = function jQuery_ui_alert( message, header, buttons ) {
			if(!buttons) {
				buttons = {
					'Continue': function() {
						$(this).dialog('close');
					},
					'Cancel': function() {
						$(this).dialog('close');
					}
				}
			}
			$.dialog( message, header, buttons, 'ui_dialog_confirm' );
		};

		$.alert = function jQuery_ui_alert( message, header, button_label, callback ) {
			if(!button_label) {
				button_label = "Ok";
			}
			buttons = {};
			buttons[button_label] = function() {
				$(this).dialog('close');
				if( $.isFunction( callback ) ) {
					callback.apply( this, [] );
				}
			};
			$.dialog( message, header, buttons, 'ui_dialog_alert' );
		};

	}
)(jQuery);

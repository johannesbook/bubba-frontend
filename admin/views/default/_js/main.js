//define a single reference for an empty function
if (typeof Function.empty == 'undefined')
    Function.empty = function(){};

//stub out firebug console object
//        will allow console statements to be left in place
if (typeof console == 'undefined')
    console = {
        "log": Function.empty,
        "debug": Function.empty,
        "info": Function.empty,
        "warn": Function.empty,
        "error": Function.empty,
        "assert": Function.empty,
        "dir": Function.empty,
        "dirxml": Function.empty,
        "trace": Function.empty,
        "group": Function.empty,
        "groupCollapsed": Function.empty,
        "groupEnd": Function.empty,
        "time": Function.empty,
        "timeEnd": Function.empty,
        "profile": Function.empty,
        "profileEnd": Function.empty,
        "count": Function.empty
    };

var statustimer;

function hide_status() {
	$("#update_status").slideUp(500);
}

function update_status($success,$msg) {
	if( typeof $success == 'string' ) {
		console.group( "update_status call has changed" );
		console.warn( "update_status call has changed, $success was '%s'; $msg was '%s'", $success, $msg );
		console.trace();
		console.groupEnd();
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

function logout_dialog() {
	
	var buttons = {};
	buttons[$.message("logout-dialog-button-logout")] =  function() {window.location.href = config.prefix+"/logout";};
	buttons[$.message("button-label-cancel")] =  function() {$(this).dialog('close');};
	$.confirm( 
			$.message("logout-dialog-message"),
			$.message("logout-dialog-title"),
			buttons
	);
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
		$.dialog = function jQuery_ui_confirm(message, header, buttons, override_options ) {

			if(!buttons) {
				buttons = {};
			}

			options = {
				bgiframe: true,
				resizable: false,
				modal: true,
				buttons: buttons,
				beforeclose: function(event, ui) { cursor_ready(); }
			}
			if( override_options != undefined ) {
				$.extend( options, override_options );
			}

			div = $('<div/>');
			div.attr('title', header);
			div.html(message);
			div.dialog( options );
			return div;
		};
/*
 * Usage:
 * $.confirm( 
 * 		message, // html message to be shown
 *		"<?=t("Title")?>", {
 *		 // button label : callback,
 *			<?=t('button_label_continue')?>: function() { // continue button
 *				$(this).dialog('close');
 *				// continue execution here
 *			},
 *			<?=t('button_label_cancel')?>: function() { // cancel button
 *				$(this).dialog('close');
 * 				// eventual cancel logic heoverride_re
 *			}
 *			 // , ... more buttons if wanted
 *		}
 *	);
 *
 */
		$.confirm = function jQuery_ui_confirm( message, header, buttons, override_options ) {
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
			options = {dialogClass:'ui_dialog_confirm'};
			$.extend( options, override_options );
			
			return $.dialog( message, header, buttons, options );
		};

		$.alert = function jQuery_ui_alert( message, header, button_label, callback, override_options ) {
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
			options = {dialogClass:'ui_dialog_alert'};
			$.extend( options, override_options );

			return $.dialog( message, header, buttons, options );
		};

	}
)(jQuery);

jQuery.extend({
	'message': function(str){
		if( typeof messages[str] != "undefined" ) {
			var args = Array.prototype.slice.call(arguments);
			args.shift(); // str
			return $.vsprintf(messages[str], args);
		} else {
			if( typeof console != "undefined" ) {
				console.warn("message '%s' was not defined", str);
			}
			return str;
		}
	}
}
);

$(function($) {
	$('.jclock').jclock();
});

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
	$("#update_status").slideDown(500);
}

function update_status($success,$msg) {
	if( typeof $success == 'string' ) {
		console.group( "update_status call has changed" );
		console.warn( "update_status call has changed, $success was '%s'; $msg was '%s'", $success, $msg );
		console.trace();
		console.groupEnd();
	}
	var update_status = $("#update_status");
	update_status.html($msg)

	update_status.width($("#content_wrapper").outerWidth());
	update_status.position({
			'my': 'bottom',
			'at': 'bottom',
			'of': window,
			'collision': 'fit'
		}
	);

	if($success > 0) {
		update_status.removeClass("ui-state-error");
		update_status.show( 'slide', { direction: 'down' }, 200 );
		if(statustimer) {
			clearTimeout(statustimer);
		}
		statustimer = setTimeout(function(){
				update_status.hide( 'slide', { direction: 'down' }, 500 );

			},3000
		);
	} else {
		update_status.addClass("ui-state-error");
		update_status.show( 'slide', { direction: 'down' }, 200 );
	}
}

var globalThrobber = null;

$.throbber = {
	show: function() {
		if( ! globalThrobber ) {
			globalThrobber = $('<div />').appendTo( 'body' );
			globalThrobber.throbber();
		}
		globalThrobber.throbber('show');
	},
	hide: function() {
		if( globalThrobber ) {
			globalThrobber.throbber('hide');
		}
	}
}

// TODO remove usage
function cursor_wait() {
	$.throbber.show();
}		
function cursor_ready() {
	$.throbber.hide();
}		

function display_menu() {
	if(! menu_dialog.dialog('isOpen') ) {
		menu_dialog.dialog('open');
		var width = menu_dialog.outerWidth(true);
		var speed = 300;
		menu_dialog.parent().hide().animate( 
			{
				'left': $(window).width()/2 - width / 2,
				'opacity': 'show'
			}, {
				'duration': speed,
				'specialEasing': {
					'left': 'swing',
					'opacity': 'easeInQuint'
				}
			});
	} else {
		var width = menu_dialog.outerWidth(true);
		menu_dialog.parent().show().animate( 
			{
				'left': - width,
				'opacity': 'hide'
			}, {
				'duration': speed,
				'specialEasing': {
					'left': 'swing',
					'opacity': 'easeOutQuint'
				}
			}).queue(function(){ menu_dialog.dialog('close'), $(this).dequeue()});
	}
}

function logout_dialog() {
	
	var buttons = [
        {
            'label': $.message("logout-dialog-button-logout"),
			'callback': function(){window.location.href = config.prefix+"/logout";},
			options: { 'id': 'fn-logout-dialog-button', 'class' : 'ui-element-width-100' }
		}
	];
	$.confirm( 
			$.message("logout-dialog-message"),
			$.message("logout-dialog-title"),
			buttons
	);
}

function exit_wizard() {
	$.post(config.prefix+"/stat/dialog_wizard_exit",{},function(){
			window.location.href = config.prefix+"/settings"
		},'json');
}

function piechart(chart_canvas) {
          var chart = chart_canvas[0];
          var percentage = chart_canvas.attr('rel');
          if(chart.getContext)
          {
            var x = Math.PI/50;
            var ctx = chart.getContext('2d');
            ctx.scale(1,0.45);

            if (x*percentage - Math.PI/2 > 0)
            {
              ctx.fillStyle = '#506AB2';
              ctx.beginPath();
              var angle = x*percentage-Math.PI/2 > Math.PI ? Math.PI : x*percentage-Math.PI/2;
              ctx.arc(55,60,55, 0, angle, false);
              ctx.arc(55,85,55, angle, 0, true);
              ctx.fill();
            }

            if (x*percentage - Math.PI/2 < Math.PI)
            {
              ctx.fillStyle = '#1a1a1a';
              ctx.beginPath();
              var startangle = x*percentage - Math.PI/2 > 0 ? x*percentage - Math.PI/2 : 0;
              ctx.arc(55,60,55, startangle, Math.PI, false);
              ctx.arc(55,85,55, Math.PI, startangle, true);
              ctx.fill();
            }

            ctx.fillStyle = '#506AB2';
            ctx.beginPath();
            ctx.arc(55,60,55, -Math.PI/2, x*percentage-Math.PI/2, false);
            ctx.lineTo(55,60);
            ctx.fill();
            
            ctx.fillStyle = '#656565';
            ctx.beginPath();
            ctx.arc(55,60,55, x*percentage-Math.PI/2, -Math.PI/2, false);
            ctx.lineTo(55,60);
            ctx.fill();
            
            var gradient = ctx.createLinearGradient(0,0,0,130);
            gradient.addColorStop(0,'rgba(255,255,255,0)');
            gradient.addColorStop(1,'rgba(255,255,255,0.2)');
            ctx.strokeStyle = gradient;
            ctx.beginPath();
            ctx.arc(55,60,55, 0, Math.PI*2, false);
            ctx.stroke();
          }
}



$(document).ready( function() {
	
		$('.jclock').jclock();

		// Expandable divs, first div is header, next is body
		$(".ui-expandable").prepend($('<div/>',{'class': "ui-expandable-icon ui-icon ui-icon-triangle-1-s"}));
		$(".ui-expandable + :hidden").prev().children('div.ui-expandable-icon').toggleClass("ui-icon-triangle-1-s ui-icon-triangle-1-e");
		$(".ui-expandable").live('click',function(){
				var self= $(this);
				self.children('div.ui-expandable-icon').toggleClass("ui-icon-triangle-1-s ui-icon-triangle-1-e");
				self.next().slideToggle('fast',function(){});
			}
		);

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
		var iCheckbox_options = {
			switch_container_src: config.prefix+'/views/'+config.theme+'/_img/bubba_switch_container.png',
			class_container: 'ui-icon-bubba-switch-container',
			class_switch: 'ui-icon-bubba-switch',
			switch_speed: 50,
			switch_swing: -65,
			checkbox_hide: true,
			switch_height: 21,
			switch_width: 127
		};
		$(':input[type=checkbox].slide').iCheckbox( iCheckbox_options );

	});
(
	function($) {
		$.dialog = function(message, header, buttons, override_options ) {

			if(!buttons) {
				buttons = {};
			}

			var options = {
				closeText: '',
				bgiframe: true,
				resizable: false,
				modal: true,
				buttons: buttons,
				position: ['center', 200],
				beforeclose: function(event, ui) { $.throbber.hide(); }
			}
			if( override_options != undefined ) {
				$.extend( options, override_options );
			}

			var div = $('<div/>').hide().appendTo('body');

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
		$.confirm = function( message, header, buttons, override_options ) {
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
			var options = {dialogClass:'ui-dialog-confirm', close: function(){$(this).remove()}};
			$.extend( options, override_options );
			message = $("<div/>",{html:message});
			message.prepend($('<h2/>',{html:header}));
			return $.dialog( message, '', buttons, options );
		};

		$.alert = function( message, header, button_label, callback, override_options ) {
			if(!button_label) {
				button_label = "Ok";
			}
			var buttons = {};
			buttons[button_label] = function() {
				$(this).dialog('close');
				if( $.isFunction( callback ) ) {
					callback.apply( this, [] );
				}
			};
			var options = {dialogClass:'ui-dialog-alert', close: function(){$(this).remove()} };
			$.extend( options, override_options );
			message = $("<div/>",{html:message});
			message.prepend($('<h2/>',{html:header}));
			return $.dialog( message, '', buttons, options );
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


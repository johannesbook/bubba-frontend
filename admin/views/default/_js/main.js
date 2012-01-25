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
	$("#update_status").not(':hidden').hide( 'slide', { direction: 'down' }, 500 );
}

function update_status($success,$msg) {
	if( typeof $success == 'string' ) {
		console.group( "update_status call has changed" );
		console.warn( "update_status call has changed, $success was '%s'; $msg was '%s'", $success, $msg );
		console.trace();
		console.groupEnd();
	}
	var $obj = $("#update_status");
	$obj.html($msg);

	$obj.width($("#content_wrapper").outerWidth());
	$obj.position({
			'my': 'bottom',
			'at': 'bottom',
			'of': window,
			'collision': 'fit'
		}
	);

	if($success > 0) {
		$obj.removeClass("ui-state-error");
		$obj.show( 'slide', { direction: 'down' }, 200 );
		if(statustimer) {
			clearTimeout(statustimer);
		}
		statustimer = setTimeout(function(){
				$obj.hide( 'slide', { direction: 'down' }, 500 );

			},3000
		);
	} else {
		$obj.addClass("ui-state-error");
		$obj.show( 'slide', { direction: 'down' }, 200 );
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
};

// TODO remove usage
function cursor_wait() {
	$.throbber.show();
}		
function cursor_ready() {
	$.throbber.hide();
}		

function display_menu() {
    var width;
    var speed = 300;
	if(! menu_dialog.dialog('isOpen') ) {
		menu_dialog.dialog('open');
		width = menu_dialog.outerWidth(true);
		if( config.ua.Browser == 'Safari' ) {
			width = 575 + 3; // possible bug in safari
		}
		console.log( width );
		var left = $(window).width()/2 - width / 2;
		menu_dialog.parent().hide().animate( 
			{
				'left': left,
				'opacity': 'show'
			}, {
				'duration': speed,
				'specialEasing': {
					'left': 'swing',
					'opacity': 'easeInQuint'
				}
			});
	} else {
		width = menu_dialog.outerWidth(true);
		if( config.ua.Browser == 'Safari' ) {
			width = 575 + 3; // possible bug in safari
		}
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
            }).queue(function(){
                menu_dialog.dialog('close');
                $(this).dequeue();
        });
	}
}

function logout_dialog() {
	
	var buttons = [
        {
            'text': _("Logout"),
			'click': function(){window.location.href = config.prefix+"/logout";},
            'id': 'fn-logout-dialog-button',
            'class' : 'ui-element-width-100'
		}
	];
	$.confirm( 
			"",
			_("Proceed with logout?"),
			buttons
	);
}

$(window).load(function() {
	$('.jclock').jclock();
});


$(document).ready( function() {

	// prohobit submit with no action set.
	$("*:has(input[type=text])").submit( function(e) {
			if(!$(e.target).closest('form').attr("action")) {
			return false;
		}
	});

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
			};
			if( override_options !== undefined ) {
				$.extend( options, override_options );
			}

			var div = $('<div/>').hide().appendTo('body');

			div.attr('title', header);
			div.html(message);
            div.dialog( options );
            var my_buttons = div.dialog('widget').find('.ui-dialog-buttonset button');
            switch(my_buttons.length) {
            case 2:
                my_buttons.addClass('ui-element-width-50');
                break;
            case 1:
                my_buttons.addClass('ui-element-width-100');
                break;
            }

			return div;
		};

		$.confirm = function( message, header, buttons, override_options ) {
			if(!buttons) {
				buttons = {
					'Continue': function() {
						$(this).dialog('close');
					},
					'Cancel': function() {
						$(this).dialog('close');
					}
				};
			}
			var options = {dialogClass:'ui-dialog-confirm', close: function(){$(this).remove();}};
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
			var options = {dialogClass:'ui-dialog-alert', close: function(){$(this).remove();}};
			$.extend( options, override_options );
			message = $("<div/>",{html:message});
			message.prepend($('<h2/>',{html:header}));
			return $.dialog( message, '', buttons, options );
		};

	}
)(jQuery);

var statustimer;

function hide_status() {
	$("#update_status").slideUp(500);
}

function update_status($success,$msg) {
	if($success=="success") {
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
					if( !jQuery(this).is('table') || jQuery(this).attr('id') == "pie_data") {
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
	});

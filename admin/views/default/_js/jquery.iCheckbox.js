/*
 * iCheckbox - Inspired Checkbox v0.1
 *
 * Convert a checkbox or multiple checkboxes into iphone style switches.
 *
 * This is based on the jQuery iphoneSwitch plugin by Daniel LaBare.
 *
 * Features:
 *    * Because checkboxes are used, this is compatable with having javascript off for form submission.
 *    * Affects only checkboxes.
 *    * Synchronizes the actual state of the checkbox for on or off status.
 *    * Completely self-contained for each checkbox.
 *    * Changes fire the onchange event of your checkbox.
 *    * Relies purely on css for styling... no passing anything but your slider image.
 *    * Because functionality is decoupled from CSS, you can assign custom CSS classes if you wish making it possible for multiple version per page.
 *    * Completely inline like a normal checkbox. No sliding-door-float madness.
 *
 * iphoneSwitch Author: Daniel LaBare
 *    iCheckbox Author: Bryn Mosher
 *   iCeckbox mod Author: Carl Fürstenberg
 *   iphoneSwitch Date: 2/4/2008
 *      iCheckbox date: 2/26/2010-2/27/2010 (like most of you I'm a nite owl :P)
 *      iCheckbox mod date: Tue Mar  9 14:21:27 CET 2010
 */

// Need to override jQuery functions so we can highjack the attr change
(
	function() {
		var original = jQuery.fn.attr;
		jQuery.fn.attr = function(key, value) {
			var old = original.apply( this, [ key ] );
			var ret = original.apply( this, [ key, value ] );
			if( typeof value != 'undefined' && old != key ) {
				jQuery(this).trigger('attrChanged', [key, value]);
			} else if( typeof value != 'undefined' )  {
			}
			return ret;
		}
	}
)
();


(
	function() {
		var original = jQuery.fn.removeAttr;
		jQuery.fn.removeAttr = function(key, fn) {
			var ret = original.apply( this, [ key, fn ] );
			jQuery(this).trigger('attrRemoved', [key]);
			return ret;
		}
	}
)
();

// convert the matched element into an iCheckbox if it is a checkbox input
jQuery.fn.iCheckbox = function(options) {

	if ( this.is('input[type=checkbox]') ) {
		// define default settings
		var settings = jQuery.extend( {
				// switch_container_src is the outer frame image of the slider
				// you assign the actual slider image via css
				switch_container_src: 'images/iphone_switch_container.gif',
				// The height of your slider
				switch_height: 27,
				// The width of your slider
				switch_width: 94,
				// switch_speed is the speed of the slider animation.
				// Warning: Your onchange() even won't be fired until the end of this!
				switch_speed: 150,
				// How far your actual slider image has to move to change to the "off" state.
				// This can be either positive or negative based on the layout of your image.
				// The "on" state expects this image to have backgroundPosition: 0px.
				switch_swing: -53,
				// CSS class of the container if you wish.
				class_container: 'iCheckbox_container',
				// CSS class of the switch.
				// This should have your actual "on"/"off" image set as its background-image.
				class_switch: 'iCheckbox_switch',
				// CSS class of the checkbox if you wish it shown.
				class_checkbox: 'iCheckbox_checkbox',
				checkbox_hide: true,
				// animate off function
				iCheckOff: function (elem , options, anim_only ) {
					options = jQuery.extend({
							'duration': settings.switch_speed,
						}, options
					);
					elem.animate({backgroundPosition: settings.switch_swing+'px 0px'}, options );

				},
				// animate on function
				iCheckOn: function (elem, options, anim_only) {
					options = jQuery.extend({
							'duration': settings.switch_speed,
						}, options
					);					
					elem.animate({backgroundPosition: '0px 0px'}, options );
				}
			}, options);

		// create the switch
		return this.each(function() {

				var input = jQuery(this);
				var container;
				var image;

				input.bind( 'attrChanged', function(event, key, value) {
						if( key == 'disabled' ) {
							if( value !== false ) {
								image.addClass('ui-state-disabled');
							} else {
								image.removeClass('ui-state-disabled');
							}
						}
					}
				);
				input.bind( 'attrRemoved', function(event, key) {
						if( key == 'disabled' ) {
							image.removeAttr('disabled').change();
						}
					}
				);

				// make the container
				container = jQuery('<span/>', { 'class': settings.class_container });
				input.wrapAll(container);
				container = input.parent();
				// make the switch image based on starting state
				image = jQuery('<img/>', { 'class': settings.class_switch, 'src': settings.switch_container_src } );
				container.append(image);
				// sync the checkbox to initial state
				if( input.is(':disabled') ) {
					image.addClass('ui-state-disabled');
					settings.iCheckOff.apply( input, [ image, { duration: 1 } ] ); // must have a positive time for the initial event to fire
				} else {
					if(input.is(':checked')) {
						settings.iCheckOn.apply( input, [ image, { duration: 1 } ] ); // must have a positive time for the initial event to fire
					} else {
						settings.iCheckOff.apply( input, [ image, { duration: 1 } ] ); // must have a positive time for the initial event to fire
					}
				}
				// bind clicking on the image
				image.click(function (e) {						
						if( input.is(':disabled') ) {
							return e;
						}
						input.click().change();
						return e;
					}
				);
				// assign the class to it
				input.addClass(settings.class_checkbox);
				// finally hide the checkbox after everything else is declared - we do this for syntax checking
				if ( settings.checkbox_hide == true ) {
					input.hide();
				}
				// bind clicking on a visible checkbox
				input.change(function (e) {
						if(input.is(':checked')) {
							// let the natural onchange() occur
							settings.iCheckOn.apply( input, [ image ] );
						} else {
							// let the natural onchange() occur
							settings.iCheckOff.apply( input,[ image ] );
						}
						return e;
					}
				);
				return this;
			}
		);
		return this;
	} else {
		return false;
	};
};


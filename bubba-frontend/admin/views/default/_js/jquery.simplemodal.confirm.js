(
	function($) {
		$.confirm = function jQuery_confirm(message, callback, button_ok, button_cancel, header, close, onClose ) {
			if(!button_ok) {
				button_ok = "Yes";
			}
			if(!button_cancel) {
				button_cancel = "No";
			}
			if(!header) {
				header = "";
			}
			do_close = close || true;
			div = $( '<div id="confirm"/>' );
			div.append(
				$('<a href="#" title="Close" class="modalCloseX simplemodal-close">x</a>')
			);
			div.append(
				$('<div class="header"><span>' + header +'</span></div>')
			);
			div.append(
				$('<p class="message" />').append( message )
			);
			div.append(
				$('<div class="buttons" />')
				.append(
					$('<input type="button" class="simplemodal-close button" value="' + button_cancel + '" />')
				)
				.append(
					$('<input type="button" class=" button" value="' + button_ok + '" />').click(
						function() {
							// call the callback
							$.modal.close();
							if ($.isFunction(callback)) {
								callback.apply();
							}
							// close the dialog
						}
					)
				)

			);
			$.modal( div, {
					close:false,
                    onClose: onClose
					//overlayId:'confirmModalOverlay',
					//containerId:'confirmModalContainer'
				}
			);
		}
	}
)(jQuery);

(
	function($) {
		$.alert = function jQuery_alert(message, button_ok, header, close) {
			if(!button_ok) {
				button_ok = "Close";
			}
			if(!header) {
				header = "";
			}
			do_close = close || true;
			div = $( '<div id="alert"/>' );
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
					$('<input type="button" class="simplemodal-close button" value="' + button_ok + '" />')
				)
			);
			$.modal( div, {
					close:false
					//overlayId:'confirmModalOverlay',
					//containerId:'confirmModalContainer'
				}
			);
		}
	}
)(jQuery);

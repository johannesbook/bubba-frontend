(
	function($) {
		$.progress = function jQuery_progress(range, precision) {
            this.range = range || 100;
            this.precision = typeof(precision) != 'undefined' ? precision : 2
			this.boxDiv = $( '<div />' ).addClass('progress');
			this.mainDiv = $( '<div />' ).addClass('progress-main');
			this.meterDiv = $('<div />').addClass('progress-meter');
			this.miniboxDiv = $('<div />').addClass('progress-mini-box');
			this.miniDiv = $('<div />').addClass('progress-mini');
			this.textDiv = $('<div />' ).addClass('progress-text').text('0%');
			this.statusDiv = $('<div />' ).addClass('progress-status');
			this.noticeDiv = $('<div />' ).addClass('progress-notice');

			this.mainDiv.css({ 'width': '100%', 'text-align': 'right' });
			this.mainDiv.append(this.meterDiv.append( this.textDiv ));
			this.miniboxDiv.append( this.miniDiv );
			this.boxDiv.append( this.miniboxDiv );
			this.boxDiv.append( this.mainDiv );
			this.boxDiv.append(this.statusDiv);
			this.boxDiv.append(this.noticeDiv);
		};

		$.progress.prototype = {
			mini_left: true,
			root: function() {
				return this.boxDiv;
			},
			update: function( progress, status ) {
				this.meterDiv.css( { 'width' : (progress / this.range * 100) + "%" } );
				this.textDiv.text((progress / this.range * 100).toFixed(this.precision) + "%");
				this.statusDiv.text(status);
			},
			poke: function() {
				this.miniDiv.stop(); 
				if( this.mini_left ) {
					this.miniDiv.animate( { 'marginLeft' :  "110%" }, 2000);
				} else {
					this.miniDiv.animate( { 'marginLeft' :  "-10%" }, 2000);
				}
				this.mini_left = !this.mini_left;
			},
			is_done: function() {
				this.miniDiv.stop(true, true);
			},
			error: function( what ) {
				this.noticeDiv.addClass('progress-error');
				this.noticeDiv.html(what);
				this.mini.stop();
			},
			warn: function( what ) {
				this.noticeDiv.addClass('progress-warn');
				this.noticeDiv.html(what);
			},
			status: function( status ) {
				this.statusDiv.text(status);
				this.noticeDiv.text("");
			}, 
			notice: function( what ) {
				this.noticeDiv.removeClass('progress-error');
				this.noticeDiv.removeClass('progress-warn');
				this.noticeDiv.html(what);
			}
		}
	}
)(jQuery);

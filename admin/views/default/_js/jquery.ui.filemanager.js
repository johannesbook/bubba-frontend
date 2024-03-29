Bytes = function ( value ) {
	if( typeof(value) == 'string' ) {
		var res = /(\d+[.,]?\d*) ?(\w?)(i?)B?/.exec( value );
		var number = res[1];
		var mag = res[2];
		var si = res[3];

		if( ! number ) {
			this.number = 0;
			return;
		}

		if( !si ) {
			this.value = number * Math.pow( 10, Bytes.magnitudes[mag] * 3 );
		} else {
			this.value = number * Math.pow( 2, Bytes.magnitudes[mag] * 10 );
		}
	} else {
		this.value = value;
	}
}

Bytes.magnitudes = {
	'': 0,
	'K': 1,
	'M': 2,
	'G': 3,
	'T': 4,
	'P': 5,
	'E': 6,
	'Z': 7,
	'Y': 8
}
Bytes.rmagnitudes = {
	0: '',
	1: 'K',
	2: 'M',
	3: 'G',
	4: 'T',
	5: 'P',
	6: 'E',
	7: 'Z',
	8: 'Y'
}

Bytes.valueOf = function( value ) {
	return (new Bytes(value)).valueOf();
}

Bytes.prototype.valueOf = function() {
	return this.value;
}

Bytes.prototype.toString = function( magnitude ) {
	var tmp = this.value;
	if( magnitude ) {
		var si = /i/.test(magnitude);
		var mag = magnitude.replace( /.*?(\w)i?B?.*/g, '$1' );
		if( si ) {
			tmp /= Math.pow( 2, Bytes.magnitudes[mag] * 10 );
		} else {
			tmp /= Math.pow( 10, Bytes.magnitudes[mag] * 3 );
		}
		if( parseInt( tmp ) != tmp ) {
			tmp = (new Number( tmp ) ).toPrecision( 4 );
		}
		return tmp + ' ' + mag + (si?'i':'') +  'B';
	} else {
		// si per default
		var current = 0;
		while( tmp >= 1024 ) {
			tmp /= 1024;
			++current;
		}
		tmp = this.value / Math.pow( 2, current * 10 );
		if( parseInt( tmp ) != tmp ) {
			tmp = (new Number( tmp ) ).toPrecision( 4 );
		}
		return tmp + ' ' + Bytes.rmagnitudes[current] + ( current > 0 ? 'iB' : 'B' );
	}

}

jQuery.fn.dataTableExt._fnFeatureHtmlProcessing = function ( oSettings )
{
	var nProcessing = jQuery( 'div', 
		{
			'class': oSettings.oClasses.sProcessing, 
			'html': oSettings.oLanguage.sProcessing,
			'color': 'red'
		} 
	);

	if ( oSettings.sTableId !== '' && typeof oSettings.aanFeatures.r == "undefined" )
	{
		nProcessing.attr('id', oSettings.sTableId+'_processing' );
	}
	jQuery(oSettings.nTable).insertBefore( nProcessing );

	return nProcessing[0];
};
jQuery.fn.dataTableExt.oApi. _fnProcessingDisplay = function ( oSettings, bShow )	
{
	if ( oSettings.oFeatures.bProcessing )
	{
		var an = oSettings.aanFeatures.r;
		for ( var i=0, iLen=an.length ; i<iLen ; i++ )
		{
			jQuery(an[i])[bShow ? "show" : "hide"]('slow');
		}
	}
}

jQuery.fn.dataTableExt.oSort['size-asc']  = function(a,b) {

	var x = (a == "") ? 0 : Bytes.valueOf(a);
	var y = (b == "") ? 0 : Bytes.valueOf(b);
	x = parseFloat( x );
	y = parseFloat( y );
	return ((x < y) ? -1 : ((x > y) ?  1 : 0));
};

jQuery.fn.dataTableExt.oSort['size-desc'] = function(a,b) {
	var x = (a == "") ? 0 : Bytes.valueOf(a);
	var y = (b == "") ? 0 : Bytes.valueOf(b);
	x = parseFloat( x );
	y = parseFloat( y );
	return ((x < y) ?  1 : ((x > y) ? -1 : 0));
};

jQuery.widget("ui.filemanager", {
   // default options
   options: {
	   root: '/',
	   ajaxSource: "",
	   columns: null,
	   sorting: [[0, "asc"],[1,"asc"]],
	   fixedSorting: [[0, "asc"]],
	   prevDirIcon: 'ui-icon-arrowthick-1-w',
	   nextDirIcon: 'ui-icon-arrowthick-1-e',
	   fileDownloadIcon: 'ui-icon-download-1',
	   icons: {
		   'dir': 'ui-icon-folder-collapsed',
		   'file': 'ui-icon-document'
	   },
	   dirPostOpenCallback: null,
	   dirDoubleClickCallback: null,
	   fileDoubleClickCallback: null,
	   mouseDownCallback: null,
       ajaxExtraData: {},
	   serverData: null,
	   rowCallback: null,
	   animationSpeed: 600,
	   animate: true,
	   multiSelect: true
   },
   _create: function() {
	   var self = this;
	   cols = this.options.columns;
	   
	   if(!cols) {
		   cols = [
		   { "sWidth": "0px", "bSortable": false, "aaSorting": [ "asc" ], "sClass": "ui-filemanager-column-type" },
		   { "sWidth": "auto", "aaSorting": [ "asc", "desc" ], "sClass": "ui-filemanager-column-name" },
		   { "sWidth": "200px", "sClass": "ui-filemanager-column-date" },
		   { "sWidth": "100px", "aaSorting": [ "asc", "desc" ], "sType": "size", "sClass": "ui-filemanager-column-size" },
		   { "sWidth": "30px", "bSortable": false, "sClass": "ui-filemanager-column-next" }
	   ];
	   }
	   this.is_disabled = false;
	   this.multiselect = false;
	   this.last_selected = null;
	   this.was_shift_key = false;
	   this.element.addClass("ui-filemanager");

	   this.buttonBar = jQuery("<div/>", {'class': 'ui-filemanager-buttonbar' }).buttonset();
	   this.pathWidget = jQuery('<div/>', {'class': 'ui-filemanager-path-widget' });
	   jQuery(window).bind('resize.filemanager', function() {
			   self.pathWidget.width(self.element.width() - self.buttonBar.width())
		   }
	   ).triggerHandler('resize.filemanager');
	   this.element.dataTable({
			   'oClasses': {
				   'sSortJUIAsc': 'ui-icon ui-icon-triangle-1-n',
				   'sSortJUIDesc': 'ui-icon ui-icon-triangle-1-s',
				   'sSortJUI': 'ui-icon ui-icon-carat-2-n-s'
			   },
			   "oLanguage": {
				   'sZeroRecords': ''
			   },
			   "sDom": '<"H"r>t',
			   "asStripClasses": [ "ui-filemanager-row-odd", "ui-filemanager-row-even" ],
			   "bJQueryUI": true,
			   "bFilter": false,
			   "bInfo": false,
			   "bSort": !!this.options.sorting,
			   "bPaginate": false,
			   "bProcessing": false,
			   "sAjaxSource": this.options.ajaxSource,
			   "aaSorting": this.options.sorting,
			   "aaSortingFixed": this.options.fixedSorting,
			   "bAutoWidth": false,
			   "aoColumns": cols,
			   "fnServerData": this.options.serverData ? jQuery.proxy(this.options.serverData,this) : function ( source, data, callback ) {
                   jQuery.throbber.show();
                   if( jQuery.isEmptyObject(data) ) {
                       data = { path: self.options.root };
                   }

                   data = jQuery.extend(data, self.options.ajaxExtraData);
				   jQuery.ajax( {
						   "dataType": 'json', 
						   "type": "POST", 
						   "url": source, 
						   "data": data,
						   "success": function(data){
							   self.options.root = data.root;
							   jQuery.each(data.aaData, function( index, value ) {
									   data.aaData[index].push( '' );
								   }
							   );
							   callback.apply(this, [data]);

							   current = '/';
							   self.pathWidget.html("");
							   jQuery(window).triggerHandler('resize.filemanager');
							   divider = jQuery('<span/>', 
								   {
									   text : '/', 
									   'class': 'ui-filemanager-path-divider'
								   }
							   );

							   jQuery.each( jQuery.trim(data.root).split('/'), function(index, value) {
									   if(!value){
										   self.pathWidget.append( divider.clone() );
										   return;
									   }
									   current += value;
									   a = jQuery('<a/>', 
										   {
											   data : {path:current}, 
											   html : value, 
											   'class':  'ui-filemanager-path-link'
										   }
									   ).click(function(){
											   self._reloadAjax( { data: { path: jQuery(this).data('path') } }, function(){
													   self.options.dirPostOpenCallback.apply( self, arguments );
												   } 
											   );
										   }
									   );
									   current += '/';
									   self.pathWidget.append( a ).append( divider.clone() );
								   }
							   );
							   divider.remove(); // the last one
							   arr = jQuery.trim(data.root).split('/');
							   arr.pop();
							   updir = arr.join('/');
							   jQuery('.ui-filemanager-fake-updir', self.element).html(jQuery('<a/>',{
										   text: '',
										   'class': 'ui-filemanager-prev-arrow ui-icon ' + self.options.prevDirIcon,
										   click: function() {
											   self._dirCallback.apply( self, [ this, { path : updir, direction: 'right' } ] );
										   } 
									   }
								   )
							   );
							   jQuery.throbber.hide();
						   }
					   } 
				   );
			   },
			   "fnDrawCallback": function() {
				   if( self.options.mouseDownCallback ) {
					   self.options.mouseDownCallback.apply( this, [ self.element ] );
				   }
			   },
			   "fnRowCallback": this.options.rowCallback ? this.options.rowCallback : function( nRow, aData, iDisplayIndex ) {
				   var path = self.options.root + "/" + aData[1];
				   jQuery(nRow).data({
						   'type': aData[0],
						   'path': self.options.root + "/" + aData[1]
					   }
				   );
				   var typeClass = 'ui-icon-document-b';
				   if( typeof self.options.icons[aData[0]] != 'undefined' ) {
					   typeClass =  self.options.icons[aData[0]];
				   }

				   jQuery("td:eq(0)",nRow).html( jQuery( "<span/>", { 'class': 'ui-icon ' + typeClass } ) );

				   if( aData[0] == "dir" ) {
					   jQuery("td:eq(3)",nRow).html(""); // size irrelevant
					   jQuery("td:eq(4)",nRow).html(
						   jQuery("<span/>",
							   {
								   text: "", 
								   'class': 'ui-filemanager-next-arrow ui-icon ' + self.options.nextDirIcon
							   }
						   )
					   ).data('path', path )
					   .bind( 'click.filemanager', function() {
							   self._dirCallback.apply( self, [ this, {path: path} ] );
						   }
					   );

				   } else if( aData[0] == "file" ) { // default
					   jQuery("td:eq(4)",nRow).html(
						   jQuery("<span/>",
							   {
								   text: "", 
								   'class': 'ui-filemanager-next-arrow ui-icon ' + self.options.fileDownloadIcon
							   }
						   )
					   ).data('path', path )
					   .bind( 'click.filemanager', function() {
							   self._fileCallback.apply( self, [ this, {path: path} ] );
						   }
					   );
				   }

				   jQuery("td:eq(4)",nRow).hover(function(){jQuery(this).toggleClass("ui-state-hover")});

				   jQuery(nRow).addClass("ui-filemanager-state-hover ui-filemanager-type-" + aData[0] );

				   return nRow;
			   }


		   }
	   );
	   this.toolbar = this.element.prev();
	   this.toolbar.prepend( this.pathWidget );
	   this.toolbar.append( this.buttonBar );


	   jQuery("tbody", this.element).delegate( 'tr', 'mousedown', function(event) {
			   if( this.is_disabled ) {
				   return false;
			   }
			   jQuery(this).siblings().andSelf().removeClass("ui-filemanager-state-dblckick");
			   if( self.options.multiSelect ) {
				   if( event.shiftKey ) {
					   jQuery(this).siblings().andSelf().removeClass("ui-filemanager-state-selected");
					   var last = self.last_selected;
					   if( last ) {
						   self.multiselect = true;
						   var cur_idx = this.rowIndex;
						   var last_idx = last.rowIndex;
						   var objs;

						   if( cur_idx < last_idx ) {
							   objs = jQuery(this).siblings().andSelf().filter(function(){
								   return this.rowIndex >= cur_idx && this.rowIndex <= last_idx;
							   }
						   );
						   } else {
							   objs = jQuery(this).siblings().andSelf().filter(function(){
								   return this.rowIndex <= cur_idx && this.rowIndex >= last_idx;
							   }
						   );
						   }
						   objs.addClass('ui-filemanager-state-selected');
						   if( ! self.was_shift_key ) {
							   self.last_selected = this;
						   }
						   self.was_shift_key = true;
					   }

				   } else if( event.ctrlKey ) {
					   self.was_shift_key = true;
					   self.multiselect = true;
					   jQuery(this).toggleClass('ui-filemanager-state-selected');
					   self.last_selected = this;
				   } else {
					   self.was_shift_key = true;
					   if( self.multiselect ) {
						   // We where in multi-select mode,
						   // thus we should act as there wasn't anything selected in the first place
						   self.multiselect = false;
						   self.last_selected = this;
						   jQuery("tr", self.element).removeClass('ui-filemanager-state-selected');
						   jQuery(this).addClass('ui-filemanager-state-selected');
					   } else {
						   last = self.last_selected;
						   if( last ) {
							   if( last == this ) {
								   jQuery(this).toggleClass('ui-filemanager-state-selected');
							   } else {
								   jQuery(last).removeClass('ui-filemanager-state-selected');
								   jQuery(this).addClass('ui-filemanager-state-selected');
								   self.last_selected = this;
							   }
						   } else {
							   jQuery(this).addClass('ui-filemanager-state-selected');
							   self.last_selected = this;
						   }
					   }

				   }
			   } else {
				   jQuery(this).siblings().andSelf().removeClass("ui-filemanager-state-selected");
				   jQuery(this).addClass('ui-filemanager-state-selected');
				   self.multiselect = false;
				   self.last_selected = this;
			   }

			   if( self.options.mouseDownCallback ) {
				   self.options.mouseDownCallback.apply( this, [ self.element ] );
			   }
			   return false;

		   }
	   );	   

	   jQuery("tbody", this.element).delegate( 'tr', 'dblclick', function(event) {
			   // MSIE did it again
			   if(document.selection && document.selection.empty){
				   document.selection.empty() ;
			   } else if(window.getSelection) {
				   var sel=window.getSelection();
				   if(sel && sel.removeAllRanges)
					   sel.removeAllRanges() ;
			   }
			   event.preventDefault();

			   jQuery(this).addClass("ui-filemanager-state-dblckick");
			   if( jQuery(this).data('type') == 'dir' ) {
				   self._dirCallback.apply( self, [ this, {path:jQuery(this).data('path')} ] );
			   } else if( jQuery(this).data('type') == 'file' ) {
				   self._fileCallback.apply( self, [ this, {path:jQuery(this).data('path')} ] );
			   }
			   return false;
		   }
	   );	   
   },
   setButtons: function( buttons ) {
	   var self = this;
	   this.buttonBar.empty();
	   jQuery.each(buttons, function(index, value) {
			   jQuery("<button/>", {html: value.alt, id: value.id }).button( { 
					   text: false, 
					   icons: { 
						   primary: value.type 
					   }
				   } ).data('is_disabled', value.disabled )
			   .button( value.disabled ? 'disable': 'enable' )
			   .click(function(e){jQuery(this).blur()})
			   .click(function(){
					   if(! jQuery(this).hasClass("ui-state-disabled") ) {
						   value.click.apply(self.element, arguments);
					   }
				   }).appendTo(self.buttonBar);
		   });	   
   },
   disableButtons: function( disable ) {
	   if( typeof disable == 'undefined' || disable ) {
		   this.buttonBar.find('button').button("disable");
	   } else {
		   this.buttonBar.find("button").each(function(){$(this).button( $(this).data("is_disabled") ? 'disable': 'enable' )});
	   }
   },
   setActive: function( active ) {
	   this.is_disabled = ! (typeof active == 'undefined' || active);
   },
   _reloadAjax: function( options, callback ) {
	   var self = this;

	   var settings = self.element.fnSettings();
	   options = jQuery.extend(true, {
			   path: settings.sAjaxSource,
			   data: {},
			   redraw: true
		   }, options);
	   
	   settings.sAjaxSource = options.path;
	   self.element.oApi._fnProcessingDisplay( settings, true );

	   settings.fnServerData( settings.sAjaxSource, options.data, function(json) {
			   // Clear the old information from the table
			   self.element.oApi._fnClearTable( settings );

			   // Got the data - add it to the table
			   for ( var i=0 ; i<json.aaData.length ; i++ ) {
				   self.element.oApi._fnAddData( settings, json.aaData[i] );
			   }

			   settings.aiDisplay = settings.aiDisplayMaster.slice();
			   if( options.redraw ) {
				   self.element.fnDraw( self.element );
			   }
			   self.element.oApi._fnProcessingDisplay( settings, false );

			   // Callback user function - for event handlers etc 
			   if ( typeof callback == 'function' )
			   {
				   callback.apply( self, [ json ] );
			   }
		   }
	   );
   },
   reload: function(callback) {
	   this._reloadAjax({data:{path:this.options.root}}, callback);
   },
   getSelected: function() {
	   return jQuery(".ui-filemanager-state-selected", this.element ).map(function(){ return jQuery(this).data('path') }).get();
   },
   _fileCallback: function( row, options ){
	   var self = this;
	   if( self.options.fileDoubleClickCallback ) {
		   self.options.fileDoubleClickCallback.apply( self, [ row, options ] );
	   }
   },
   _dirCallback: function( row, options ){
	   var self = this;

	   if( ! self.options.animate ) {
		   self._reloadAjax( { path: self.element.data('path'), redraw: true, data: { path: options.path }  } );
		   return;
	   }

	   options = jQuery.extend({direction: "left"},options);
	   var orig_width = self.element.outerWidth();
	   var orig_height = self.element.outerHeight();
	   var offset = self.element.offset();

	   var fake = self.element.clone();
	   fake.css({
			   width: orig_width,
			   height: orig_height

		   }
	   );
	   fake.find('.ui-filemanager-state-hover').removeClass('ui-filemanager-state-hover');
	   fake.removeAttr('id').css({margin: 0}).addClass('ui-fake');
	   var wrap = $('<div/>');
	   wrap.append(fake);
	   wrap.hide().appendTo('body').css(
		   {
			   position: 'absolute',
			   width: orig_width,
			   height: orig_height,
			   left: offset.left,
			   top: offset.top,
			   margin: 0,
			   padding: 0
		   }
	   ).show();
	   self.element.hide();

	   self._reloadAjax( { path: self.element.data('path'), redraw: false, data: { path: options.path }  }, function( json ){
			   self.element.fnDraw();
			   var fake2 = self.element.clone();
			   fake2.removeAttr('id').css({margin: 0}).addClass('ui-fake').hide();
			   fake2.find('.ui-filemanager-state-hover').removeClass('ui-filemanager-state-hover');
			   wrap.append(fake2);
			   fake2.css(
				   {
					   position: 'absolute',
					   left: options.direction == 'left' ? orig_width : -orig_width,
					   width: orig_width,
					   top: 0,
					   margin: 0,
					   padding: 0
				   }
			   ).show();
			   wrap2 = $('<div/>');
			   wrap2.appendTo('body');
			   wrap2.css({
					   position: 'absolute',
					   overflow: 'hidden',
					   width: orig_width,
					   height: $(window).height() - offset.top,
					   left: offset.left,
					   top: offset.top,
					   margin: 0,
					   padding: 0					   
				   }
			   );
			   wrap2.append(wrap);
			   wrap.css({
					   position: 'absolute',
					   width: orig_width + self.element.outerWidth(),
					   height: orig_height,
					   left: options.direction == 'left' ? 0: 0,
					   top: 0,
					   margin: 0,
					   padding: 0
				   }
			   );
			   fake.data('name', 'fake');
			   fake2.data('name', 'fake2');
			   wrap.animate(
				   {
					   left: options.direction == 'left' ? -orig_width : orig_width
				   },
				   {
					   duration: 1000,
					   easing: "easeOutExpo",
					   complete:function() {
						   self.element.show();
						   wrap2.remove();
					   }
				   }
			   );
			   if( self.options.dirPostOpenCallback ) {
				   self.options.dirPostOpenCallback.apply( self, arguments );
			   }
		   }
	   );

	   if( self.options.dirDoubleClickCallback ) {
		   self.options.dirDoubleClickCallback.apply( self, [ row, options ] );
	   }
   },
   value: function() {
	   return this.options.root;
   },
   length: function() {
	   return jQuery(".ui-filemanager-state-selected", this.element ).length;
   },
   destroy: function() {

       jQuery.Widget.prototype.destroy.apply(this, arguments); // default destroy

	   jQuery(window).unbind('resize.filemanager');
	   jQuery("tbody", this.element).undelegate( 'tr', 'mousedown');
	   jQuery("tbody", this.element).undelegate( 'tr', 'dblclick');
	   this.pathWidget.remove();
	   this.buttonBar.remove();
	   this.element.fnDestroy();
   }
 });


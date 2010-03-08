 jQuery.widget("ui.filemanager", {
   // default options
   options: {
	   root: '/',
	   ajaxSource: "",
	   columns: [
		   { "sWidth": "5%", "bSortable": false, "aaSorting": [ "asc" ], "sClass": "ui-filemanager-column-type" },
		   { "sWidth": "60%", "aaSorting": [ "asc" ], "sClass": "ui-filemanager-column-name" },
		   { "sWidth": "20%", "sClass": "ui-filemanager-column-date" },
		   { "sWidth": "10%", "sClass": "ui-filemanager-column-size" },
		   { "sWidth": "5%", "bSortable": false, "sClass": "ui-filemanager-column-next" }
	   ],
	   sorting: [[0, "asc"],[1,"asc"]],
	   fixedSorting: [[0, "asc"]],
	   prevDirIcon: 'ui-icon-arrowthick-1-w',
	   nextDirIcon: 'ui-icon-arrowthick-1-e',
	   icons: {
		   'dir': 'ui-icon-folder-collapsed',
		   'file': 'ui-icon-document'
	   },
	   dirPostOpenCallback: null,
	   dirDoubleClickCallback: null,
	   fileDoubleClickCallback: null,
	   mouseDownCallback: null,
	   animationSpeed: 600
   },
   _create: function() {
	   var self = this;
	   this.is_disabled = false;
	   this.multiselect = false;
	   this.last_selected = null;
	   this.element.addClass("ui-filemanager");

	   this.buttonBar = jQuery("<div/>", {'class': 'ui-filemanager-buttonbar' }).buttonset();
	   this.pathWidget = jQuery('<div/>', {'class': 'ui-filemanager-path-widget' });
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
			   "bPaginate": false,
			   "bProcessing": true,
			   "sAjaxSource": this.options.ajaxSource,
			   "aaSorting": this.options.sorting,
			   "aaSortingFixed": this.options.fixedSorting,
			   "bAutoWidth": false,
			   "aoColumns": this.options.columns,
			   "fnServerData": function ( source, data, callback ) {
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
										   text: '←',
										   'class': 'ui-filemanager-prev-arrow ui-icon ' + self.options.prevDirIcon,
										   click: function() {
											   self._dirCallback.apply( self, [ this, { path : updir, direction: 'right' } ] );
										   } 
									   }
								   )
							   );
						   }
					   } 
				   );
			   },
			   "fnDrawCallback": function() {
				   if( self.options.mouseDownCallback ) {
					   self.options.mouseDownCallback.apply( this, [ self.element ] );
				   }
			   },
			   "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
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
								   text: "→", 
								   'class': 'ui-filemanager-next-arrow ui-icon ' + self.options.nextDirIcon,
								   click: function() {
									   self._dirCallback.apply( self, [ this, {path:jQuery(nRow).data('path')} ] );
								   } 
							   }
						   )
					   ).data('path', self.options.root + "/" + aData[1] );
				   }

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
			   if( event.ctrlKey ) {
				   self.multiselect = true;
				   jQuery(this).toggleClass('ui-filemanager-state-selected');
				   self.last_selected = this;
			   } else {
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

			   if( self.options.mouseDownCallback ) {
				   self.options.mouseDownCallback.apply( this, [ self.element ] );
			   }
			   return false;

		   }
	   );	   

	   jQuery("tbody", this.element).delegate( 'tr', 'dblclick', function() {
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
						   value.callback.apply(self.element, arguments);
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
   reload: function() {
	   this._reloadAjax({data:{path:this.options.root}});
   },
   getSelected: function() {
	   return jQuery(".ui-filemanager-state-selected", this.element ).map(function(){ return jQuery(this).data('path') }).get();
   },
   _fileCallback: function( row, options ){
	   var self = this;
	   if( self.options.fileDoubleClickCallback ) {
		   self.options.fileDoubleClickCallback.apply( this, [ self.element, {path:jQuery(this).data('path')} ] );
	   }
   },
   _dirCallback: function( row, options ){
	   var self = this;

	   options = jQuery.extend({direction: "left"},options);
	   var orig_width = self.element.outerWidth();
	   var orig_height = self.element.outerHeight();

	   var offset = self.element.offset();
	   var fake = self.element.fake();
	   //self.element.fnClearTable();

	   self.element.hide();


	   self._reloadAjax( { path: self.element.data('path'), redraw: false, data: { path: options.path }  }, function( json ){
			   self.element.fnDraw();
			   var wrapper = jQuery("<div/>", {
					   css: {
						   "position": "absolute",
						   "margin": 0, 
						   "padding": 0,
						   top: 0, 
						   left: 0 
					   }
				   }
			   );
			   var outer_wrapper = jQuery("<div/>",{
					   css: {
						   position: 'absolute',
						   margin: 0,
						   padding: 0,
						   width: orig_width,
						   height: orig_height,
						   overflow: "hidden"
					   }
				   });
			   outer_wrapper.append( wrapper );

			   outer_wrapper.appendTo("body").hide();

			   height = self.element.height();
			   width = self.element.width();
			   new_fake = self.element.fake();
			   new_fake.children().andSelf().show();
			   wrapper.appendLinear([new_fake, fake], {direction: options.direction == "left" ? 'left' : "left" });
			   wrapper.width(Math.max(orig_width,  width));
			   wrapper.height(Math.max(orig_height, height));
			   outer_wrapper.offset(offset);
			   outer_wrapper.show();

			   wrapper.effect("slide",
				   {
					   direction: options.direction == "left" ? 'right' : "left", 
					   easing: "easeOutExpo"
				   },
				   1000,
				   function() {
					   self.element.show();
					   wrapper.remove();
					   outer_wrapper.remove();
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

   _doSomething: function() {
      // internal functions should be named with a leading underscore
      // manipulate the widget
   },
   value: function() {
   },
   length: function() {

	   return jQuery(".ui-filemanager-state-selected", this.element ).length;
   },
   destroy: function() {
       jQuery.Widget.prototype.destroy.apply(this, arguments); // default destroy
        // now do other stuff particular to this widget
   }
 });


<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.fake.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.appendLinear.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.ba-serializeobject.js" type="text/javascript"></script>
<style>


</style>

<script>
buttons_requiring_selected_files_selectors = $.map( [ 'delete', 'copy', 'move', 'download', 'perm' ], function(value) { return "#fn-filemanager-button-" + value } ).join(', ');
buttons_requiring_single_selected_file_selectors = $.map( [ 'rename' ], function(value) { return "#fn-filemanager-button-" + value } ).join(', ');

dialog_pre_open_callbacks = {
	'perm': function() {
		var files = $(".fn-filemanager-selected").map(function(){ return $(this).data('path') }).get();
		$.post(config.prefix+"/filemanager/perm/json/get", {files:files}, function(data){
			if( data.permissions & 00400 ) {
				$("#fn-filemanager-perm-permission-owner-read").attr("checked","checked");
			}
			if( data.permissions & 00200 ) {
				$("#fn-filemanager-perm-permission-owner-write").attr("checked","checked");
			}
			if( data.permissions & 00100 ) {
				$("#fn-filemanager-perm-permission-owner-execute").attr("checked","checked");
			}

			if( data.permissions & 00040 ) {
				$("#fn-filemanager-perm-permission-group-read").attr("checked","checked");
			}
			if( data.permissions & 00020 ) {
				$("#fn-filemanager-perm-permission-group-write").attr("checked","checked");
			}
			if( data.permissions & 00010 ) {
				$("#fn-filemanager-perm-permission-group-execute").attr("checked","checked");
			}

			if( data.permissions & 00004 ) {
				$("#fn-filemanager-perm-permission-other-read").attr("checked","checked");
			}
			if( data.permissions & 00002 ) {
				$("#fn-filemanager-perm-permission-other-write").attr("checked","checked");
			}
			if( data.permissions & 00001 ) {
				$("#fn-filemanager-perm-permission-other-execute").attr("checked","checked");
			}
		}, 'json');
		
	}
};

dialog_callbacks = {
	'default_close': function() {
		$(this).dialog('close');
	},
	'mkdir': function() {
		var params = $("#fn-filemanager-mkdir").serializeObject();
		params.root = $("#filetable").data('root');
		params.files = $(".fn-filemanager-selected").map(function(){ return $(this).data('path') }).get();
		$.post(config.prefix+"/filemanager/mkdir/json", params, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-mkdir")?>");
			if( ! data.error ) {
				dataTable.fnReloadAjax( config.prefix+"/filemanager/index/json", { path: params.root }, true );
			}
		}, 'json');
		$(this).dialog('close');
	},
	'rename': function() {
		var params = $("#fn-filemanager-rename").serializeObject();
		params.path = $(".fn-filemanager-selected").data('path');
		params.root = $("#filetable").data('root');
		$.post(config.prefix+"/filemanager/rename/json", params, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-rename")?>");
			if( ! data.error ) {
				dataTable.fnReloadAjax( config.prefix+"/filemanager/index/json", { path: params.root }, true );
			}
		}, 'json');
		$(this).dialog('close');
	},
	'perm': function() {
		var params = $("#fn-filemanager-perm").serializeObject();
		params.root = $("#filetable").data('root');
		$.post(config.prefix+"/filemanager/perm/json/set", params, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-perm")?>");
			if( ! data.error ) {
				dataTable.fnReloadAjax( config.prefix+"/filemanager/index/json", { path: params.root }, true );
			}
		}, 'json');
		$(this).dialog('close');
	},
	'delete': function() {
		var files = $(".fn-filemanager-selected").map(function(){ return $(this).data('path') }).get();
		$.post(config.prefix+"/filemanager/delete/json", {files: files}, function(data){
			update_status( data.success, data.error ? data.html : "<?=t("filemanager-success-delete")?>");
			if( ! data.error ) {
				dataTable.fnReloadAjax( config.prefix+"/filemanager/index/json", { path: $("#filetable").data('root') }, true );
			}
		}, 'json');		
		$(this).dialog('close');
	}
};

dialogs = {};
buttons = [
	{
		'id': 'fn-filemanager-button-upload',
		'disabled': false,
		'type': 'ui-icon-arrowthickstop-1-s',
		'alt': 'Upload File',
		'info': '',
		'callback': function() {
		}
	},
	{
		'id': 'fn-filemanager-button-create',
		'disabled': false,
		'type': 'ui-icon-plusthick',
		'alt': 'Create Folder',
		'info': '',
		'callback': function() {
			dialogs["mkdir"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-download',
		'disabled': true,
		'type': 'ui-icon-cart',
		'alt': 'Download as ZIP',
		'info': '',
		'callback': function() {
			var files = $(".fn-filemanager-selected").map(function(){ return $(this).data('path') }).get();
			var input = $("<input/>", { type: 'text', 'name': 'files[]' });
				var form = $("<form/>", {
				'action': config.prefix+"/filemanager/downloadzip",
				'method': 'POST'
			});
			$.each(files, function(index,value) {
				var e = input.clone();
				e.attr('value',value);
				form.append(e);
			});
			form.appendTo("body").submit().remove();
		}
	},
	{
		'id': 'fn-filemanager-button-move',
		'disabled': true,
		'type': 'ui-icon-transferthick-e-w',
		'alt': 'Move files',
		'info': '',
		'callback': function() {
		}
	},
	{
		'id': 'fn-filemanager-button-copy',
		'disabled': true,
		'type': 'ui-icon-copy',
		'alt': 'Copy files',
		'info': '',
		'callback': function() {
		}
	},
	{
		'id': 'fn-filemanager-button-rename',
		'disabled': true,
		'type': 'ui-icon-pencil',
		'alt': 'Rename',
		'info': '',
		'callback': function() {
			dialogs["rename"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-perm',
		'disabled': true,
		'type': 'ui-icon-unlocked',
		'alt': 'Change permissions',
		'info': '',
		'callback': function() {
			dialogs["perm"].dialog("open");
		}
	},
	{
		'id': 'fn-filemanager-button-delete',
		'disabled': true,
		'type': 'ui-icon-trash',
		'alt': 'Delete',
		'info': '',
		'callback': function() {
			dialogs["delete"].dialog("open");
		}
	}
];

update_toolbar_buttons = function() {
	var length = $(".fn-filemanager-selected").length;
	if( length == 0 ) {
		$(buttons_requiring_selected_files_selectors).button("disable");
		$(buttons_requiring_single_selected_file_selectors).button("disable");
	} else if(length == 1) {
		$(buttons_requiring_selected_files_selectors).button("enable");
		$(buttons_requiring_single_selected_file_selectors).button("enable");
	} else {
		$(buttons_requiring_single_selected_file_selectors).button("disable");
		$(buttons_requiring_selected_files_selectors).button("enable");
	}
}

file_download_callback = function( dataTable, filetable, options ){
	$("<form/>", {
		'action': config.prefix+"/filemanager/download",
		'method': 'POST',
		'html': $('<input/>', { type: 'text', 'name': 'path', value: options.path }) 
		}
	).appendTo("body").submit().remove();
}

dir_opening_callback = function( dataTable, filetable, options ){
	options = $.extend({direction: "left", path: "/", speed: 600},options);
	orig_width = filetable.outerWidth();
	orig_height = filetable.outerHeight();

	fake_out = filetable.fake({insertIntoDOM: false});
	dataTable.fnClearTable();
	fake_in = filetable.fake({insertIntoDOM: false});

	wrapper = $("<div/>", {
		css: {"position": "absolute", "margin": 0, "padding": 0, top: 0, left: 0 }
	});
	
	wrapper.appendLinear([fake_in,fake_out], {offset:0, direction: options.direction == "left" ? 'left' : "right" });
	wrapper.width(orig_width);
	wrapper.height(orig_height);

	outer_wrapper = $("<div/>",{
		css: {
			position: 'absolute',
				margin: 0,
				padding: 0,
			width: orig_width,
			height: orig_height,
			overflow: "hidden"
		}
	});
	outer_wrapper.offset(filetable.offset());
	outer_wrapper.append( wrapper );

	outer_wrapper.appendTo("body");
	filetable.hide();
	reloaded = false;
	wrapper.effect("slide",
		{
			direction: options.direction == "left" ? 'right' : "left", 
			easing: "easeOutExpo"
		},
		options.speed,
		function() {
			filetable.show();
			if( reloaded ) {
				dataTable.fnDraw();
			}
			$(this).remove();
			outer_wrapper.remove();
		}
	);

	dataTable.fnReloadAjax( config.prefix+"/filemanager/index/json", { path: options.path }, false, function() {
			dataTable.fnDraw();
	} );
}

fileTable = null;
$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, aoData, bRedraw, fnCallback )
{
	if ( typeof sNewSource != 'undefined' )
	{
		oSettings.sAjaxSource = sNewSource;
	}
	this.oApi._fnProcessingDisplay( oSettings, true );
	var that = this;
	
	oSettings.fnServerData( oSettings.sAjaxSource, aoData, function(json) {
		/* Clear the old information from the table */
		that.oApi._fnClearTable( oSettings );
		
		/* Got the data - add it to the table */
		for ( var i=0 ; i<json.aaData.length ; i++ )
		{
			that.oApi._fnAddData( oSettings, json.aaData[i] );
		}
		
		oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
		if( typeof bRedraw == 'undefined' || bRedraw ) {
			that.fnDraw( that );
		}
		that.oApi._fnProcessingDisplay( oSettings, false );
		
		/* Callback user function - for event handlers etc */
		if ( typeof fnCallback == 'function' )
		{
			fnCallback( oSettings );
		}
	} );
}


$(document).ready(function() {
	fileTable = $("#filetable");

	// All dialogs can be somewhat generic in buildup

	$.each( ['mkdir', 'delete', 'perm', 'rename'], function( index, value ) {

		var options = { "autoOpen": false,
			"open": function(event,ui) {
				var current	= $("#fn-filemanager-" + value + "");
				current.trigger("reset");
				//$(".fn-button", current).button("destroy"); // XXX BROKEN
				//$(".fn-buttonset", current).buttonset("destroy");
				if(typeof dialog_pre_open_callbacks[value] != "undefined") {
					dialog_pre_open_callbacks[value].apply(this, [event,ui]);
				}
				//$(".fn-button", current).button();
				//$(".fn-buttonset", current).buttonset();
				$(".fn-primary-field", current).focus();
			}
		};
		dialogs[value] = $.dialog( 
			$("#fn-filemanager-" + value + "-dialog"),
			$.message("filemanager-" + value + "-dialog-title"),
			[
				{
					'label': $.message("filemanager-" + value + "-dialog-button-label"),
					'callback': dialog_callbacks[value],
					options: { id: 'fn-' + value + '-dialog-button' }
				}
			],
			options	
		);

		$("#fn-filemanager-" + value + "-dialog").submit(function() {
			dialog_callbacks[value].apply(dialogs[value]);
			return false;
		});
	});

	dataTable = fileTable.dataTable({
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
		"sAjaxSource": config.prefix+"/filemanager/index/json",
		"aaSorting": [[0, "asc"],[1,"asc"]],
		"aaSortingFixed": [[0, "asc"]],
		"bAutoWidth": false,
		"aoColumns": [
			{ "sWidth": "5%", "bSortable": false, "aaSorting": [ "asc" ], "sClass": "ui-filemanager-column-type" },
			{ "sWidth": "60%", "aaSorting": [ "asc" ], "sClass": "ui-filemanager-column-name" },
			{ "sWidth": "20%", "sClass": "ui-filemanager-column-date" },
			{ "sWidth": "10%", "sClass": "ui-filemanager-column-size" },
			{ "sWidth": "5%", "bSortable": false, "sClass": "ui-filemanager-column-next" }
		],
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			$.ajax( {
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": function(data){
					fileTable.data('root', data.root);
					$.each(data.aaData, function( index, value ) {
						data.aaData[index].push( '' );
					});
					fnCallback.apply(this, [data]);

					current = '/';
					$("#filetable_paths").html("");
					divider = $('<span/>', {text: '/', 'class': 'ui-filemanager-path-divider'});
					$.each( $.trim(data.root).split('/'), function(index, value) {
						if(!value){
						$("#filetable_paths").append( divider.clone() );
							return;
						}
						current += value;
						a = $('<a/>', {data: {path:current}, html: value, 'class': "ui-filemanager-path-link"}).click(function(){
							dataTable.fnReloadAjax( config.prefix+"/filemanager/index/json", { path: $(this).data('path') } );
						});
						current += '/';
						$("#filetable_paths").append( a ).append( divider.clone() );
					});
					divider.remove(); // the last one
					arr = $.trim(data.root).split('/');
					arr.pop();
					updir = arr.join('/');
					$('.ui-fake-updir', fileTable).html($('<a/>',{
						text: '←',
						'class': 'ui-filemanager-prev-arrow',
						click: function() {
							dir_opening_callback.apply( this, [dataTable, fileTable, {path:updir, direction: 'right'}  ] );
						} 
					}));
				}
			} );
		},
		"fnDrawCallback": function() {
			update_toolbar_buttons();
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			$(nRow).data({
				'foo': 'bar',
				'type': aData[0],
				'path': fileTable.data('root') + "/" + aData[1]
			});

			if( aData[0] == "dir" ) {
				$(nRow).addClass("type-dir");
				$("td:eq(3)",nRow).html(""); // size irrelevant
				$("td:eq(4)",nRow).html($("<span/>",{
					text: "→", 
					'class': 'ui-filemanager-next-arrow',
					click: function() {
						dir_opening_callback.apply( this, [dataTable, fileTable, {path:$(nRow).data('path')} ] );
					} 
				})).data('path', fileTable.data('root') + "/" + aData[1] );
			} else if( aData[0] == "file" ) {
				$(nRow).addClass("type-file");
			}
			$(nRow).addClass("ui-filemanager-state-hover ui-filemanager-type-" + aData[0] );
			
			return nRow;
		}


	});

	var bar = $("<div/>", {'class': 'ui-buttonbar'}).buttonset();

	$.each(buttons, function(index, value) {
		$("<button/>", {html: value.alt, id: value.id }).button( { 
			text: false, 
			icons: { 
				primary: value.type 
			}
		} ).button( value.disabled ? 'disable': 'enable' )
			.click(function(e){$(this).blur()})
			.click(function(){
				if(! $(this).hasClass("ui-state-disabled") ) {
					value.callback.apply(this);
				}
			}).appendTo(bar);
	});
	var toolbar = $("#filetable_wrapper .fg-toolbar");
	toolbar.append(bar);
	toolbar.prepend($('<div/>', {'class': 'ui-filemanager-path-widget', id: "filetable_paths" }));

	$("tbody", fileTable).delegate( 'tr', 'mousedown', function(event) {
		$(this).siblings().andSelf().removeClass("ui-filemanager-state-dblckick");
		if( event.ctrlKey ) {
			fileTable.data('multiselect', true);
			$(this).toggleClass('fn-filemanager-selected ui-filemanager-state-selected');
			fileTable.data('last_selected', this);
		} else {
			if( fileTable.data('multiselect') ) {
				// We where in multi-select mode, 
				// thus we should act as there wasn't anything selected in the first place
				fileTable.data('multiselect', false);
				fileTable.data('last_selected', this);
				$("#filetable tr").removeClass('fn-filemanager-selected ui-filemanager-state-selected');
				$(this).addClass('fn-filemanager-selected ui-filemanager-state-selected');
			} else {
				last = fileTable.data('last_selected');
				if( last ) {
					if( last == this ) {
						$(this).toggleClass('fn-filemanager-selected ui-filemanager-state-selected');
					} else {
						$(last).removeClass('fn-filemanager-selected ui-filemanager-state-selected');
						$(this).addClass('fn-filemanager-selected ui-filemanager-state-selected');
						fileTable.data('last_selected', this);
					}
				} else {
					$(this).addClass('fn-filemanager-selected ui-filemanager-state-selected');
					fileTable.data('last_selected', this);
				}
			}

		}

		update_toolbar_buttons();
		return false;

	});


	$("tbody", fileTable).delegate( 'tr', 'dblclick', function() {
		$(this).addClass("ui-filemanager-state-dblckick");
		if( $(this).data('type') == 'dir' ) {
			dir_opening_callback.apply( this, [dataTable, fileTable, {path:$(this).data('path')} ] );
		} else if($(this).data('type') == 'file' ) {
			file_download_callback.apply( this, [dataTable, fileTable, {path:$(this).data('path')} ] );
		}
		return false;
	});
});

</script>

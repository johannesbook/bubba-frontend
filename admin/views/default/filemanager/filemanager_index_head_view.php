<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.fake.js" type="text/javascript"></script>
<script src="<?=FORMPREFIX.'/views/'.THEME?>/_js/jquery.appendLinear.js" type="text/javascript"></script>
<style>
.type-file {
border-left: 2px solid #3232aa;
}
.type-dir {
border-left: 2px solid #aa3232;
}
#filetable tbody .row-selected * {
background: #881212;
}
#filetable:not(.clone) { 
	cursor: pointer
}
#filetable:not(.clone) tbody tr:hover * {
	background: #aa7676
}
#filetable:not(.clone) tbody tr.row-selected:hover * {
	background: #a25656 !important
}

.ui-action-dblclick {
	background: #ee6622 !important; 
}

.ui-path-link {
	cursor: pointer;
	color: blue !important;
}

.ui-filetable-prev-arrow, .ui-filetable-next-arrow {
font-size: larger;
font-weight: bolder;
}

ul.ui-buttonbar li {
cursor:pointer;
float:left;
list-style:none outside none;
margin:2px;
padding:4px 4px;
position:relative;
}

.ui-buttonbar {
float: right;
margin: 0 4px;
}

.ui-datatables-paths {
float: left;
}

ul.ui-buttonbar {
margin:0;
padding:0;
}
.fg-toolbar {
position: relative;
}

</style>
<script>


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

file_download_callback = function( dataTable, filetable, options ){
	$("<form/>", {
		'action': "<?=(FORMPREFIX)?>/filemanager/download",
		'method': 'POST',
		'html': $('<input/>', { type: 'text', 'name': 'path', value: options.path }) 
		}
	).appendTo("body").submit().remove();
}
dir_opening_callback = function( dataTable, filetable, options ){
	options = $.extend({direction: "left", path: "/", speed: 1000},options);
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

	dataTable.fnReloadAjax( "<?=(FORMPREFIX)?>/filemanager/index/test", { path: options.path }, false, function() {
			dataTable.fnDraw();
	} );
}

$.fn.dataTableExt.aoFeatures.push( {
	"fnInit": function( oSettings ) {
		return $('<div/>', {'class': 'ui-datatables-paths', id: oSettings.sTableId + "_paths" }).get(0);
	},
	"cFeature": "P",
	"sFeature": "Paths"
} );

$.fn.dataTableExt.aoFeatures.push( {
	"fnInit": function( oSettings ) {
		var buttons = [
			{
				'disabled': false,
				'type': 'ui-icon-arrowthickstop-1-s',
				'alt': 'Upload File',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': false,
				'type': 'ui-icon-plusthick',
				'alt': 'Create Folder',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': false,
				'type': 'ui-icon-cart',
				'alt': 'Download as ZIP',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': false,
				'type': 'ui-icon-transferthick-e-w',
				'alt': 'Move files',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': true,
				'type': 'ui-icon-copy',
				'alt': 'Copy files',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': false,
				'type': 'ui-icon-pencil',
				'alt': 'Rename',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': false,
				'type': 'ui-icon-unlocked',
				'alt': 'Change permissions',
				'info': '',
				'callback': function() {
				}
			},
			{
				'disabled': false,
				'type': 'ui-icon-trash',
				'alt': 'Delete',
				'info': '',
				'callback': function() {
				}
			}
		];
		var bar = $("<div/>", {'class': 'ui-buttonbar'}).buttonset();
		$.each(buttons, function(index, value) {
			$("<button/>", {html: value.alt })
				.button( { 
					text: false, 
						icons: { 
							primary: value.type 
						}
				} )
				.button( value.disabled ? 'disable': 'enable' )
				.click(function(e){$(this).blur()})
				.click(value.callback)
				.appendTo(bar);
		});
		return bar.get(0);
	},
	"cFeature": "C",
	"sFeature": "Controlls"
} );

$(document).ready(function() {
	fileTable = $("#filetable");

	dataTable = fileTable.dataTable({
		'oClasses': {
			'sSortJUIAsc': 'ui-icon ui-icon-triangle-1-n',
			'sSortJUIDesc': 'ui-icon ui-icon-triangle-1-s',
			'sSortJUI': 'ui-icon ui-icon-carat-2-n-s'
		},
		"oLanguage": {
			'sZeroRecords': ''
		},
		"sDom": '<"H"PCr>t',
		"bJQueryUI": true,
		"bFilter": false,
		"bInfo": false,
		"bPaginate": false,
		"bProcessing": true,
		"sAjaxSource": "<?=(FORMPREFIX)?>/filemanager/index/test",
		"aaSorting": [[0, "asc"],[1,"asc"]],
		"aaSortingFixed": [[0, "asc"]],
		"bAutoWidth": false,
		"aoColumns": [
			{ "sWidth": "5%", "bSortable": false, "aaSorting": [ "asc" ] },
			{ "sWidth": "60%", "aaSorting": [ "asc" ] },
			{ "sWidth": "20%" },
			{ "sWidth": "10%" },
			{ "sWidth": "5%", "bSortable": false }
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
					divider = $('<span/>', {text: '/', 'class': 'ui-path-divider'});
					$.each( $.trim(data.root).split('/'), function(index, value) {
						if(!value){
						$("#filetable_paths").append( divider.clone() );
							return;
						}
						current += value;
						a = $('<a/>', {data: {path:current}, html: value, 'class': "ui-path-link"}).click(function(){
							dataTable.fnReloadAjax( "<?=(FORMPREFIX)?>/filemanager/index/test", { path: $(this).data('path') } );
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
						'class': 'ui-filetable-prev-arrow',
						click: function() {
							dir_opening_callback.apply( this, [dataTable, fileTable, {path:updir, direction: 'right'}  ] );
						} 
					}));
				}
			} );
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
				$("td:eq(4)",nRow).html($("<a/>",{
					text: "→", 
					'class': 'ui-filetable-next-arrow',
					click: function() {
						dir_opening_callback.apply( this, [dataTable, fileTable, {path:$(nRow).data('path')} ] );
					} 
				})).data('path', fileTable.data('root') + "/" + aData[1] );
			} else if( aData[0] == "file" ) {
				$(nRow).addClass("type-file");
			}
			
			return nRow;
		}


	});

	$("tbody", fileTable).delegate( 'tr', 'mousedown', function(event) {
		$(this).siblings().andSelf().removeClass("ui-action-dblclick");
		if( event.ctrlKey ) {
			fileTable.data('multiselect', true);
			$(this).toggleClass('row-selected');
			fileTable.data('last_selected', this);
		} else {
			if( fileTable.data('multiselect') ) {
				// We where in multi-select mode, 
				// thus we should act as there wasn't anything selected in the first place
				fileTable.data('multiselect', false);
				fileTable.data('last_selected', this);
				$("#filetable tr").removeClass('row-selected');
				$(this).addClass('row-selected');
			} else {
				last = fileTable.data('last_selected');
				if( last ) {
					if( last == this ) {
						$(this).toggleClass('row-selected');
					} else {
						$(last).removeClass('row-selected');
						$(this).addClass('row-selected');
						fileTable.data('last_selected', this);
					}
				} else {
					$(this).addClass('row-selected');
					fileTable.data('last_selected', this);
				}
			}

		}
		return false;

	});


	$("tbody", fileTable).delegate( 'tr', 'dblclick', function() {
		$(this).addClass("ui-action-dblclick");
		if( $(this).data('type') == 'dir' ) {
			dir_opening_callback.apply( this, [dataTable, fileTable, {path:$(this).data('path')} ] );
		} else if($(this).data('type') == 'file' ) {
			file_download_callback.apply( this, [dataTable, fileTable, {path:$(this).data('path')} ] );
		}
		return false;
	});
});

</script>
